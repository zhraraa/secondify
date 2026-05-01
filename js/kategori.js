// ─── DATA PRODUK ─────────────────────────────────────────────────────────────
const allProducts = [
    // Elektronik
    {
        id: 1,
        nama: "Sony WH-1000XM4",
        harga: 2250000,
        kondisi: "seperti-baru",
        kategori: "elektronik",
        subKategori: "Headphone",
        merek: "sony",
        lokasi: "Langkapura",
        deskripsi: "Headphone wireless Sony WH-1000XM4 dengan noise cancelling terdepan di kelasnya. Dibeli 2023, jarang dipakai. Lengkap dengan box, kabel, dan pouch original.",
        terjual: false,
        gambar: "../img/barang/headphone.jpg",
        slug: "detail.html?id=1"
    },
    {
        id: 2,
        nama: "Mechanical Keyboard Rexus",
        harga: 650000,
        kondisi: "bekas",
        kategori: "elektronik",
        subKategori: "Aksesoris Komputer",
        merek: "lainnya",
        lokasi: "Kedaton",
        deskripsi: "Mechanical keyboard Rexus full-size, switch red, kondisi masih sangat baik. Ada beberapa keycap yang sedikit pudar tapi semua tombol berfungsi normal.",
        terjual: false,
        gambar: "../img/barang/keyboard.jpg",
        slug: "detail.html?id=2"
    },
    {
        id: 3,
        nama: "MacBook Air M1 2020",
        harga: 8750000,
        kondisi: "seperti-baru",
        kategori: "elektronik",
        subKategori: "Laptop",
        merek: "apple",
        lokasi: "Tanjung Karang Barat",
        deskripsi: "MacBook Air M1 2020, RAM 8GB SSD 256GB, Space Gray. Kondisi mulus seperti baru, baterai masih 95%. Lengkap dengan charger original.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=600&h=600&fit=crop",
        slug: "detail.html?id=3"
    },
    {
        id: 4,
        nama: "iPhone 11 64GB",
        harga: 3850000,
        kondisi: "bekas",
        kategori: "handphone",
        subKategori: "Smartphone",
        merek: "apple",
        lokasi: "Kedaton",
        deskripsi: "iPhone 11 64GB Black, kondisi normal pakai, baterai 82%. Ada lecet halus di sisi bodi, layar mulus. Tanpa dus, dengan charger.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1591337676887-a217a6970a8a?w=600&h=600&fit=crop",
        slug: "detail.html?id=4"
    },
    {
        id: 5,
        nama: "Samsung Galaxy A52",
        harga: 1950000,
        kondisi: "bekas",
        kategori: "handphone",
        subKategori: "Smartphone",
        merek: "samsung",
        lokasi: "Sukarame",
        deskripsi: "Samsung Galaxy A52 8/128GB Awesome Black, kondisi baik. Baterai masih tahan seharian. Lengkap dengan charger dan dus.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=600&h=600&fit=crop",
        slug: "detail.html?id=5"
    },
    {
        id: 6,
        nama: "iPhone 17 Pro Max",
        harga: 18500000,
        kondisi: "seperti-baru",
        kategori: "handphone",
        subKategori: "Smartphone",
        merek: "apple",
        lokasi: "Way Halim",
        deskripsi: "iPhone 17 Pro Max 256GB Desert Titanium, baru pakai 2 bulan. Kondisi mulus, masih garansi resmi sampai 2026. Lengkap semua aksesori.",
        terjual: false,
        gambar: "../img/barang/ip17pm.jpg",
        slug: "detail.html?id=6"
    },
    {
        id: 7,
        nama: "Xiaomi Redmi Note 10",
        harga: 1250000,
        kondisi: "bekas",
        kategori: "handphone",
        subKategori: "Smartphone",
        merek: "xiaomi",
        lokasi: "Kedaton",
        deskripsi: "Xiaomi Redmi Note 10 4/64GB Onyx Gray. Kondisi normal, ada sedikit lecet di belakang. Baterai masih oke. Tanpa dus.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=600&h=600&fit=crop",
        slug: "detail.html?id=7"
    },
    {
        id: 8,
        nama: "Adidas Samba OG",
        harga: 1100000,
        kondisi: "seperti-baru",
        kategori: "sepatu",
        subKategori: "Sneakers",
        merek: "lainnya",
        lokasi: "Rajabasa",
        deskripsi: "Adidas Samba OG size 42, warna putih hitam. Baru dipakai 3x, kondisi sangat mulus. Lengkap dengan dus dan lace cadangan.",
        terjual: false,
        gambar: "../img/barang/adidassamba.jpg",
        slug: "detail.html?id=8"
    },
    {
        id: 9,
        nama: "Blue Kebaya Pashmina",
        harga: 175000,
        kondisi: "seperti-baru",
        kategori: "pakaian",
        subKategori: "Kebaya",
        merek: "lainnya",
        lokasi: "Sukarame",
        deskripsi: "Kebaya pashmina biru tua dengan bordir halus. Ukuran M-L, kondisi sangat baik hanya dipakai sekali. Cocok untuk wisuda atau acara formal.",
        terjual: false,
        gambar: "../img/barang/bluekebaya.jpg",
        slug: "detail.html?id=9"
    },
    {
        id: 10,
        nama: "Canon EOS M50 Mark II",
        harga: 5800000,
        kondisi: "bekas",
        kategori: "kamera",
        subKategori: "Mirrorless",
        merek: "lainnya",
        lokasi: "Langkapura",
        deskripsi: "Canon EOS M50 Mark II body only, shutter count ±8000. Kondisi mulus, semua fungsi normal termasuk flip screen dan Wi-Fi. Lengkap dengan charger dan battery.",
        terjual: false,
        gambar: "../img/barang/camera.jpg",
        slug: "detail.html?id=10"
    },
    {
        id: 11,
        nama: "iPad Gen 8 32GB",
        harga: 2850000,
        kondisi: "bekas",
        kategori: "elektronik",
        subKategori: "Tablet",
        merek: "apple",
        lokasi: "Tanjung Karang Barat",
        deskripsi: "iPad Gen 8 32GB Silver WiFi. Kondisi normal, ada lecet tipis di sudut bodi, layar masih jernih. Baterai 88%. Tanpa dus, dengan charger.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=600&h=600&fit=crop",
        slug: "detail.html?id=11"
    },
    {
        id: 12,
        nama: "GoPro Hero 9 Black",
        harga: 3150000,
        kondisi: "seperti-baru",
        kategori: "kamera",
        subKategori: "Action Camera",
        merek: "lainnya",
        lokasi: "Rajabasa",
        deskripsi: "GoPro Hero 9 Black, kondisi mulus. Lengkap dengan 2 baterai, charger, mount aksesoris, dan dus original. Rekaman hingga 5K.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600&h=600&fit=crop",
        slug: "detail.html?id=12"
    },
    {
        id: 13,
        nama: "Nintendo Switch V2",
        harga: 2750000,
        kondisi: "bekas",
        kategori: "mainan",
        subKategori: "Gaming",
        merek: "lainnya",
        lokasi: "Labuhan Ratu",
        deskripsi: "Nintendo Switch V2 neon blue/red. Kondisi baik, layar mulus, baterai tahan lama. Joy-con masih responsif. Tanpa game card, dengan charger.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1578303512597-81e6cc155b3e?w=600&h=600&fit=crop",
        slug: "detail.html?id=13"
    },
    {
        id: 14,
        nama: "Xiaomi Redmi Note 10S",
        harga: 1350000,
        kondisi: "bekas",
        kategori: "handphone",
        subKategori: "Smartphone",
        merek: "xiaomi",
        lokasi: "Way Halim",
        deskripsi: "Xiaomi Redmi Note 10S 6/128GB Ocean Blue. Kondisi normal, baterai masih oke. Lengkap charger, tanpa dus.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1585060544812-6b45742d762f?w=600&h=600&fit=crop",
        slug: "detail.html?id=14"
    },
    {
        id: 15,
        nama: "GoPro Hero 8 Black",
        harga: 2400000,
        kondisi: "bekas",
        kategori: "kamera",
        subKategori: "Action Camera",
        merek: "lainnya",
        lokasi: "Kedaton",
        deskripsi: "GoPro Hero 8 Black, kondisi normal pakai. Lengkap dengan 1 baterai dan charger. Layar belakang masih jernih.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600&h=600&fit=crop",
        slug: "detail.html?id=15"
    },
    {
        id: 16,
        nama: "Pashmina Motif Bunga",
        harga: 85000,
        kondisi: "seperti-baru",
        kategori: "pakaian",
        subKategori: "Hijab",
        merek: "lainnya",
        lokasi: "Labuhan Ratu",
        deskripsi: "Pashmina motif bunga warna pink pastel, bahan sifon. Kondisi sangat baik, hanya dipakai 1x. Ukuran 180x75cm.",
        terjual: false,
        gambar: "../img/barang/pashmina.jpg",
        slug: "detail.html?id=16"
    },
];

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

