function gantiHalamanKelola(pilihan, elemenTombol){
    const barangAktif = document.getElementById('wadahBarangAktif');
    const barangTerjual = document.getElementById('wadahBarangTerjual');
    const aktif = document.getElementById('btnAktif');
    const terjual = document.getElementById('btnTerjual');

    if ( pilihan == 'barangTerjual' ){
        barangAktif.classList.add('hidden');
        barangTerjual.classList.remove('hidden');

        aktif.classList.remove('active');
        terjual.classList.add('active');
    } else {
        barangTerjual.classList.add('hidden');
        barangAktif.classList.remove('hidden');

        terjual.classList.remove('active');
        aktif.classList.add('active');
    };

    animasiGeser(elemenTombol);
}

function animasiGeser(tombol){
    const animasi = document.getElementById('kelola-bg-geser');

    animasi.style.width = tombol.offsetWidth + 'px';
    animasi.style.left = tombol.offsetLeft + 'px';
}

window.onload = function() {
    const aktif = document.getElementById('btnAktif');
    animasiGeser(aktif);
};

function bukaTutup(id_produk){
    const dropdown = document.getElementById('dropdown-' + id_produk);
    dropdown.classList.toggle('hidden');
}

function bukaModalUbah (elemenTombol){
    const id = elemenTombol.dataset.id;
    const nama = elemenTombol.dataset.nama;
    const harga = elemenTombol.dataset.harga;
    const kondisi = elemenTombol.dataset.kondisi;
    const kategori = elemenTombol.dataset.kategori;
    const kecamatan = elemenTombol.dataset.kecamatan;
    const deskripsi = elemenTombol.dataset.deskripsi;

    document.getElementById('kelolaBarang-editId').value = id;
    document.getElementById('kelolaBarang-NamaBarang').value = nama;
    document.getElementById('kelolaBarang-HargaBarang').value = harga;
    document.getElementById('kelolaBarang-KondisiBarang').value = kondisi;
    document.getElementById('kelolaBarang-kategoriBarang').value = kategori;
    document.getElementById('kelolaBarang-kecamatanBarang').value = kecamatan;
    document.getElementById('kelolaBarang-DeskripsiBarang').value = deskripsi;

    document.getElementById('modalUbah').classList.remove('hidden');
}

function bukaModalTandaiTerjual(elemenTombol){
    const idProduk = elemenTombol.dataset.id;
    window.location.href = `?tandaiSelesai=${idProduk}`
}

function tutupModal(idModal) {
    const modal = document.getElementById(idModal);
    
    modal.classList.add('hidden');
}


