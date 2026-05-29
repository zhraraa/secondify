
/**
 * Mengatur perpindahan tab (Menunggu, Disetujui, Ditolak)
 */
function switchVerifTab(btn, tabId) {
    // Hapus class active dari semua tombol tab
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    // Tambahkan class active ke tombol yang sedang diklik
    btn.classList.add('active');
    
    // Tampilkan kontainer tab yang sesuai dan sembunyikan yang lain
    document.getElementById('verif-menunggu').style.display = tabId === 'menunggu' ? 'block' : 'none';
    document.getElementById('verif-disetujui').style.display = tabId === 'disetujui' ? 'block' : 'none';
    document.getElementById('verif-ditolak').style.display = tabId === 'ditolak' ? 'block' : 'none';
}

/**
 * Membuka Modal Review dan Mengisi Data Secara Dinamis dari Database
 */
function openVerifModal(nama, email, toko, catatan, tgl, foto, idPengajuan) {
    document.getElementById('m-id-pengajuan').value = idPengajuan;
    document.getElementById('m-nama').innerText = nama;
    document.getElementById('m-email').innerText = email;
    document.getElementById('m-toko').innerText = toko;
    document.getElementById('m-kategori').innerText = catatan;
    document.getElementById('m-tgl').innerText = tgl;
    document.getElementById('m-foto-nama').innerText = foto;
    
    // Tampilkan modal overlay
    document.getElementById('verifModal').style.display = 'flex';
}

/**
 * Menutup Modal Review dan Reset Textarea Alasan
 */
function closeVerifModal() {
    document.getElementById('verifModal').style.display = 'none';
    document.getElementById('m-alasan').value = '';
}

/**
 * Menampilkan Toast Notification Ringan
 */
function showToast(msg) {
    const toast = document.getElementById('toast');
    if (toast) {
        toast.innerText = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3000);
    }
}

/**
 * Menyutujui Pengajuan Toko (Approve)
 */
function approveApplicant() {
    const idPengajuan = document.getElementById('m-id-pengajuan').value;
    
    if (!idPengajuan) {
        showToast("ID Pengajuan tidak ditemukan!");
        return;
    }

    if (confirm("Apakah Anda yakin ingin menyetujui dan memverifikasi toko ini?")) {
        // Siapkan data form untuk dikirim lewat POST
        const formData = new FormData();
        formData.append('id_pengajuan', idPengajuan);
        formData.append('action', 'approve');

        // Kirim data ke backend menggunakan Fetch API (AJAX)
        fetch('../../controllers/admin/processVerification.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                closeVerifModal();
                showToast(data.message);
                // Refresh halaman otomatis setelah 1.5 detik agar perubahan tab kelihatan
                setTimeout(() => { location.reload(); }, 1500);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast("Terjadi kesalahan sistem.");
        });
    }
}

/**
 * Menolak Pengajuan Toko (Reject)
 */
function rejectApplicant() {
    const idPengajuan = document.getElementById('m-id-pengajuan').value;
    const alasan = document.getElementById('m-alasan').value.trim();

    if (!idPengajuan) {
        showToast("ID Pengajuan tidak ditemukan!");
        return;
    }

    if (alasan === "") {
        alert("Mohon isi alasan penolakan terlebih dahulu!");
        document.getElementById('m-alasan').focus();
        return;
    }

    if (confirm("Apakah Anda yakin ingin menolak pengajuan toko ini?")) {
        const formData = new FormData();
        formData.append('id_pengajuan', idPengajuan);
        formData.append('action', 'reject');
        formData.append('alasan', alasan);

        fetch('../../controllers/admin/processVerification.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                closeVerifModal();
                showToast(data.message);
                setTimeout(() => { location.reload(); }, 1500);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast("Terjadi kesalahan sistem.");
        });
    }
}

// ... (Fungsi switchVerifTab, openVerifModal, closeVerifModal, dan showToast kemarin tetep biarin aja di bawahnya)