// ── Kategori: klik aktif ──────────────────────────
const kategoriItems = document.querySelectorAll(".kategori-item");

kategoriItems.forEach(item => {
    item.addEventListener("click", () => {
        kategoriItems.forEach(i => i.classList.remove("active"));
        item.classList.add("active");

        const selected = item.dataset.kategori;
        console.log("Kategori dipilih:", selected);

        // Update judul rekomendasi sesuai kategori
        const rekTitle = document.querySelector(".rek-count");
        if (rekTitle) {
            rekTitle.textContent = "0 barang";
        }
    });
});


// ── Search ────────────────────────────────────────
const searchInput = document.getElementById("searchInput");

searchInput.addEventListener("keyup", (e) => {
    const query = e.target.value.trim();
    console.log("Cari:", query);
});

searchInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
        const query = e.target.value.trim();
        if (query) {
            console.log("Submit pencarian:", query);
            // Tambahkan logika pencarian / redirect di sini
        }
    }
});


// ── Sort select ───────────────────────────────────
const sortSelect = document.querySelector(".sort-wrapper select");

if (sortSelect) {
    sortSelect.addEventListener("change", (e) => {
        console.log("Urutan:", e.target.value);
        // Tambahkan logika sorting di sini
    });
}