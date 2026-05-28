// ── Kategori: klik aktif ──────────────────────────
const SECONDIFY_BASE = `${window.location.origin}${window.location.pathname.split("/apps/")[0]}`;
const dashboardUrl = (params = "") => `${SECONDIFY_BASE}/apps/controllers/user/dashboardController.php${params}`;
const kategoriUrl = (params = "") => `${SECONDIFY_BASE}/apps/controllers/user/kategoriController.php${params}`;
const detailUrl = (product) => `${SECONDIFY_BASE}/apps/controllers/user/detailController.php?id=${encodeURIComponent(product.id)}`;
const IMAGE_VERSION = "20260511-2";
const imageUrl = (src) => {
    if (!src || src.startsWith("http") || src.startsWith("/")) return src;
    return `${SECONDIFY_BASE}/assets/images/${src}?v=${IMAGE_VERSION}`;
};

const recommendationProducts = window.SECONDIFY_PRODUCTS || [];

const kategoriItems = document.querySelectorAll(".kategori-item");

kategoriItems.forEach(item => {
    item.addEventListener("click", () => {
        kategoriItems.forEach(i => i.classList.remove("active"));
        item.classList.add("active");

        const selected = item.dataset.kategori;
        window.location.href = kategoriUrl(`?kat=${encodeURIComponent(selected)}`);
    });
});


// ── Search ────────────────────────────────────────
const searchInput = document.getElementById("searchInput");
const urlParams = new URLSearchParams(window.location.search);
const currentSort = urlParams.get('sort') || 'terbaru';

if (searchInput) {
    searchInput.addEventListener("keyup", (e) => {
        const query = e.target.value.trim();
        console.log("Cari:", query);
    });

    searchInput.addEventListener("keydown", (e) => {
        if (e.key === "Enter") {
            const query = e.target.value.trim();
            if (query) {
                const targetUrl = new URL(dashboardUrl());
                targetUrl.searchParams.set('q', query);
                targetUrl.searchParams.set('sort', currentSort);
                window.location.href = targetUrl.toString();
            }
        }
    });
}


// ── Sort select ───────────────────────────────────
const sortSelect = document.querySelector("#sortSelect");

function cardHTML(product) {
    const badgeClass = product.kondisi === "seperti-baru" ? "badge-seperti-baru" : "badge-bekas";
    const badgeLabel = product.kondisi === "seperti-baru" ? "Seperti Baru" : "Bekas";

    return `
        <a class="product-card" href="${detailUrl(product)}">
            <div class="card-img-wrap">
                <img src="${imageUrl(product.gambar)}" alt="${product.nama}" loading="lazy">
                <span class="card-badge ${badgeClass}">${badgeLabel}</span>
            </div>
            <div class="card-info">
                <div class="card-name">${product.nama}</div>
                <div class="card-price">Rp ${product.harga.toLocaleString("id-ID")}</div>
                <div class="card-location">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    ${product.lokasi}
                </div>
            </div>
        </a>`;
}

function renderRecommendations() {
    const grid = document.getElementById("recommendationGrid");
    const count = document.querySelector(".rek-count");
    if (!grid || !count) return;

    count.textContent = `${recommendationProducts.length} barang`;
    grid.innerHTML = recommendationProducts.map(product => cardHTML(product)).join("");
}

renderRecommendations();

if (sortSelect) {
    sortSelect.addEventListener("change", (e) => {
        const targetUrl = new URL(dashboardUrl());
        targetUrl.searchParams.set('sort', e.target.value);
        const query = urlParams.get('q');
        if (query) {
            targetUrl.searchParams.set('q', query);
        }
        window.location.href = targetUrl.toString();
    });
}

