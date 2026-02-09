# Website Madrid Ambon

Website resmi Pena Real Madrid de Indonesia (PRMI) Regional Ambon. Aplikasi ini berfungsi sebagai portal komunitas untuk berita, acara, dan manajemen anggota.

## Fitur

-   **Portal Publik**:
    -   **Beranda**: Menampilkan carousel dan berita terbaru.
    -   **Berita**: Artikel berita dengan kategori.
    -   **Galeri**: Koleksi foto dan video kegiatan.
    -   **Halaman Info**: Halaman statis seperti Tentang Kami, Sejarah, Visi & Misi.
    -   **Pendaftaran Anggota**: Formulir untuk pendaftaran anggota baru.

-   **Panel Admin**:
    -   **Dashboard**: Ringkasan statistik situs.
    -   **Manajemen Konten**: Kelola Postingan (Berita), Halaman, Kategori, dan Galeri.
    -   **Manajemen Pengguna**: Kelola data pengguna dan hak akses (Admin/Editor).
    -   **Pengaturan Situs**: Konfigurasi umum seperti Logo, Judul Situs, dan Deskripsi.
    -   **Manajemen Profil**: Fitur bagi pengguna login untuk mengubah nama, email, foto profil, dan password.
    -   **Manajemen Acara**: Membuat dan mengelola agenda kegiatan/event.

## Teknologi

-   **Framework**: [Laravel 11](https://laravel.com)
-   **Frontend**: Blade Templates, Bootstrap 5, DashUI.
-   **Database**: MySQL.

## Instalasi

1.  **Clone repositori**:
    ```bash
    git clone https://github.com/username/madrid-ambon-web.git
    cd madrid-ambon-web
    ```

2.  **Instal dependensi**:
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**:
    -   Salin file `.env.example` menjadi `.env`:
        ```bash
        cp .env.example .env
        ```
    -   Sesuaikan konfigurasi database (DB_DATABASE, DB_USERNAME, DB_PASSWORD) di file `.env`.

4.  **Generate Key Aplikasi**:
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan Migrasi dan Seeder**:
    ```bash
    php artisan migrate --seed
    ```
    *Catatan: Seeding penting untuk membuat role default dan akun admin.*

6.  **Jalankan Aplikasi**:
    -   Jalankan server pengembangan Laravel:
        ```bash
        php artisan serve
        ```
    -   (Opsional) Jalankan Vite untuk compile aset frontend:
        ```bash
        npm run dev
        ```

## Akun Default

-   **Email**: `admin@prmi.com`
-   **Password**: `password`

## Lisensi

Proyek ini adalah perangkat lunak open-source di bawah lisensi [MIT](https://opensource.org/licenses/MIT).