// ─── STATE ────────────────────────────────────────────────────────────────────
let currentKategori = "semua";
let filteredProducts = [];

// ─── INIT ─────────────────────────────────────────────────────────────────────
function init() {
    const params = new URLSearchParams(window.location.search);
    const kat = params.get("kat");
    if (kat && kategoriMeta[kat]) {
        currentKategori = kat;
    }

    const q = params.get("q");
    if (q) {
        document.getElementById("inlineSearch").value = q;
        document.getElementById("searchInput").value = q;
    }

    updatePageMeta();
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
    document.getElementById("inlineSearch").placeholder = `Cari di ${meta.title}...`;
}

function renderProducts() {
    const grid = document.getElementById("productGrid");
    const sortVal = document.getElementById("sortSelect").value;
    const searchVal = document.getElementById("inlineSearch").value.trim().toLowerCase();
    const checkedKondisi = [...document.querySelectorAll('input[type="checkbox"][value]')]
        .filter(cb => cb.checked && ["baru","seperti-baru","bekas"].includes(cb.value))
        .map(cb => cb.value);
    const checkedMerek = [...document.querySelectorAll('input[type="checkbox"][value]')]
        .filter(cb => cb.checked && !["baru","seperti-baru","bekas"].includes(cb.value))
        .map(cb => cb.value);
    const lokasiVal = document.getElementById("lokasiFilter").value;

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

    if (searchVal) {
        products = products.filter(p => p.nama.toLowerCase().includes(searchVal));
    }

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
        return;
    }

    grid.innerHTML = products.map(p => cardHTML(p)).join("");

    grid.querySelectorAll(".wishlist-btn").forEach(btn => {
        btn.addEventListener("click", e => {
            e.preventDefault();
            e.stopPropagation();
            btn.classList.toggle("active");
        });
    });
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
    <a class="product-card" href="${p.slug}">
        <div class="card-img-wrap">
            <img src="${p.gambar}" alt="${p.nama}" loading="lazy"
                onerror="this.src='https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&h=400&fit=crop'">
            <span class="card-badge ${badgeMap[p.kondisi]}">${badgeLabelMap[p.kondisi]}</span>
            <button class="wishlist-btn" title="Simpan ke Wishlist">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
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
    document.getElementById("sortSelect").addEventListener("change", renderProducts);
    document.getElementById("inlineSearch").addEventListener("input", renderProducts);
    document.getElementById("filterApply").addEventListener("click", renderProducts);

    document.getElementById("filterReset").addEventListener("click", () => {
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        document.getElementById("lokasiFilter").value = "";
        document.getElementById("priceRange").value = 10000000;
        document.getElementById("priceMin").value = "";
        document.getElementById("priceMax").value = "";
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
            window.location.href = `kategori.html?kat=semua&q=${encodeURIComponent(e.target.value.trim())}`;
        }
    });
}

document.addEventListener("DOMContentLoaded", init);