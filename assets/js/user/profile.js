function gantiHalaman(pilihan, elemenTombol){ //mainin pergantian halamannya
    const produk = document.getElementById('wadahProduk');
    const ulasan = document.getElementById('wadahUlasan');
    const tombolProduk = document.getElementById('btnProduk');
    const tombolUlasan = document.getElementById('btnUlasan');

    if (pilihan === 'ulasan'){
        produk.classList.add('hidden')
        ulasan.classList.remove('hidden')

        tombolUlasan.classList.add('active')
        tombolProduk.classList.remove('active')
    } else {
        produk.classList.remove('hidden');
        ulasan.classList.add('hidden');
        
        tombolProduk.classList.add('active');
        tombolUlasan.classList.remove('active');
    }

    geserSlider(elemenTombol);
}

function geserSlider(tombol){ //kalo ini animasi geser" buat di button atas nya itu
    const geser = document.getElementById('profile-bg-geser');

    geser.style.width = tombol.offsetWidth + 'px';
    geser.style.left = tombol.offsetLeft + 'px';
}

window.onload = function() {
    const btnProduk = document.getElementById('btnProduk');
    geserSlider(btnProduk);
};