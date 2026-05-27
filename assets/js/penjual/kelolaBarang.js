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