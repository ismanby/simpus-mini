-- Jobsheet 12 (latihan tambahan): kolom jatuh tempo pada peminjaman
-- Jalankan: psql -U postgres -d simpus_mini -f sql/04_jatuh_tempo.sql

ALTER TABLE peminjaman ADD COLUMN IF NOT EXISTS tanggal_jatuh_tempo DATE;

-- Isi data lama: jatuh tempo = tanggal pinjam + 14 hari
UPDATE peminjaman
SET tanggal_jatuh_tempo = tanggal_pinjam + 14
WHERE tanggal_jatuh_tempo IS NULL;