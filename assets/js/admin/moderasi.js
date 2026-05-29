// ─── Flash message dari session (muncul otomatis setelah redirect) ───
window.addEventListener('DOMContentLoaded', () => {
    if (typeof flashMsg !== 'undefined' && flashMsg) {
        showToast(flashMsg);
    }
});

// ─── TAB SWITCHING ───────────────────────────────────────────────────
function switchModTab(btn, tabId) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
    document.getElementById('mod-laporan').style.display = 'none';

    if (tabId === 'laporan') {
        document.getElementById('mod-laporan').style.display = 'block';
    } else {
        document.getElementById(tabId).classList.add('active');
    }
}

// ─── MODAL BANTUAN ───────────────────────────────────────────────────
function bukaModalBalas(idUtama, deskripsi) {
    document.getElementById('inputIdBantuan').value = idUtama;
    document.getElementById('textKeluhanUser').innerText = 'Keluhan: ' + deskripsi;
    document.querySelector('#modalBalas textarea').value = '';
    document.getElementById('modalBalas').style.display = 'flex';
}

function tutupModalBalas() {
    document.getElementById('modalBalas').style.display = 'none';
}

// ─── MODAL BARANG ────────────────────────────────────────────────────
function bukaModalBarang(idUtama, deskripsi) {
    document.getElementById('inputIdBarang').value = idUtama;
    document.getElementById('textDetailBarang').innerText = deskripsi;
    document.querySelector('input[name="jenis_tindakan"][value="turunkan"]').checked = true;
    document.getElementById('modalAksiBarang').style.display = 'flex';
}

function tutupModalBarang() {
    document.getElementById('modalAksiBarang').style.display = 'none';
}

// ─── TOAST ───────────────────────────────────────────────────────────
function showToast(msg) {
    const toast = document.getElementById('toast');
    if (!toast) return;
    toast.innerText = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3000);
}