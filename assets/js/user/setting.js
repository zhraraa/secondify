// ── Navigasi sidebar ─────────────────────────────
const navItems = document.querySelectorAll('.nav-item');
const pages    = document.querySelectorAll('.page');

function showPage(pageId) {
    pages.forEach(p => p.classList.remove('active'));
    navItems.forEach(n => n.classList.remove('active'));

    const targetPage = document.getElementById('page-' + pageId);
    const targetNav  = document.querySelector(`.nav-item[data-page="${pageId}"]`);

    if (targetPage) targetPage.classList.add('active');
    if (targetNav)  targetNav.classList.add('active');

    history.replaceState(null, '', '#' + pageId);
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

navItems.forEach(item => {
    item.addEventListener('click', (e) => {
        e.preventDefault();
        showPage(item.dataset.page);
    });
});

const hash       = window.location.hash.replace('#', '');
const validPages = ['edit-profil', 'alamat', 'keamanan', 'notifikasi', 'privasi', 'bantuan'];
showPage(hash && validPages.includes(hash) ? hash : 'edit-profil');

// ── Toast notifikasi ──────────────────────────────
function showToast(msg, type = 'success') {
    const existing = document.querySelector('.toast');
    if (existing) existing.remove();

    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.textContent = msg;
    toast.style.cssText = `
        position: fixed; bottom: 28px; right: 28px;
        background: ${type === 'success' ? '#6c5ce7' : '#e74c3c'}; color: white;
        padding: 12px 22px; border-radius: 12px;
        font-size: 14px; font-weight: 600;
        box-shadow: 0 6px 24px rgba(108,92,231,0.35);
        z-index: 9999; animation: slideIn 0.3s ease;
        font-family: 'Plus Jakarta Sans', sans-serif;
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

const style = document.createElement('style');
style.textContent = `@keyframes slideIn { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }`;
document.head.appendChild(style);

// ── Semua yang butuh DOM siap ─────────────────────
function initSettingPage() {

    // Cek query string untuk toast
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === 'editProfil') {
        showToast('✓ Profil berhasil disimpan!');
        history.replaceState(null, '', window.location.pathname + '#edit-profil');
    }
    if (urlParams.get('success') === 'tambahAlamat') {
        showToast('✓ Alamat berhasil ditambahkan!');
        history.replaceState(null, '', window.location.pathname + '#alamat');
    }
    if (urlParams.get('success') === 'ubahAlamat') {
        showToast('Alamat berhasil diubah!');
        history.replaceState(null, '', window.location.pathname + '#alamat');
    }
    if (urlParams.get('success') === 'hapusAlamat') {
        showToast('Alamat berhasil dihapus!');
        history.replaceState(null, '', window.location.pathname + '#alamat');
    }
    if (urlParams.get('success') === 'utamaAlamat') {
        showToast('Alamat utama berhasil diperbarui!');
        history.replaceState(null, '', window.location.pathname + '#alamat');
    }
    if (urlParams.get('error')) {
        showToast('✗ Terjadi kesalahan, coba lagi.', 'error');
    }

    // Modal Tambah Alamat
    const modalAlamat = document.getElementById('modalAlamat');
    const btnTambah   = document.getElementById('btnTambahAlamat');
    const btnBatal    = document.getElementById('btnBatalAlamat');
    const modalUbahAlamat = document.getElementById('modalUbahAlamat');
    const btnBatalUbahAlamat = document.getElementById('btnBatalUbahAlamat');
    const editButtons = document.querySelectorAll('.btn-ubah-alamat');

    if (btnTambah && modalAlamat) {
        btnTambah.addEventListener('click', () => {
            modalAlamat.style.display = 'flex';
        });
    }

    if (btnBatal && modalAlamat) {
        btnBatal.addEventListener('click', () => {
            modalAlamat.style.display = 'none';
        });
    }

    if (modalAlamat) {
        modalAlamat.addEventListener('click', (e) => {
            if (e.target === modalAlamat) modalAlamat.style.display = 'none';
        });
    }

    editButtons.forEach((button) => {
        button.addEventListener('click', () => {
            if (!modalUbahAlamat) return;

            document.getElementById('editIdAlamat').value = button.dataset.id;
            document.getElementById('editLabelAlamat').value = button.dataset.label;
            document.getElementById('editNamaPenerima').value = button.dataset.nama;
            document.getElementById('editNoHpPenerima').value = button.dataset.noHp;
            document.getElementById('editAlamatLengkap').value = button.dataset.alamat;
            document.getElementById('editKota').value = button.dataset.kota;
            document.getElementById('editProvinsi').value = button.dataset.provinsi;
            document.getElementById('editKodePos').value = button.dataset.kodePos;

            modalUbahAlamat.style.display = 'flex';
        });
    });

    if (btnBatalUbahAlamat && modalUbahAlamat) {
        btnBatalUbahAlamat.addEventListener('click', () => {
            modalUbahAlamat.style.display = 'none';
        });
    }

    if (modalUbahAlamat) {
        modalUbahAlamat.addEventListener('click', (e) => {
            if (e.target === modalUbahAlamat) modalUbahAlamat.style.display = 'none';
        });
    }

}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSettingPage);
} else {
    initSettingPage();
}
