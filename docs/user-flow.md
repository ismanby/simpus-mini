# User Flow Pemeriksaan Tunggakan Anggota

## Aktor
Petugas

## Skenario
Petugas mencari anggota yang memiliki tunggakan dan sudah melewati
tanggal jatuh tempo.

## User Flow

```
[Petugas Login] -> [Dashboard Petugas] -> [Pilih menu "Anggota"]
                -> [Cari Anggota] -> [Anggota Ditemukan?]
                                          /       \
                                       Tidak      Ya
                                        |          |
                                        v          v
                                  [Tampilkan   [Tampilkan
                                  pesan]       detail anggota]
                                            |
                                            v
                                    [Cek Peminjaman]
                                            |
                                            v
                                    [Ada Tunggakan?]
                                        /       \
                                     Tidak      Ya
                                       |         |
                                       v         v
                                [Tidak ada      [Tampilkan
                                tunggakan]      detail tunggakan]
                                            |
                                            v
                                  [Kembali ke Dashboard]
                                            |
                                            v
                                        [Selesai]