// ── NAV ──
const navItems = document.querySelectorAll('.nav-item[data-page]');
const pages = document.querySelectorAll('.page');

const pageTitles = {
    dashboard: { title: 'Dashboard Admin', breadcrumb: 'Dashboard' },
    verifikasi: { title: 'Verifikasi Penjual', breadcrumb: 'Verifikasi Penjual' },
    user: { title: 'Manajemen User', breadcrumb: 'Manajemen User' },
    moderasi: { title: 'Moderasi & Laporan', breadcrumb: 'Moderasi & Laporan' },
};

navItems.forEach(item => {
    item.addEventListener('click', () => {
        const pageId = item.dataset.page;
        navItems.forEach(n => n.classList.remove('active'));
        item.classList.add('active');
        pages.forEach(p => p.classList.remove('active'));
        document.getElementById('page-' + pageId)?.classList.add('active');
        const info = pageTitles[pageId] || { title: pageId, breadcrumb: pageId };
        document.getElementById('topbar-title').textContent = info.title;
        document.getElementById('topbar-breadcrumb').textContent = info.breadcrumb;
    });
});

// ── TABS ──
function switchVerifTab(btn, tab) {
    document.querySelectorAll('#verif-tabs .tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    ['menunggu','disetujui','ditolak'].forEach(t => {
        document.getElementById('verif-' + t).style.display = t === tab ? '' : 'none';
    });
}

function switchModTab(btn, tab) {
    btn.parentElement.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    ['laporan','barang','selesai'].forEach(t => {
        document.getElementById('mod-' + t).style.display = t === tab ? '' : 'none';
    });
}

// ── MODAL VERIFIKASI ──
function openVerifModal(nama, email, toko, kategori, tgl) {
    document.getElementById('m-nama').textContent = nama;
    document.getElementById('m-email').textContent = email;
    document.getElementById('m-toko').textContent = toko;
    document.getElementById('m-kategori').textContent = kategori;
    document.getElementById('m-tgl').textContent = tgl;
    document.getElementById('verifModal').classList.add('open');
}

function closeVerifModal() {
    document.getElementById('verifModal').classList.remove('open');
}

function approveApplicant() {
    closeVerifModal();
    showToast('✅ Pengajuan disetujui! Penjual berhasil diverifikasi.');
}

function rejectApplicant() {
    closeVerifModal();
    showToast('❌ Pengajuan ditolak dan notifikasi dikirim.');
}

// Close modal when clicking overlay
document.getElementById('verifModal').addEventListener('click', function(e) {
    if (e.target === this) closeVerifModal();
});

// ── FILTER USER TABLE ──
function filterUsers() {
    const search = document.getElementById('userSearch').value.toLowerCase();
    const role = document.getElementById('roleFilter').value;
    const status = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('#userTbody tr');
    let count = 0;

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const rowRole = row.dataset.role;
        const rowStatus = row.dataset.status;
        const matchSearch = !search || text.includes(search);
        const matchRole = !role || rowRole === role;
        const matchStatus = !status || rowStatus === status;
        const show = matchSearch && matchRole && matchStatus;
        row.style.display = show ? '' : 'none';
        if (show) count++;
    });

    document.getElementById('user-count').textContent = `Menampilkan ${count} pengguna`;
}

// ── TOAST ──
function showToast(msg) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 2800);
}
