const inputFoto = document.getElementById("fotoKTP");
const namaFoto = document.getElementById("namaFoto");

        inputFoto.addEventListener("change", function() {
            if(this.files && this.files.length > 0) {
                const file = this.files[0].name;
                namaFoto.innerHTML = file;
            } else {
                namaFoto.innerHTML = "Klik untuk unggah foto KTP";
            }
        });