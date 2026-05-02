// ── Navigasi sidebar ─────────────────────────────
const navItems = document.querySelectorAll('.nav-item');
const pages = document.querySelectorAll('.page');

function showPage(pageId) {
    pages.forEach(p => p.classList.remove('active'));
    navItems.forEach(n => n.classList.remove('active'));

    const targetPage = document.getElementById('page-' + pageId);
    const targetNav = document.querySelector(`.nav-item[data-page="${pageId}"]`);

    if (targetPage) targetPage.classList.add('active');
    if (targetNav) targetNav.classList.add('active');

    history.replaceState(null, '', '#' + pageId);

    window.scrollTo({ top: 0, behavior: 'smooth' });
}

navItems.forEach(item => {
    item.addEventListener('click', (e) => {
        e.preventDefault();
        showPage(item.dataset.page);
    });
});

const hash = window.location.hash.replace('#', '');
const validPages = ['edit-profil', 'alamat', 'keamanan', 'notifikasi', 'privasi', 'bantuan'];
if (hash && validPages.includes(hash)) {
    showPage(hash);
} else {
    showPage('edit-profil');
}

// ── Toast notifikasi ──────────────────────────────
function showToast(msg) {
    const existing = document.querySelector('.toast');
    if (existing) existing.remove();

    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.textContent = msg;
    toast.style.cssText = `
        position: fixed; bottom: 28px; right: 28px;
        background: #6c5ce7; color: white;
        padding: 12px 22px; border-radius: 12px;
        font-size: 14px; font-weight: 600;
        box-shadow: 0 6px 24px rgba(108,92,231,0.35);
        z-index: 9999; animation: slideIn 0.3s ease;
        font-family: 'Plus Jakarta Sans', sans-serif;
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

document.querySelectorAll('.btn-simpan').forEach(btn => {
    btn.addEventListener('click', () => {
        showToast('✓ Perubahan berhasil disimpan!');
    });
});

const style = document.createElement('style');
style.textContent = `@keyframes slideIn { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }`;
document.head.appendChild(style);