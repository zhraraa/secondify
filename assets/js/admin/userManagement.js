// assets/js/admin/userManagement.js

/**
 * Fungsi Client-side Search & Filter Dropdown (Real-time di Tabel)
 */
function filterUsers() {
    const keyword = document.getElementById('userSearch').value.toLowerCase();
    const roleFilter = document.getElementById('roleFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;
    
    const rows = document.querySelectorAll('#userTbody tr');
    let visibleCount = 0;

    rows.forEach(row => {
        // Cek data atribut di tag <tr>
        const role = row.getAttribute('data-role');
        const status = row.getAttribute('data-status');
        
        // Ambil teks nama, email, dan username di dalam baris
        const textContent = row.textContent.toLowerCase();

        const matchKeyword = textContent.includes(keyword);
        const matchRole = roleFilter === "" || role === roleFilter;
        const matchStatus = statusFilter === "" || status === statusFilter;

        if (matchKeyword && matchRole && matchStatus) {
            row.style.display = "";
            visibleCount++;
        } else {
            row.style.display = "none";
        }
    });

    // Update teks jumlah data yang tampil
    document.getElementById('user-count').innerText = `Menampilkan ${visibleCount} pengguna`;
}

/**
 * AJAX Mencurigakan/Mengubah Status Akun (Bekukan / Aktifkan)
 */
function toggleUserStatus(idUser, action) {
    const confirmMsg = (action === 'freeze') 
        ? "Apakah Anda yakin ingin MEMBEKUKAN akun ini?" 
        : "Apakah Anda yakin ingin MENGAKTIFKAN kembali akun ini?";

    if (confirm(confirmMsg)) {
        const formData = new FormData();
        formData.append('id_user', idUser);
        formData.append('action', action);

        fetch('../../controllers/admin/processUserStatus.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showToast(data.message);
                // Refresh halaman setelah 1.2 detik biar status badge langsung berubah
                setTimeout(() => { location.reload(); }, 1200);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast("Terjadi kesalahan koneksi sistem.");
        });
    }
}

/**
 * Toast Notification global
 */
function showToast(msg) {
    const toast = document.getElementById('toast');
    if (toast) {
        toast.innerText = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3000);
    }
}
