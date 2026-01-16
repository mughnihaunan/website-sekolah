# Website Sekolah SD Islam Khazanah Kebajikan

Website resmi untuk SD Islam Khazanah Kebajikan, dibangun menggunakan Framework CodeIgniter 3 dengan tampilan modern, responsif, dan fitur manajemen konten yang lengkap.

![Hero Screenshot](assets/hero_screenshot_example.png) *(Preview)*

## 🚀 Fitur Utama

### Frontend (Modern Green Theme)
- **Desain Modern & Bersih:** Tema warna hijau emerald yang profesional, layout responsif.
- **Hero Section Dinamis:** Tampilan awal dengan animasi smooth dan informasi jelas.
- **Layout Berita & Pengumuman:** Tampilan grid interaktif untuk berita dan informasi sekolah.
- **Galeri Foto & Video:** Penataan galeri masonry / grid yang rapi.
- **Profil Sekolah:** Visi Misi, Sejarah, Struktur Organisasi, dan Profil Kepala Sekolah.

### Backend (Admin Dashboard)
- **Login Admin:** Akses aman untuk administrator.
- **Manajemen Berita (New):**
  - Editor WYSIWYG (CKEditor).
  - **Upload Gambar Drag & Drop** (Fitur Baru).
- **Manajemen Galeri (New):**
  - **Upload Foto Drag & Drop** (Fitur Baru).
  - Preview gambar otomatis.
- **Manajemen Pengumuman:** Update info sekolah dengan mudah.
- **Manajemen File & Download:** Upload file untuk diunduh pengunjung.
- **Manajemen Guru & Staf:** Kelola data pengajar.
- **Pengaturan Sekolah:** Ubah logo, sambutan, dan identitas sekolah.

## 🛠 Teknologi

- **Framework:** CodeIgniter 3.1.10
- **Bahasa:** PHP 7.4 / 8.0+
- **Database:** MySQL
- **Frontend:** Bootstrap, CSS3 Custom (Green Theme), jQuery
- **Plugins:** CKEditor, Dropify (Upload UI), Masonry Layout

## 📦 Instalasi

1.  **Clone Repository**
    ```bash
    git clone https://github.com/mughnihaunan/website-sekolah.git
    cd website-sekolah
    ```

2.  **Database**
    - Buat database baru di MySQL (misal: `school_website`).
    - Import file `school_website.sql` ke database tersebut.

3.  **Konfigurasi**
    - Buka `application/config/database.php` dan sesuaikan username/password database.
    - Buka `application/config/config.php` dan sesuaikan `base_url`.

4.  **Jalankan**
    - Akses melalui browser: `http://localhost/website-sekolah`

## 🔑 Informasi Login (Demo)

Berikut adalah akun default untuk mengakses halaman admin (`/auth/login`):

| Role | Username | Password |
| :--- | :--- | :--- |
| **Super Admin** | **admin** | **admin123** |


> **Catatan:** Password `admin` telah di-reset menggunakan hash bcrypt yang aman. Jika membuat user baru, sistem sekarang otomatis melakukan hashing password dengan benar.

## 📝 Changelog Terbaru

- **UI Revamp:** Mengubah tema dominan menjadi hijau modern.
- **Fix Login:** Memperbaiki sistem hashing password pada `Model_user`.
- **Feature Upload:** Menambahkan fitur drag & drop upload pada Insert/Edit Berita dan Galeri.
- **Layout:** Memperbaiki layout Pengumuman menjadi 2 kolom (Pengumuman & Info Sekolah).
- **Logo:** Pembaruan logo sekolah transparan kualitas tinggi.

---
Developed by Team.
