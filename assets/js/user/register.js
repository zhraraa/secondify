function register() {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirm = document.getElementById("confirm").value;
    const message = document.getElementById("message");

    if (name === "" || email === "" || password === "" || confirm === "") {
        message.style.color = "red";
        message.innerText = "Semua field harus diisi!";
        return;
    }

    if (!email.includes("@")) {
        message.style.color = "red";
        message.innerText = "Email tidak valid!";
        return;
    }

    if (password.length < 6) {
        message.style.color = "red";
        message.innerText = "Password minimal 6 karakter!";
        return;
    }

    if (password !== confirm) {
        message.style.color = "red";
        message.innerText = "Password tidak sama!";
        return;
    }

    message.style.color = "green";
    message.innerText = "Registrasi berhasil! 🎉";
}