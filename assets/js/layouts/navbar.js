document.addEventListener("DOMContentLoaded", () => {
    // Inisialisasi icon lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    const searchInput = document.getElementById("searchInput");

    if (searchInput) {
        searchInput.addEventListener("keyup", (e) => {
            const query = e.target.value.trim();
            // console.log("Cari:", query);
        });

        searchInput.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                const query = e.target.value.trim();
                if (query) {
                    const SECONDIFY_BASE = `${window.location.origin}${window.location.pathname.split("/apps/")[0]}`;
                    const kategoriUrl = (params = "") => `${SECONDIFY_BASE}/apps/views/user/kategori.php${params}`;
                    window.location.href = kategoriUrl(`?kat=semua&q=${encodeURIComponent(query)}`);
                }
            }
        });
    }
});
