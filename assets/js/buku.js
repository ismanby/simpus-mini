const configBuku = {
    url: "../data/buku.json",
    kolom: ["judul", "pengarang", "tahun", "stok", "kategori"],
    tombol: [
        { class: "btn-edit", label: "Edit" },
        { class: "btn-detail", label: "Detail" },
        { class: "btn-hapus", label: "Hapus" }
    ]
};

document.addEventListener("DOMContentLoaded", function () {
    muatTabel(configBuku);

    const reloadBtn = document.getElementById("reload-btn");
    if (reloadBtn) {
        reloadBtn.addEventListener("click", function () {
            muatTabel(configBuku);
        });
    }
});