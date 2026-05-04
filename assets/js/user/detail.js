// ─── SHARED PRODUCT DATA (sama dengan kategori.js) ───────────────────────────
const allProducts = [
    {
        id: 1,
        nama: "Sony WH-1000XM4",
        harga: 2250000,
        kondisi: "seperti-baru",
        kategori: "elektronik",
        subKategori: "Headphone",
        merek: "sony",
        merekLabel: "Sony",
        lokasi: "Langkapura",
        deskripsi: "Headphone wireless Sony WH-1000XM4 dengan noise cancelling terdepan di kelasnya. Dibeli 2023, jarang dipakai. Lengkap dengan box, kabel, dan pouch original.",
        terjual: false,
        gambar: "../img/barang/headphone.jpg",
        gambarList: [
            "../img/barang/headphone.jpg",
            "https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=600&h=600&fit=crop",
            "https://images.unsplash.com/photo-1601370552761-d129028bd833?w=600&h=600&fit=crop",
        ],
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
        merekLabel: "Lainnya",
        lokasi: "Kedaton",
        deskripsi: "Mechanical keyboard Rexus full-size, switch red, kondisi masih sangat baik. Ada beberapa keycap yang sedikit pudar tapi semua tombol berfungsi normal.",
        terjual: false,
        gambar: "../img/barang/keyboard.jpg",
        gambarList: [
            "../img/barang/keyboard.jpg",
            "https://images.unsplash.com/photo-1541140532154-b024d705b90a?w=600&h=600&fit=crop",
        ],
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
        merekLabel: "Apple",
        lokasi: "Tanjung Karang Barat",
        deskripsi: "MacBook Air M1 2020, RAM 8GB SSD 256GB, Space Gray. Kondisi mulus seperti baru, baterai masih 95%. Lengkap dengan charger original.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=600&h=600&fit=crop",
        gambarList: [
            "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=600&h=600&fit=crop",
            "https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?w=600&h=600&fit=crop",
        ],
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
        merekLabel: "Apple",
        lokasi: "Kedaton",
        deskripsi: "iPhone 11 64GB Black, kondisi normal pakai, baterai 82%. Ada lecet halus di sisi bodi, layar mulus. Tanpa dus, dengan charger.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1591337676887-a217a6970a8a?w=600&h=600&fit=crop",
        gambarList: [
            "https://images.unsplash.com/photo-1591337676887-a217a6970a8a?w=600&h=600&fit=crop",
        ],
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
        merekLabel: "Samsung",
        lokasi: "Sukarame",
        deskripsi: "Samsung Galaxy A52 8/128GB Awesome Black, kondisi baik. Baterai masih tahan seharian. Lengkap dengan charger dan dus.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=600&h=600&fit=crop",
        gambarList: [
            "https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=600&h=600&fit=crop",
        ],
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
        merekLabel: "Apple",
        lokasi: "Way Halim",
        deskripsi: "iPhone 17 Pro Max 256GB Desert Titanium, baru pakai 2 bulan. Kondisi mulus, masih garansi resmi sampai 2026. Lengkap semua aksesori.",
        terjual: false,
        gambar: "../img/barang/ip17pm.jpg",
        gambarList: [
            "../img/barang/ip17pm.jpg",
        ],
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
        merekLabel: "Xiaomi",
        lokasi: "Kedaton",
        deskripsi: "Xiaomi Redmi Note 10 4/64GB Onyx Gray. Kondisi normal, ada sedikit lecet di belakang. Baterai masih oke. Tanpa dus.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=600&h=600&fit=crop",
        gambarList: [
            "https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=600&h=600&fit=crop",
        ],
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
        merekLabel: "Lainnya",
        lokasi: "Rajabasa",
        deskripsi: "Adidas Samba OG size 42, warna putih hitam. Baru dipakai 3x, kondisi sangat mulus. Lengkap dengan dus dan lace cadangan.",
        terjual: false,
        gambar: "../img/barang/adidassamba.jpg",
        gambarList: [
            "../img/barang/adidassamba.jpg",
        ],
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
        merekLabel: "Lainnya",
        lokasi: "Sukarame",
        deskripsi: "Kebaya pashmina biru tua dengan bordir halus. Ukuran M-L, kondisi sangat baik hanya dipakai sekali. Cocok untuk wisuda atau acara formal.",
        terjual: false,
        gambar: "../img/barang/bluekebaya.jpg",
        gambarList: [
            "../img/barang/bluekebaya.jpg",
        ],
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
        merekLabel: "Lainnya",
        lokasi: "Langkapura",
        deskripsi: "Canon EOS M50 Mark II body only, shutter count ±8000. Kondisi mulus, semua fungsi normal termasuk flip screen dan Wi-Fi. Lengkap dengan charger dan battery.",
        terjual: false,
        gambar: "../img/barang/camera.jpg",
        gambarList: [
            "../img/barang/camera.jpg",
            "https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=600&h=600&fit=crop",
        ],
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
        merekLabel: "Apple",
        lokasi: "Tanjung Karang Barat",
        deskripsi: "iPad Gen 8 32GB Silver WiFi. Kondisi normal, ada lecet tipis di sudut bodi, layar masih jernih. Baterai 88%. Tanpa dus, dengan charger.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=600&h=600&fit=crop",
        gambarList: [
            "https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=600&h=600&fit=crop",
        ],
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
        merekLabel: "Lainnya",
        lokasi: "Rajabasa",
        deskripsi: "GoPro Hero 9 Black, kondisi mulus. Lengkap dengan 2 baterai, charger, mount aksesoris, dan dus original. Rekaman hingga 5K.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600&h=600&fit=crop",
        gambarList: [
            "https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600&h=600&fit=crop",
        ],
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
        merekLabel: "Lainnya",
        lokasi: "Labuhan Ratu",
        deskripsi: "Nintendo Switch V2 neon blue/red. Kondisi baik, layar mulus, baterai tahan lama. Joy-con masih responsif. Tanpa game card, dengan charger.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1578303512597-81e6cc155b3e?w=600&h=600&fit=crop",
        gambarList: [
            "https://images.unsplash.com/photo-1578303512597-81e6cc155b3e?w=600&h=600&fit=crop",
        ],
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
        merekLabel: "Xiaomi",
        lokasi: "Way Halim",
        deskripsi: "Xiaomi Redmi Note 10S 6/128GB Ocean Blue. Kondisi normal, baterai masih oke. Lengkap charger, tanpa dus.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1585060544812-6b45742d762f?w=600&h=600&fit=crop",
        gambarList: [
            "https://images.unsplash.com/photo-1585060544812-6b45742d762f?w=600&h=600&fit=crop",
        ],
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
        merekLabel: "Lainnya",
        lokasi: "Kedaton",
        deskripsi: "GoPro Hero 8 Black, kondisi normal pakai. Lengkap dengan 1 baterai dan charger. Layar belakang masih jernih.",
        terjual: false,
        gambar: "https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600&h=600&fit=crop",
        gambarList: [
            "https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600&h=600&fit=crop",
        ],
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
        merekLabel: "Lainnya",
        lokasi: "Labuhan Ratu",
        deskripsi: "Pashmina motif bunga warna pink pastel, bahan sifon. Kondisi sangat baik, hanya dipakai 1x. Ukuran 180x75cm.",
        terjual: false,
        gambar: "../img/barang/pashmina.jpg",
        gambarList: [
            "../img/barang/pashmina.jpg",
        ],
        slug: "detail.html?id=16"
    },
];

