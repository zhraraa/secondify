// ─── SHARED PRODUCT DATA (sama dengan kategori.js) ───────────────────────────
const SECONDIFY_BASE = `${window.location.origin}${window.location.pathname.split("/apps/")[0]}`;
const IMAGE_VERSION = "20260511-2";
const detailUrl = (product) => `${SECONDIFY_BASE}/apps/controllers/user/detailController.php?id=${encodeURIComponent(product.id)}`;
const kategoriUrl = (params = "") => `${SECONDIFY_BASE}/apps/controllers/user/kategoriController.php${params}`;
const chatUrl = (product) => {
    return `${SECONDIFY_BASE}/apps/views/user/chat.php?id_produk=${product.id}&id_penjual=${product.idUser}`;
};
const imageUrl = (src) => {
    if (!src || src.startsWith("http") || src.startsWith("/")) return src;
    return `${SECONDIFY_BASE}/assets/images/${src.replace(/^(\.\.\/)?img\//, "")}?v=${IMAGE_VERSION}`;
};

const getSellerName = (product) => product.seller || product.penjual || "secondify.seller";
const getSellerInitial = (sellerName) => sellerName.trim().charAt(0).toUpperCase() || "S";

function getWishlist() {
    try {
        return JSON.parse(localStorage.getItem("secondifyWishlist")) || [];
    } catch (error) {
        return [];
    }
}

function saveWishlist(items) {
    localStorage.setItem("secondifyWishlist", JSON.stringify(items));
}

function isWishlisted(productId) {
    return getWishlist().some(item => Number(item.id) === Number(productId));
}

function wishlistPayload(product) {
    return {
        id: product.id,
        nama: product.nama,
        harga: product.harga,
        lokasi: product.lokasi,
        kondisi: product.kondisi,
        kategori: product.kategori,
        gambar: product.gambar,
        seller: getSellerName(product),
        detailUrl: detailUrl(product),
    };
}

function toggleWishlist(product) {
    const items = getWishlist();
    const exists = items.some(item => Number(item.id) === Number(product.id));

    if (exists) {
        saveWishlist(items.filter(item => Number(item.id) !== Number(product.id)));
        return false;
    }

    saveWishlist([wishlistPayload(product), ...items]);
    return true;
}

const allProducts = window.SECONDIFY_PRODUCTS || [];
const currentUserId = Number(window.SECONDIFY_CURRENT_USER_ID || 0);

function isCurrentUserProduct(product) {
    return Number(product.idUser) === currentUserId;
}

