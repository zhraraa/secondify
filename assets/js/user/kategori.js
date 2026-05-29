// ─── DATA PRODUK ─────────────────────────────────────────────────────────────
const SECONDIFY_BASE = `${window.location.origin}${window.location.pathname.split("/apps/")[0]}`;
const IMAGE_VERSION = "20260511-2";
const detailUrl = (product) => `${SECONDIFY_BASE}/apps/controllers/user/detailController.php?id=${encodeURIComponent(product.id)}`;
const kategoriUrl = (params = "") => `${SECONDIFY_BASE}/apps/controllers/user/kategoriController.php${params}`;
const imageUrl = (src) => {
    if (!src || src.startsWith("http") || src.startsWith("/")) return src;
    return `${SECONDIFY_BASE}/assets/images/${src.replace(/^(\.\.\/)?img\//, "")}?v=${IMAGE_VERSION}`;
};

const allProducts = window.SECONDIFY_PRODUCTS || [];

// Deskripsi kategori
const kategoriMeta = {
    semua:        { title: "Semua Kategori", subtitle: "Jelajahi semua barang preloved yang tersedia" },
    elektronik:   { title: "Elektronik",    subtitle: "Temukan berbagai barang elektronik preloved berkualitas" },
    handphone:    { title: "Handphone",     subtitle: "Smartphone bekas berkualitas dengan harga terjangkau" },
    pakaian:      { title: "Pakaian",       subtitle: "Fashion preloved pilihan, kondisi terawat" },
    buku:         { title: "Buku",          subtitle: "Koleksi buku bekas berkualitas" },
    perabot:      { title: "Perabot",       subtitle: "Perabotan rumah bekas layak pakai" },
    olahraga:     { title: "Olahraga",      subtitle: "Perlengkapan olahraga preloved" },
    mainan:       { title: "Mainan",        subtitle: "Mainan dan games bekas kondisi baik" },
    anak:         { title: "Anak",          subtitle: "Perlengkapan bayi & anak preloved" },
    kendaraan:    { title: "Kendaraan",     subtitle: "Aksesoris kendaraan bekas berkualitas" },
    dapur:        { title: "Dapur",         subtitle: "Peralatan dapur bekas masih layak pakai" },
    tas:          { title: "Tas",           subtitle: "Tas preloved berkualitas" },
    sepatu:       { title: "Sepatu",        subtitle: "Koleksi sepatu bekas pilihan" },
    kamera:       { title: "Kamera",        subtitle: "Kamera dan aksesoris foto preloved" },
    "alat-tulis": { title: "Alat Tulis",   subtitle: "Perlengkapan tulis bekas berkualitas" },
    koleksi:      { title: "Koleksi",       subtitle: "Barang koleksi & memorabilia" },
    kesehatan:    { title: "Kesehatan",     subtitle: "Peralatan kesehatan bekas berkualitas" },
    lainnya:      { title: "Lainnya",       subtitle: "Berbagai barang bekas lainnya" },
};

allProducts.forEach(product => {
    if (!kategoriMeta[product.kategori]) {
        const title = product.kategoriLabel || product.subKategori || product.kategori;
        kategoriMeta[product.kategori] = {
            title,
            subtitle: `Temukan barang ${title.toLowerCase()} preloved berkualitas`,
        };
    }
});

// ─── STATE ────────────────────────────────────────────────────────────────────
let currentKategori = "semua";
let filteredProducts = [];
let currentPage = 1;
const ITEMS_PER_PAGE = 10;

// ─── INIT ─────────────────────────────────────────────────────────────────────
function init() {
    const params = new URLSearchParams(window.location.search);
    const kat = params.get("kat");
    console.log("kat dari URL:", kat);
    console.log("ada di kategoriMeta?", !!kategoriMeta[kat]);
    console.log("currentKategori sebelum:", currentKategori);
    if (kat && kategoriMeta[kat]) {
        currentKategori = kat;
    }
    console.log("currentKategori sesudah:", currentKategori);

    const q = params.get("q");
    if (q) {
        document.getElementById("searchInput").value = q;
    }

    updatePageMeta();
    buildMerekFilter();
    updateKondisiCounts();
    renderProducts();
    bindEvents();
}

function updatePageMeta() {
    const meta = kategoriMeta[currentKategori];
    if (!meta) return;
    document.title = `${meta.title} — Secondify`;
    document.getElementById("pageTitle").textContent = meta.title;
    document.getElementById("pageSubtitle").textContent = meta.subtitle;
    document.getElementById("breadcrumbCurrent").textContent = meta.title;
}