// Kategori label map
const kategoriLabel = {
    elektronik: "Elektronik",
    handphone: "Handphone",
    pakaian: "Pakaian",
    buku: "Buku",
    sepatu: "Sepatu",
    kamera: "Kamera",
    mainan: "Mainan",
    olahraga: "Olahraga",
    tas: "Tas",
    perabot: "Perabot",
    dapur: "Dapur",
    lainnya: "Lainnya",
};

const kondisiLabel = {
    "baru": "Baru",
    "seperti-baru": "Seperti Baru",
    "bekas": "Bekas",
};

// ─── INIT ─────────────────────────────────────────────────────────────────────
function init() {
    const params = new URLSearchParams(window.location.search);
    const id = parseInt(params.get("id"));

    const product = allProducts.find(p => p.id === id);

    if (!product) {
        showNotFound();
        return;
    }

    renderProduct(product);
    renderRelated(product);
    bindEvents(product);
}

function showNotFound() {
    document.querySelector(".detail-layout").innerHTML = `
        <div class="not-found" style="width:100%; padding: 80px 40px; text-align:center;">
            <h3>Produk tidak ditemukan</h3>
            <p>Barang yang kamu cari tidak ada atau sudah dihapus.</p>
            <a href="kategori.html?kat=semua">← Kembali ke Kategori</a>
        </div>`;
    document.querySelector(".related-section").style.display = "none";
}