// Kategori label map
const kategoriLabel = {
    elektronik: "Elektronik",
    handphone: "Handphone",
    pakaian: "Pakaian",
    buku: "Buku",
    sepatu: "Sepatu",
    kamera: "Kamera",
    mainan: "Mainan",
    anak: "Anak",
    olahraga: "Olahraga",
    tas: "Tas",
    perabot: "Perabot",
    kendaraan: "Kendaraan",
    dapur: "Dapur",
    "alat-tulis": "Alat Tulis",
    koleksi: "Koleksi",
    kesehatan: "Kesehatan",
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
            <a href="${kategoriUrl("?kat=semua")}">← Kembali ke Kategori</a>
        </div>`;
    document.querySelector(".related-section").style.display = "none";
}

function renderProduct(p) {
    // Page title
    document.title = `${p.nama} — Secondify`;

    // Breadcrumb
    document.getElementById("bcKategori").textContent = p.kategoriLabel || kategoriLabel[p.kategori] || p.kategori;
    document.getElementById("bcKategori").href = kategoriUrl(`?kat=${p.kategori}`);
    const kategoriTitle = p.kategoriLabel || kategoriLabel[p.kategori] || p.kategori;
    const hasSubKategori = p.subKategori && p.subKategori !== kategoriTitle;
    const bcSubKategori = document.getElementById("bcSubKategori");
    const bcSubSep = bcSubKategori.previousElementSibling;
    bcSubKategori.textContent = hasSubKategori ? p.subKategori : "";
    bcSubKategori.style.display = hasSubKategori ? "" : "none";
    if (bcSubSep) bcSubSep.style.display = hasSubKategori ? "" : "none";
    document.getElementById("bcNama").textContent = p.nama;

    // Main image
    const images = p.gambarList && p.gambarList.length > 0 ? p.gambarList : [p.gambar];
    const mainImg = document.getElementById("mainImage");
    mainImg.src = imageUrl(images[0]);
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
                <img src="${imageUrl(img)}" alt="${p.nama} ${i+1}"
                    onerror="this.src='https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=200&h=200&fit=crop'">
            </div>
        `).join("");

        thumbsEl.querySelectorAll(".thumb").forEach(thumb => {
            thumb.addEventListener("click", () => {
                const idx = parseInt(thumb.dataset.index);
                mainImg.src = imageUrl(images[idx]);
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
    document.getElementById("dKategori").textContent = hasSubKategori ? `${kategoriTitle} › ${p.subKategori}` : kategoriTitle;
    document.getElementById("dMerek").textContent = p.merekLabel || p.merek;
    document.getElementById("dKondisi").textContent = kondisiLabel[p.kondisi] || p.kondisi;
    document.getElementById("dLokasi").textContent = `${p.lokasi}, Bandar Lampung`;
    document.getElementById("dTerjual").textContent = p.terjual ? "Sudah Terjual" : "Tersedia";

    // Desc
    document.getElementById("productDesc").textContent = p.deskripsi;

    // Seller
    const sellerName = getSellerName(p);
    document.querySelector(".seller-avatar").textContent = getSellerInitial(sellerName);
    document.querySelector(".seller-name").textContent = sellerName;
    document.querySelector(".seller-meta").textContent = p.sellerJoined || "Penjual Secondify";

    // "Lihat Semua" link
    document.getElementById("lihatSemua").href = kategoriUrl(`?kat=${p.kategori}`);

    applyDetailMode(p);
}

function renderRelated(currentProduct) {
    const ownerMode = isCurrentUserProduct(currentProduct);
    const related = allProducts
        .filter(p => p.id !== currentProduct.id && (ownerMode ? Number(p.idUser) === currentUserId : p.kategori === currentProduct.kategori))
        .slice(0, 6);

    const grid = document.getElementById("relatedGrid");
    const relatedTitle = document.querySelector(".related-header h3");
    const lihatSemua = document.getElementById("lihatSemua");

    if (ownerMode && relatedTitle) relatedTitle.textContent = "Produk Saya Lainnya";
    if (ownerMode && lihatSemua) {
        lihatSemua.href = `${SECONDIFY_BASE}/apps/controllers/user/profileController.php`;
        lihatSemua.textContent = "Kembali ke Profil →";
    }

    if (related.length === 0) {
        document.querySelector(".related-section").style.display = "none";
        return;
    }

    const badgeMap = { "baru": "badge-baru", "seperti-baru": "badge-seperti-baru", "bekas": "badge-bekas" };
    const badgeLabelMap = { "baru": "Baru", "seperti-baru": "Seperti Baru", "bekas": "Bekas" };

    grid.innerHTML = related.map(p => `
        <a class="product-card" href="${detailUrl(p)}">
            <div class="card-img-wrap">
                <img src="${imageUrl(p.gambar)}" alt="${p.nama}" loading="lazy"
                    onerror="this.src='https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&h=400&fit=crop'">
                <span class="card-badge ${badgeMap[p.kondisi]}">${badgeLabelMap[p.kondisi]}</span>
                ${ownerMode ? "" : `
                <button class="wishlist-btn ${isWishlisted(p.id) ? "active" : ""}" data-id="${p.id}" title="Simpan ke Wishlist">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </button>`}
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
            const product = related.find(item => Number(item.id) === Number(btn.dataset.id));
            if (!product) return;
            const added = toggleWishlist(product);
            btn.classList.toggle("active", added);
            showToast(added ? "Ditambahkan ke Favorit" : "Dihapus dari Favorit");
        });
    });
}

function bindEvents(product) {
    const navSearch = document.getElementById("searchInput");
    if (navSearch) {
        navSearch.addEventListener("keydown", e => {
            if (e.key === "Enter" && e.target.value.trim()) {
                window.location.href = kategoriUrl(`?kat=semua&q=${encodeURIComponent(e.target.value.trim())}`);
            }
        });
    }

    if (isCurrentUserProduct(product)) {
        const manageBtn = document.getElementById("btnManageProduct");
        const profileBtn = document.getElementById("btnBackProfile");

        if (manageBtn) {
            manageBtn.addEventListener("click", () => {
                window.location.href = `${SECONDIFY_BASE}/apps/controllers/penjual/kelolaBarang.php`;
            });
        }

        if (profileBtn) {
            profileBtn.addEventListener("click", () => {
                window.location.href = `${SECONDIFY_BASE}/apps/controllers/user/profileController.php`;
            });
        }

        return;
    }

    // Wishlist FAB
    const fab = document.getElementById("wishlistFab");
    if (fab) {
        fab.classList.toggle("active", isWishlisted(product.id));
        fab.addEventListener("click", event => {
            event.stopImmediatePropagation();
            const added = toggleWishlist(product);
            fab.classList.toggle("active", added);
            showToast(added ? "Ditambahkan ke Favorit ❤️" : "Dihapus dari Favorit");
        }, true);
    }

    // Chat button
    const btnChat = document.getElementById("btnChat");
    if (btnChat) {
        btnChat.addEventListener("click", event => {
            event.stopImmediatePropagation();
            window.location.href = chatUrl(product);
        }, true);
    }

    // COD button
    const btnCOD = document.getElementById("btnCOD");
    if (btnCOD) {
        btnCOD.addEventListener("click", event => {
            event.stopImmediatePropagation();
            showToast("Fitur COD segera hadir! 🚚");
        }, true);
    }

    // Seller profile button
    const sellerChatBtn = document.querySelector(".seller-chat-btn");
    if (sellerChatBtn) {
        sellerChatBtn.addEventListener("click", event => {
            event.stopImmediatePropagation();
            window.location.href = `${SECONDIFY_BASE}/apps/controllers/user/profileController.php?id=${product.idUser}`;
        }, true);
    }

    bindReportModal(product);
}

function applyDetailMode(product) {
    if (!isCurrentUserProduct(product)) return;

    const wishlistFab = document.getElementById("wishlistFab");
    const sellerBox = document.querySelector(".seller-box");
    const safetyBox = document.querySelector(".safety-box");
    const ctaRow = document.querySelector(".cta-row");

    if (wishlistFab) wishlistFab.style.display = "none";
    if (safetyBox) safetyBox.style.display = "none";
    if (ctaRow) ctaRow.style.display = "none";

    if (sellerBox) {
        sellerBox.classList.add("owner-box");
        sellerBox.innerHTML = `
            <div class="detail-box-title">Produk Anda</div>
            <div class="owner-summary">
                <div class="owner-summary-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                </div>
                <div>
                    <div class="owner-summary-title">${product.terjual ? "Produk sudah terjual" : "Produk sedang tampil di marketplace"}</div>
                    <div class="owner-summary-meta">Pembeli melihat detail ini dengan tombol chat dan laporan.</div>
                </div>
            </div>
            <div class="owner-actions">
                <button class="btn-owner-primary" id="btnManageProduct" type="button">Kelola Barang</button>
                <button class="btn-owner-secondary" id="btnBackProfile" type="button">Kembali ke Profil</button>
            </div>
        `;
    }
}

function bindReportModal(product) {
    const overlay = document.getElementById("reportOverlay");
    const openBtn = document.getElementById("btnReport");
    const closeBtn = document.getElementById("reportClose");
    const cancelBtn = document.getElementById("reportCancel");
    const submitBtn = document.getElementById("reportSubmit");
    const productName = document.getElementById("reportProductName");
    const reason = document.getElementById("reportReason");
    const detail = document.getElementById("reportDetail");

    const openModal = event => {
        if (event) event.stopImmediatePropagation();
        productName.textContent = product.nama;
        overlay.classList.add("show");
        overlay.setAttribute("aria-hidden", "false");
        detail.focus();
    };

    const closeModal = () => {
        overlay.classList.remove("show");
        overlay.setAttribute("aria-hidden", "true");
    };

    if (openBtn) openBtn.addEventListener("click", openModal, true);
    if (closeBtn) closeBtn.addEventListener("click", closeModal);
    if (cancelBtn) cancelBtn.addEventListener("click", closeModal);
    if (overlay) {
        overlay.addEventListener("click", event => {
            if (event.target === overlay) closeModal();
        });
    }

    if (submitBtn) {
        submitBtn.addEventListener("click", () => {
            const detailVal = detail.value.trim();
            if (!detailVal) {
                showToast("Harap isi detail laporan terlebih dahulu.");
                return;
            }

            const alasanText = `${reason.value}: ${detailVal}`;
            submitBtn.disabled = true;
            const originalText = submitBtn.textContent;
            submitBtn.textContent = "Mengirim...";

            fetch(`${SECONDIFY_BASE}/apps/controllers/user/laporkanProduk.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id_produk=${encodeURIComponent(product.id)}&alasan=${encodeURIComponent(alasanText)}`
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
                if (data.status === "success") {
                    detail.value = "";
                    closeModal();
                    showToast("Laporan barang berhasil dikirim! 🛡️");
                } else {
                    showToast(data.message || "Gagal mengirim laporan.");
                }
            })
            .catch(error => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
                showToast("Terjadi kesalahan jaringan.");
                console.error("Error submitting report:", error);
            });
        });
    }
}

// ─── TOAST ────────────────────────────────────────────────────────────────────
let toastTimer = null;
function showToast(msg) {
    const toast = document.getElementById("toast");
    if (toast) {
        toast.textContent = msg;
        toast.classList.add("show");
        if (toastTimer) clearTimeout(toastTimer);
        toastTimer = setTimeout(() => {
            toast.classList.remove("show");
        }, 2500);
    }
}

document.addEventListener("DOMContentLoaded", init);