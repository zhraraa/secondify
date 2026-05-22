const inputGambarBarang = document.getElementById("upload-foto");
const iconInputan = document.getElementById("image-plus");
const textUploadGambar = document.getElementById("textUploadGambar");

inputGambarBarang.addEventListener("change", function () {
    if (this.files && this.files.length > 0) {
        let file = this.files[0].name;
        if (file.length > 15) {
            file = file.substring(0, 12) + "...";
        }
        textUploadGambar.innerHTML = file;
    } else {
        textUploadGambar.innerHTML = "Tambah";
    }
})
