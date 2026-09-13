async function muatTabel(config) {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 600));

        const res = await fetch(config.url);
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }
        const daftar = await res.json();

        daftar.forEach(function (item) {
            const tr = document.createElement("tr");
            let isiSel = "";
            config.kolom.forEach(function (kunci) {
                isiSel += "<td>" + item[kunci] + "</td>";
            });

            let tombolHtml = "<td>";
            config.tombol.forEach(function (t) {
                tombolHtml += "<button type=\"button\" class=\"" + t.class + "\">" + t.label + "</button> ";
            });
            tombolHtml += "</td>";

            tr.innerHTML = isiSel + tombolHtml;
            tbody.appendChild(tr);
        });

        updateFilterCount();
    } catch (err) {
        tbody.innerHTML =
            "<tr><td colspan=\"" + (config.kolom.length + 1) + "\">Gagal memuat data: " + err.message + "</td></tr>";
    } finally {
        loading.style.display = "none";
    }
}