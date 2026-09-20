-- Jobsheet 8: skema awal database simpus_mini (PostgreSQL)
-- Jalankan setelah membuat database, misal:
--   createdb -U postgres simpus_mini
--   psql -U postgres -d simpus_mini -f sql/01_buku_anggota.sql

CREATE TABLE IF NOT EXISTS buku (
    id SERIAL PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    pengarang VARCHAR(255) NOT NULL,
    tahun INTEGER NOT NULL,
    isbn VARCHAR(50),
    stok INTEGER NOT NULL DEFAULT 0,
    kategori VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS anggota (
    id SERIAL PRIMARY KEY,
    no_anggota VARCHAR(50) NOT NULL UNIQUE,
    nama VARCHAR(255) NOT NULL,
    alamat VARCHAR(255),
    no_hp VARCHAR(30),
    email VARCHAR(255),
    tahun_bergabung INTEGER
);