// Build merek filter dynamically based on products in current category
function buildMerekFilter() {
    const baseProducts = currentKategori === "semua"
        ? allProducts
        : allProducts.filter(p => p.kategori === currentKategori);

    // Count by merek
    const merekCount = {};
    baseProducts.forEach(p => {
        if (!merekCount[p.merek]) {
            merekCount[p.merek] = { label: p.merekLabel, count: 0 };
        }
        merekCount[p.merek].count++;
    });

    const merekList = document.getElementById("merekList");
    const merekGroup = document.getElementById("merekGroup");

    if (Object.keys(merekCount).length === 0) {
        merekGroup.style.display = "none";
        return;
    }

    merekGroup.style.display = "";

    // Sort: put 'lainnya' last
    const sorted = Object.entries(merekCount).sort((a, b) => {
        if (a[0] === "lainnya") return 1;
        if (b[0] === "lainnya") return -1;
        return b[1].count - a[1].count;
    });

    merekList.innerHTML = sorted.map(([key, data]) => `
        <label>
            <input type="checkbox" value="${key}" class="cb-merek"> ${data.label}
            <span class="count-badge">(${data.count})</span>
        </label>
    `).join("");
}

// Update kondisi counts based on category
function updateKondisiCounts() {
    const baseProducts = currentKategori === "semua"
        ? allProducts
        : allProducts.filter(p => p.kategori === currentKategori);

    const counts = { baru: 0, "seperti-baru": 0, bekas: 0 };
    baseProducts.forEach(p => {
        if (counts[p.kondisi] !== undefined) counts[p.kondisi]++;
    });

    const baruEl = document.getElementById("cnt-baru");
    const sbnEl = document.getElementById("cnt-seperti-baru");
    const bekasEl = document.getElementById("cnt-bekas");
    if (baruEl) baruEl.textContent = `(${counts["baru"]})`;
    if (sbnEl) sbnEl.textContent = `(${counts["seperti-baru"]})`;
    if (bekasEl) bekasEl.textContent = `(${counts["bekas"]})`;
}

function renderProducts() {
    const grid = document.getElementById("productGrid");
    const sortVal = document.getElementById("sortSelect").value;

    const checkedKondisi = [...document.querySelectorAll('.cb-kondisi')]
        .filter(cb => cb.checked)
        .map(cb => cb.value);

    const checkedMerek = [...document.querySelectorAll('.cb-merek')]
        .filter(cb => cb.checked)
        .map(cb => cb.value);

    const lokasiVal = document.getElementById("lokasiFilter").value;
    const maxHarga = parseInt(document.getElementById("priceRange").value);

    let products = currentKategori === "semua"
        ? [...allProducts]
        : allProducts.filter(p => p.kategori === currentKategori);

    if (checkedKondisi.length > 0) {
        products = products.filter(p => checkedKondisi.includes(p.kondisi));
    }

    if (checkedMerek.length > 0) {
        products = products.filter(p => checkedMerek.includes(p.merek));
    }

    if (lokasiVal) {
        products = products.filter(p => p.lokasi === lokasiVal);
    }

    products = products.filter(p => p.harga <= maxHarga);

    if (sortVal === "Harga Termurah") {
        products.sort((a, b) => a.harga - b.harga);
    } else if (sortVal === "Harga Termahal") {
        products.sort((a, b) => b.harga - a.harga);
    }

    filteredProducts = products;
    document.getElementById("resultCount").textContent = products.length;

    if (products.length === 0) {
        grid.innerHTML = `
            <div class="empty-state">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                </div>
                <h4>Belum ada barang apapun</h4>
                <p>Belum ada barang di kategori ini. Coba cek kembali nanti!</p>
            </div>`;
        renderPagination(0);
        return;
    }

    // Pagination: reset to page 1 on filter/search change
    const totalPages = Math.ceil(products.length / ITEMS_PER_PAGE);
    if (currentPage > totalPages) currentPage = 1;

    const start = (currentPage - 1) * ITEMS_PER_PAGE;
    const pageProducts = products.slice(start, start + ITEMS_PER_PAGE);

    grid.innerHTML = pageProducts.map(p => cardHTML(p)).join("");

   grid.querySelectorAll(".wishlist-btn").forEach(btn => {

    btn.addEventListener("click", function(e){

        e.preventDefault();
        e.stopPropagation();

        const idProduk = this.dataset.id;

        fetch(`${SECONDIFY_BASE}/apps/controllers/user/toggleFavorit.php`,{
            method:"POST",
            headers:{
                "Content-Type":"application/x-www-form-urlencoded"
            },
            body:`id_produk=${idProduk}`
        })
        .then(res => res.text())
        .then(data => {

            if(data === "added"){
                this.classList.add("active");
            }

            if(data === "removed"){
                this.classList.remove("active");
            }

        });

    });

});

    renderPagination(totalPages);
}

