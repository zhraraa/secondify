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
const validPages = ['edit-profil', 'keamanan', 'bantuan'];
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
    if (urlParams.get('success') === 'kirimBantuan') {
        showToast('Pesan bantuan berhasil dikirim!');
        history.replaceState(null, '', window.location.pathname + '#bantuan');
    }
    if (urlParams.get('error')) {
        showToast('✗ Terjadi kesalahan, coba lagi.', 'error');
    }

    // Ubah foto
    const btnUbahFoto  = document.getElementById('btnUbahFoto');
    const inputFoto    = document.getElementById('inputFoto');
    const btnSimpanFoto = document.getElementById('btnSimpanFoto');
    const formUbahFoto = document.getElementById('formUbahFoto');

    if (btnUbahFoto && inputFoto) {
        btnUbahFoto.addEventListener('click', () => inputFoto.click());

        inputFoto.addEventListener('change', () => {
            const file = inputFoto.files[0];
            if (!file) return;

            // Preview
            const reader = new FileReader();
            reader.onload = (e) => {
                const circle = document.querySelector('.avatar-circle');
                circle.innerHTML = `<img src="${e.target.result}" class="avatar-img" alt="Preview">`;
            };
            reader.readAsDataURL(file);

            btnUbahFoto.style.display = 'none';
            btnSimpanFoto.style.display = 'inline-flex';
        });
    }

    // Toast untuk ubah foto
    if (urlParams.get('success') === 'ubahFoto') {
        showToast('✓ Foto profil berhasil diperbarui!');
        history.replaceState(null, '', window.location.pathname + '#edit-profil');
    }
    if (urlParams.get('error') === 'formatFoto') {
        showToast('✗ Format file harus PNG atau JPG', 'error');
    }
    if (urlParams.get('error') === 'ukuranFoto') {
        showToast('✗ Ukuran file maks. 2MB', 'error');
    }
    if (urlParams.get('error') === 'uploadGagal') {
        showToast('✗ Upload gagal, coba lagi.', 'error');
    }

    const formUbahPassword = document.getElementById('formUbahPassword');
    const passwordBaru = document.getElementById('passwordBaru');
    const passwordBaruError = document.getElementById('passwordBaruError');

    if (formUbahPassword && passwordBaru && passwordBaruError) {
        const validasiPasswordBaru = () => {
            const kurangDariDelapan = passwordBaru.value.length > 0 && passwordBaru.value.length < 8;
            passwordBaruError.classList.toggle('show', kurangDariDelapan);
            return !kurangDariDelapan;
        };

        passwordBaru.addEventListener('input', validasiPasswordBaru);

        formUbahPassword.addEventListener('submit', (e) => {
            if (!validasiPasswordBaru()) {
                e.preventDefault();
                showToast('Password Harus Minimal 8 Karakter', 'error');
                passwordBaru.focus();
            }
        });
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSettingPage);
} else {
    initSettingPage();
}
