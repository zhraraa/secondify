lucide.createIcons();

document.addEventListener("DOMContentLoaded", function () {

    // LOGIN
    const loginPassword =
        document.querySelector('input[name="password"]');

    const loginEye =
        document.querySelector('[data-lucide="eye"]');

    if(loginPassword && loginEye){

        loginEye.style.cursor = "pointer";

        loginEye.addEventListener("click", function(){

            loginPassword.type =
                loginPassword.type === "password"
                ? "text"
                : "password";

        });

    }

    // REGISTER
    const registerForm =
        document.querySelector('form');

    const password =
        document.querySelector('#password');

    const confirmPassword =
        document.querySelector('#confirmPassword');

    if(registerForm && password){

        registerForm.addEventListener("submit", function(e){

            const regex =
                /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$/;

            if(!regex.test(password.value)){

                alert(
                    "Password minimal 6 karakter dan harus mengandung huruf besar, huruf kecil, serta angka."
                );

                e.preventDefault();
                return;
            }

            if(
                confirmPassword &&
                password.value !== confirmPassword.value
            ){

                alert("Konfirmasi password tidak sama.");

                e.preventDefault();
            }

        });

    }

});