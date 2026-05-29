const SECONDIFY_BASE =
`${window.location.origin}${window.location.pathname.split("/apps/")[0]}`;


// =========================
// KIRIM PESAN
// =========================
function sendMessage(){

    const input = document.getElementById("msgInput");
    const pesan = input.value.trim();

    if(!pesan){
        return;
    }

    fetch(
        `${SECONDIFY_BASE}/apps/controllers/user/kirimPesan.php`,
        {
            method:"POST",
            headers:{
                "Content-Type":"application/x-www-form-urlencoded"
            },
            body:
                `id_produk=${ID_PRODUK}` +
                `&id_penerima=${ID_PENJUAL}` +
                `&pesan=${encodeURIComponent(pesan)}`
        }
    )
    .then(res => res.text())
    .then(data => {

        console.log(data);

        if(data.trim() === "success"){

            input.value = "";

            loadMessages();
            loadChatList();

        }

    })
    .catch(err => console.log(err));

}


// =========================
// LOAD PESAN
// =========================
function loadMessages(){

    fetch(
        `${SECONDIFY_BASE}/apps/controllers/user/loadPesan.php?id_produk=${ID_PRODUK}&id_penjual=${ID_PENJUAL}`
    )
    .then(res => res.json())
    .then(data => {

        const box = document.getElementById("messages");

        box.innerHTML = "";

        data.forEach(msg => {

            const cls =
                Number(msg.id_pengirim) === Number(ID_PENJUAL)
                ? "receiver"
                : "sender";

            box.innerHTML += `
                <div class="msg ${cls}">
                    ${msg.isi_pesan}
                </div>
            `;

        });

        box.scrollTop = box.scrollHeight;

    })
    .catch(err => console.log(err));

}


// =========================
// LOAD LIST CHAT
// =========================
function loadChatList(){

    fetch(
        `${SECONDIFY_BASE}/apps/controllers/user/loadChatList.php`
    )
    .then(res => res.json())
    .then(data => {

        const chatList = document.getElementById("chatList");

        chatList.innerHTML = "";

        data.forEach(chat => {

            chatList.innerHTML += `
                <div class="chat-user"
                    onclick="window.location.href='chat.php?id_produk=${chat.id_produk}&id_penjual=${chat.id_user}'">

                    <div class="avatar">
                        ${chat.nama_user.charAt(0).toUpperCase()}
                    </div>

                    <div>
                        <div class="name">
                            ${chat.nama_user}
                        </div>
                    </div>

                </div>
            `;

        });

    })
    .catch(err => console.log(err));

}


// =========================
// SAAT HALAMAN DIBUKA
// =========================
document.addEventListener("DOMContentLoaded", () => {

    console.log("ID_PRODUK =", ID_PRODUK);
    console.log("ID_PENJUAL =", ID_PENJUAL);

    document.getElementById("chatTitle").innerText =
    "Chat Penjual";

    loadChatList();
    loadMessages();

    setInterval(loadMessages, 3000);

    const msgInput =
    document.getElementById("msgInput");

    msgInput.addEventListener("keydown", function(e){

        if(e.key === "Enter"){
            sendMessage();
        }

    });

});