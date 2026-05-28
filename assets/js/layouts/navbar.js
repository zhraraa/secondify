document.addEventListener("DOMContentLoaded", () => {
    // Inisialisasi icon lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    const searchInput = document.getElementById("searchInput");
    const SECONDIFY_BASE = `${window.location.origin}${window.location.pathname.split("/apps/")[0]}`;
    const dashboardUrl = (params = "") => `${SECONDIFY_BASE}/apps/controllers/user/dashboardController.php${params}`;
    const kategoriUrl = (params = "") => `${SECONDIFY_BASE}/apps/controllers/user/kategoriController.php${params}`;

    if (searchInput) {
        searchInput.addEventListener("keyup", (e) => {
            const query = e.target.value.trim();
            // console.log("Cari:", query);
        });

        searchInput.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                const query = e.target.value.trim();
                if (query) {
                    const path = window.location.pathname;
                    const params = new URLSearchParams(window.location.search);
                    const sortParam = params.get('sort');
                    const sortQuery = sortParam ? `&sort=${encodeURIComponent(sortParam)}` : '';
                    if (path.includes('/apps/views/user/kategori.php') || path.includes('/apps/controllers/user/kategoriController.php') || path.includes('/apps/views/user/detail.php')) {
                        window.location.href = kategoriUrl(`?kat=semua&q=${encodeURIComponent(query)}${sortQuery}`);
                    } else {
                        window.location.href = dashboardUrl(`?q=${encodeURIComponent(query)}${sortQuery}`);
                    }
                }
            }
        });
    }
});
