// ── Kategori: klik aktif ──────────────────────────
const SECONDIFY_BASE = `${window.location.origin}${window.location.pathname.split("/apps/")[0]}`;
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


searchInput.addEventListener("keyup", (e) => {
    const query = e.target.value.trim();
    console.log("Cari:", query);
});

searchInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
        const query = e.target.value.trim();
        if (query) {
            window.location.href = kategoriUrl(`?kat=semua&q=${encodeURIComponent(query)}`);
        }
    }
});


// ── Sort select ───────────────────────────────────
const sortSelect = document.querySelector(".sort-wrapper select");

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

function renderRecommendations(sortValue = "Terbaru") {
    const grid = document.getElementById("recommendationGrid");
    const count = document.querySelector(".rek-count");
    if (!grid || !count) return;

    const products = [...recommendationProducts];

    if (sortValue === "Harga Termurah") {
        products.sort((a, b) => a.harga - b.harga);
    } else if (sortValue === "Harga Termahal") {
        products.sort((a, b) => b.harga - a.harga);
    }

    count.textContent = `${products.length} barang`;
    grid.innerHTML = products.map(product => cardHTML(product)).join("");
}

renderRecommendations();

if (sortSelect) {
    sortSelect.addEventListener("change", (e) => {
        renderRecommendations(e.target.value);
    });
}

