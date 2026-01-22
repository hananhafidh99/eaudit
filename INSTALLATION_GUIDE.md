# Panduan Instalasi & Deployment Server

Dokumen ini mendefinisikan proses instalasi lengkap untuk mengatur lingkungan Nginx, PHP 7.3, dan MySQL, serta men-deploy aplikasi Laravel (`eaudit` dan `eaudit_2`) di Ubuntu 25.10.

## 1. Persiapan Sistem & Repository

**Catatan**: Ubuntu 25.10 (Plucky/Questing) tidak mendukung PHP 7.3 secara bawaan. Kita harus menggunakan PPA dan memaksakan kompatibilitas dengan rilis yang lebih lama (Noble).

```bash
# Update sistem
apt-get update
apt-get install -y software-properties-common

# Tambahkan PPA PHP
add-apt-repository -y ppa:ondrej/php
apt-get update

# PERBAIKAN: Paksa PPA menggunakan rilis 'noble' untuk kompatibilitas jika 'questing' tidak tersedia
sed -i 's/questing/noble/g' /etc/apt/sources.list.d/ondrej-ubuntu-php-questing.sources
apt-get update
```

## 2. Install Layanan Utama (Core Services)

```bash
# Install Nginx dan MySQL
apt-get install -y nginx mysql-server

# Install PHP 7.3 dan ekstensi dasar
# Catatan: FPM diperlukan untuk Nginx
apt-get install -y php7.3-fpm php7.3-mysql php7.3-common php7.3-cli php7.3-xml php7.3-gd php7.3-mbstring php7.3-curl php7.3-bcmath
```

### 2.1 Perbaikan Dependensi Lama (Kritis untuk PHP 7.3)

PHP 7.3 membutuhkan library lama (`libxml2.so.2` dan `libzip4`) yang sudah digantikan oleh versi yang lebih baru di Ubuntu 25.10. Kita harus menginstalnya secara manual atau membuat shim.

**Perbaikan libxml2:**
```bash
# Download libxml2 legacy
wget http://archive.ubuntu.com/ubuntu/pool/main/libx/libxml2/libxml2_2.9.14+dfsg-1.3ubuntu3_amd64.deb
dpkg -x libxml2_2.9.14+dfsg-1.3ubuntu3_amd64.deb temp_xml
cp temp_xml/usr/lib/x86_64-linux-gnu/libxml2.so.2.9.14 /usr/lib/x86_64-linux-gnu/
ln -sf /usr/lib/x86_64-linux-gnu/libxml2.so.2.9.14 /usr/lib/x86_64-linux-gnu/libxml2.so.2

# Install libicu74 (dibutuhkan oleh PHP 7.3 intl)
wget http://archive.ubuntu.com/ubuntu/pool/main/i/icu/libicu74_74.2-1ubuntu3_amd64.deb
dpkg -i libicu74_74.2-1ubuntu3_amd64.deb
```

**Perbaikan libzip (untuk php7.3-zip):**
```bash
# Install libzip yang tersedia
apt-get install -y libzip5

# Buat shim untuk memenuhi kebutuhan dependensi 'libzip4t64' tanpa menginstalnya ulang
ln -sf /usr/lib/x86_64-linux-gnu/libzip.so.5 /usr/lib/x86_64-linux-gnu/libzip.so.4

# (Opsional: Gunakan 'equivs' untuk membuat paket dummy jika apt mengeluh soal paket yang hilang)
apt-get install -y php7.3-zip
```

## 3. Install Composer

```bash
curl -sS https://getcomposer.org/installer -o composer-setup.php
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
rm composer-setup.php
```

## 4. Deployment Aplikasi

### 4.1 Struktur & Izin (Permissions)
```bash
# Pindahkan aplikasi ke web root
cp -r /root/eaudit /var/www/eaudit
cp -r /root/eaudit_2 /var/www/eaudit_2

# Atur Izin (Permissions)
chown -R www-data:www-data /var/www/eaudit /var/www/eaudit_2
chmod -R 775 /var/www/eaudit/storage /var/www/eaudit/bootstrap/cache
chmod -R 775 /var/www/eaudit_2/storage /var/www/eaudit_2/bootstrap/cache
```

### 4.2 Konfigurasi Aplikasi (.env)
Edit `/var/www/eaudit/.env` dan `/var/www/eaudit_2/.env` dengan kredensial database remote.

```env
DB_CONNECTION=mysql
DB_HOST=195.88.211.130
DB_PORT=3306
DB_DATABASE=progesio_eaudit
DB_USERNAME=progesio_eaudit
DB_PASSWORD=mashananadmin1
DB_STRICT=false
```

### 4.3 Install Dependensi (Dengan Penyesuaian/Workarounds)
Karena kita menggunakan PHP 7.3 di tahun 2026, kita harus mendowngrade paket yang sudah pindah ke PHP 8+.

**Untuk kedua direktori (`/var/www/eaudit` dan `/var/www/eaudit_2`):**

1.  **Modifikasi `composer.json`** untuk mengizinkan plugin dan menonaktifkan blokir keamanan (bypass audit).
2.  **Downgrade `phpspreadsheet`** (Langkah Penting):
    ```bash
    composer require phpoffice/phpspreadsheet:1.18.0 --with-all-dependencies --no-update
    ```
3.  **Jalankan Install**:
    ```bash
    # Kita menggunakan --no-audit untuk melewati peringatan tentang penggunaan paket lama
    composer update --with-all-dependencies --no-dev --optimize-autoloader --no-audit
    ```
4.  **Finalisasi**:
    ```bash
    php artisan key:generate
    php artisan config:cache
    ```

## 5. Konfigurasi Nginx

Buat file `/etc/nginx/sites-available/multi_ports`:

```nginx
server {
    listen 8000;
    root /var/www/eaudit/public;
    index index.php index.html;
    server_name _;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php7.3-fpm.sock;
    }
}

server {
    listen 8002;
    root /var/www/eaudit/public;
    index index.php index.html;
    server_name _;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php7.3-fpm.sock;
    }
}

server {
    listen 9000;
    root /var/www/eaudit_2/public;
    index index.php index.html;
    server_name _;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php7.3-fpm.sock;
    }
}

server {
    listen 9002;
    root /var/www/eaudit_2/public;
    index index.php index.html;
    server_name _;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php7.3-fpm.sock;
    }
}
```

Aktifkan konfigurasi:
```bash
ln -s /etc/nginx/sites-available/multi_ports /etc/nginx/sites-enabled/
rm /etc/nginx/sites-enabled/default  # Opsional, jika ada konflik
systemctl restart nginx
```

## 6. Verifikasi

Periksa apakah aplikasi berjalan:
```bash
curl -I http://localhost:8000
curl -I http://localhost:9000
```
Diharapkan respon `HTTP/1.1 200 OK`.
