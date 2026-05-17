// ── Kategori: klik aktif ──────────────────────────
const SECONDIFY_BASE = `${window.location.origin}${window.location.pathname.split("/apps/")[0]}`;
const kategoriUrl = (params = "") => `${SECONDIFY_BASE}/apps/views/user/kategori.php${params}`;
const detailUrl = (product) => `${SECONDIFY_BASE}/apps/views/user/detail.php?id=${encodeURIComponent(product.id)}`;
const IMAGE_VERSION = "20260511-2";
const imageUrl = (src) => {
    if (!src || src.startsWith("http") || src.startsWith("/")) return src;
    return `${SECONDIFY_BASE}/assets/images/${src}?v=${IMAGE_VERSION}`;
};

const recommendationProducts = [
    { id: 1, nama: "Sony WH-1000XM4", harga: 2250000, kondisi: "seperti-baru", lokasi: "Langkapura", gambar: "barang/headphone.jpg" },
    { id: 6, nama: "iPhone 17 Pro Max", harga: 18500000, kondisi: "seperti-baru", lokasi: "Way Halim", gambar: "barang/ip17pm.jpg" },
    { id: 8, nama: "Adidas Samba OG", harga: 1100000, kondisi: "seperti-baru", lokasi: "Rajabasa", gambar: "barang/adidassamba.jpg" },
    { id: 9, nama: "Blue Kebaya Pashmina", harga: 175000, kondisi: "seperti-baru", lokasi: "Sukarame", gambar: "barang/bluekebaya.jpg" },
    { id: 10, nama: "Canon EOS M50 Mark II", harga: 5800000, kondisi: "bekas", lokasi: "Langkapura", gambar: "barang/camera.jpg" },
    { id: 18, nama: "Novel Laut Bercerita", harga: 65000, kondisi: "bekas", lokasi: "Rajabasa", gambar: "https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=600&h=600&fit=crop" },
    { id: 19, nama: "Meja Belajar Minimalis", harga: 350000, kondisi: "bekas", lokasi: "Sukarame", gambar: "https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?w=600&h=600&fit=crop" },
    { id: 20, nama: "Raket Badminton Yonex", harga: 275000, kondisi: "bekas", lokasi: "Way Halim", gambar: "https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?w=600&h=600&fit=crop" }
];

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
