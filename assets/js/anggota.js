document.addEventListener("DOMContentLoaded", function () {
    muatTabel({
        url: "../data/anggota.json",
        kolom: ["no_anggota", "nama", "alamat", "no_hp", "email", "tahun_bergabung"],
        tombol: [
            { class: "btn-edit", label: "Edit" },
            { class: "btn-hapus", label: "Hapus" }
        ]
    });
});