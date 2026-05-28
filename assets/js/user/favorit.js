const SECONDIFY_BASE = `${window.location.origin}${window.location.pathname.split("/apps/")[0]}`;
const IMAGE_VERSION = "20260511-2";
const WISHLIST_KEY = "secondifyWishlist";

function imageUrl(src) {
    if (!src || src.startsWith("http") || src.startsWith("/")) return src;
    return `${SECONDIFY_BASE}/assets/images/${src.replace(/^(\.\.\/)?img\//, "")}?v=${IMAGE_VERSION}`;
}

function getWishlist() {
    try {
        return JSON.parse(localStorage.getItem(WISHLIST_KEY)) || [];
    } catch (error) {
        return [];
    }
}

function saveWishlist(items) {
    localStorage.setItem(WISHLIST_KEY, JSON.stringify(items));
}

function escapeHTML(value) {
    return String(value)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function detailUrl(item) {
    const fallback = `${SECONDIFY_BASE}/apps/controllers/user/detailController.php?id=${encodeURIComponent(item.id)}`;
    return (item.detailUrl || fallback).replace("/apps/views/user/detail.php", "/apps/controllers/user/detailController.php");
}

function renderWishlist() {
    const items = getWishlist();
    const grid = document.getElementById("favoriteGrid");

    if (items.length === 0) {
        grid.innerHTML = `
            <div class="empty-favorite">
                Belum ada barang favorit.
            </div>
        `;
        return;
    }

    grid.innerHTML = items.map(item => `
        <div class="card" data-id="${item.id}">
            <a href="${escapeHTML(detailUrl(item))}">
                <img src="${escapeHTML(imageUrl(item.gambar))}" alt="${escapeHTML(item.nama)}">
            </a>
            <h3>${escapeHTML(item.nama)}</h3>
            <p>Rp ${Number(item.harga).toLocaleString("id-ID")}</p>
            <div class="favorite-meta">${escapeHTML(item.lokasi || "Bandar Lampung")} · ${escapeHTML(item.seller || "Secondify Seller")}</div>
            <button type="button" onclick="removeFavorite(${Number(item.id)})">Hapus</button>
        </div>
    `).join("");
}

function removeFavorite(id) {
    saveWishlist(getWishlist().filter(item => Number(item.id) !== Number(id)));
    renderWishlist();
}

function removeItem(btn) {
    const card = btn.closest(".card");
    if (!card) return;
    removeFavorite(card.dataset.id);
}

document.addEventListener("DOMContentLoaded", renderWishlist);