function renderPagination(totalPages) {
    const pag = document.getElementById("pagination");

    // Hide pagination if 1 page or less
    if (totalPages <= 1) {
        pag.innerHTML = "";
        return;
    }

    let html = "";

    // Prev button
    html += `<button class="page-btn arrow" ${currentPage === 1 ? "disabled" : ""} id="pagePrev">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
    </button>`;

    // Page numbers with smart ellipsis
    const pages = getPageNumbers(currentPage, totalPages);
    pages.forEach(p => {
        if (p === "...") {
            html += `<span class="page-dots">...</span>`;
        } else {
            html += `<button class="page-btn ${p === currentPage ? "active" : ""}" data-page="${p}">${p}</button>`;
        }
    });

    // Next button
    html += `<button class="page-btn arrow" ${currentPage === totalPages ? "disabled" : ""} id="pageNext">
        <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
    </button>`;

    pag.innerHTML = html;

    // Bind pagination events
    pag.querySelectorAll("[data-page]").forEach(btn => {
        btn.addEventListener("click", () => {
            currentPage = parseInt(btn.dataset.page);
            renderProducts();
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    });

    const prevBtn = document.getElementById("pagePrev");
    const nextBtn = document.getElementById("pageNext");

    if (prevBtn) {
        prevBtn.addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                renderProducts();
                window.scrollTo({ top: 0, behavior: "smooth" });
            }
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener("click", () => {
            if (currentPage < totalPages) {
                currentPage++;
                renderProducts();
                window.scrollTo({ top: 0, behavior: "smooth" });
            }
        });
    }
}

function getPageNumbers(current, total) {
    if (total <= 7) {
        return Array.from({ length: total }, (_, i) => i + 1);
    }

    const pages = [];

    if (current <= 4) {
        for (let i = 1; i <= 5; i++) pages.push(i);
        pages.push("...");
        pages.push(total);
    } else if (current >= total - 3) {
        pages.push(1);
        pages.push("...");
        for (let i = total - 4; i <= total; i++) pages.push(i);
    } else {
        pages.push(1);
        pages.push("...");
        pages.push(current - 1);
        pages.push(current);
        pages.push(current + 1);
        pages.push("...");
        pages.push(total);
    }

    return pages;
}

function cardHTML(p) {
    const badgeMap = {
        "baru": "badge-baru",
        "seperti-baru": "badge-seperti-baru",
        "bekas": "badge-bekas"
    };
    const badgeLabelMap = {
        "baru": "Baru",
        "seperti-baru": "Seperti Baru",
        "bekas": "Bekas"
    };
    return `
    <a class="product-card" href="${detailUrl(p)}">
        <div class="card-img-wrap">
            <img src="${imageUrl(p.gambar)}" alt="${p.nama}" loading="lazy"
                onerror="this.src='https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&h=400&fit=crop'">
            <span class="card-badge ${badgeMap[p.kondisi]}">${badgeLabelMap[p.kondisi]}</span>
            <button class="wishlist-btn"
            data-id="${p.id}"
            title="Simpan ke Favorit">                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </button>
        </div>
        <div class="card-info">
            <div class="card-name">${p.nama}</div>
            <div class="card-price">Rp ${p.harga.toLocaleString("id-ID")}</div>
            <div class="card-location">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
                ${p.lokasi}
            </div>
        </div>
    </a>`;
}

function bindEvents() {
    document.getElementById("sortSelect").addEventListener("change", () => {
        currentPage = 1;
        renderProducts();
    });
    document.getElementById("filterApply").addEventListener("click", () => {
        currentPage = 1;
        renderProducts();
    });

    document.getElementById("filterReset").addEventListener("click", () => {
        document.querySelectorAll('.cb-kondisi').forEach(cb => cb.checked = false);
        document.querySelectorAll('.cb-merek').forEach(cb => cb.checked = false);
        document.getElementById("lokasiFilter").value = "";
        document.getElementById("priceRange").value = 20000000;
        document.getElementById("priceMin").value = "";
        document.getElementById("priceMax").value = "";
        currentPage = 1;
        renderProducts();
    });

    const slider = document.getElementById("priceRange");
    slider.addEventListener("input", () => {
        const val = parseInt(slider.value);
        document.getElementById("priceMax").value = "Rp " + val.toLocaleString("id-ID");
    });

    const navSearch = document.getElementById("searchInput");
    navSearch.addEventListener("keydown", e => {
        if (e.key === "Enter" && e.target.value.trim()) {
            window.location.href = kategoriUrl(`?kat=semua&q=${encodeURIComponent(e.target.value.trim())}`);
        }
    });
}

document.addEventListener("DOMContentLoaded", init);