function renderProduct(p) {
    // Page title
    document.title = `${p.nama} — Secondify`;

    // Breadcrumb
    document.getElementById("bcKategori").textContent = kategoriLabel[p.kategori] || p.kategori;
    document.getElementById("bcKategori").href = `kategori.html?kat=${p.kategori}`;
    document.getElementById("bcSubKategori").textContent = p.subKategori;
    document.getElementById("bcNama").textContent = p.nama;

    // Main image
    const images = p.gambarList && p.gambarList.length > 0 ? p.gambarList : [p.gambar];
    const mainImg = document.getElementById("mainImage");
    mainImg.src = images[0];
    mainImg.alt = p.nama;
    mainImg.onerror = function() {
        this.src = "https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=600&h=600&fit=crop";
    };

    // Kondisi badge on image
    const badgeEl = document.getElementById("kondisiBadge");
    const badgeClassMap = { "baru": "badge-baru", "seperti-baru": "badge-seperti-baru", "bekas": "badge-bekas" };
    badgeEl.textContent = kondisiLabel[p.kondisi] || p.kondisi;
    badgeEl.className = `kondisi-badge ${badgeClassMap[p.kondisi] || ""}`;

    // Thumbnails
    const thumbsEl = document.getElementById("thumbs");
    if (images.length > 1) {
        thumbsEl.innerHTML = images.map((img, i) => `
            <div class="thumb ${i === 0 ? "active" : ""}" data-index="${i}">
                <img src="${img}" alt="${p.nama} ${i+1}"
                    onerror="this.src='https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=200&h=200&fit=crop'">
            </div>
        `).join("");

        thumbsEl.querySelectorAll(".thumb").forEach(thumb => {
            thumb.addEventListener("click", () => {
                const idx = parseInt(thumb.dataset.index);
                mainImg.src = images[idx];
                thumbsEl.querySelectorAll(".thumb").forEach(t => t.classList.remove("active"));
                thumb.classList.add("active");
            });
        });
    } else {
        thumbsEl.innerHTML = "";
    }

    // Product info top
    document.getElementById("productName").textContent = p.nama;
    document.getElementById("productPrice").textContent = `Rp ${p.harga.toLocaleString("id-ID")}`;
    document.getElementById("productLocation").textContent = p.lokasi;
    document.getElementById("tanggalListed").textContent = "Bandar Lampung";

    // Kondisi pill next to title
    const pillEl = document.getElementById("kondisiPill");
    const pillClassMap = { "baru": "pill-baru", "seperti-baru": "pill-seperti-baru", "bekas": "pill-bekas" };
    pillEl.textContent = kondisiLabel[p.kondisi] || p.kondisi;
    pillEl.className = `kondisi-pill ${pillClassMap[p.kondisi] || ""}`;

    // Detail grid
    document.getElementById("dKategori").textContent = `${kategoriLabel[p.kategori] || p.kategori} › ${p.subKategori}`;
    document.getElementById("dMerek").textContent = p.merekLabel || p.merek;
    document.getElementById("dKondisi").textContent = kondisiLabel[p.kondisi] || p.kondisi;
    document.getElementById("dLokasi").textContent = `${p.lokasi}, Bandar Lampung`;
    document.getElementById("dTerjual").textContent = p.terjual ? "Sudah Terjual" : "Tersedia";

    // Desc
    document.getElementById("productDesc").textContent = p.deskripsi;

    // "Lihat Semua" link
    document.getElementById("lihatSemua").href = `kategori.html?kat=${p.kategori}`;
}

function renderRelated(currentProduct) {
    const related = allProducts
        .filter(p => p.id !== currentProduct.id && p.kategori === currentProduct.kategori)
        .slice(0, 6);

    const grid = document.getElementById("relatedGrid");

    if (related.length === 0) {
        document.querySelector(".related-section").style.display = "none";
        return;
    }

    const badgeMap = { "baru": "badge-baru", "seperti-baru": "badge-seperti-baru", "bekas": "badge-bekas" };
    const badgeLabelMap = { "baru": "Baru", "seperti-baru": "Seperti Baru", "bekas": "Bekas" };

    grid.innerHTML = related.map(p => `
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
        </a>
    `).join("");

    grid.querySelectorAll(".wishlist-btn").forEach(btn => {
        btn.addEventListener("click", e => {
            e.preventDefault();
            e.stopPropagation();
            btn.classList.toggle("active");
        });
    });
}

function bindEvents(product) {
    // Wishlist FAB
    const fab = document.getElementById("wishlistFab");
    fab.addEventListener("click", () => {
        fab.classList.toggle("active");
        showToast(fab.classList.contains("active")
            ? "Ditambahkan ke Wishlist ❤️"
            : "Dihapus dari Wishlist");
    });

    // Chat / COD button
    document.getElementById("btnChat").addEventListener("click", () => {
        showToast("Fitur COD segera hadir! 🚚");
    });

    // Report button
    document.getElementById("btnReport").addEventListener("click", () => {
        showToast("Laporan terkirim. Terima kasih! 🛡️");
    });

    // Seller chat button
    document.querySelector(".seller-chat-btn").addEventListener("click", () => {
        showToast("Fitur chat segera hadir! 💬");
    });

    // Navbar search
    const navSearch = document.getElementById("searchInput");
    navSearch.addEventListener("keydown", e => {
        if (e.key === "Enter" && e.target.value.trim()) {
            window.location.href = `kategori.html?kat=semua&q=${encodeURIComponent(e.target.value.trim())}`;
        }
    });
}

// ─── TOAST ────────────────────────────────────────────────────────────────────
let toastTimer = null;
function showToast(msg) {
    const toast = document.getElementById("toast");
    toast.textContent = msg;
    toast.classList.add("show");
    if (toastTimer) clearTimeout(toastTimer);
    toastTimer = setTimeout(() => {
        toast.classList.remove("show");
    }, 2500);
}

document.addEventListener("DOMContentLoaded", init);