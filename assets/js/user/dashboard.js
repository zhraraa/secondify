// ── Kategori: klik aktif ──────────────────────────
const kategoriItems = document.querySelectorAll(".kategori-item");

kategoriItems.forEach(item => {
    item.addEventListener("click", () => {
        kategoriItems.forEach(i => i.classList.remove("active"));
        item.classList.add("active");

        const selected = item.dataset.kategori;
        window.location.href = `kategori.html?kat=${encodeURIComponent(selected)}`;
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
            window.location.href = `kategori.html?kat=semua&q=${encodeURIComponent(query)}`;
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
