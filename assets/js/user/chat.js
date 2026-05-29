const SECONDIFY_BASE = `${window.location.origin}${window.location.pathname.split("/apps/")[0]}`;

function sendMessage(){

    const input = document.getElementById("msgInput");
    const pesan = input.value.trim();

    if(!pesan) return;

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

        if(data.trim() === "success"){

            input.value = "";

            loadMessages();
        }

    });

}

function loadMessages(){

    console.log("LOAD JALAN");

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

document.addEventListener("DOMContentLoaded", () => {

    document.getElementById("chatTitle").innerText = "Chat Penjual";

    loadChatList();
    loadMessages();

    setInterval(loadMessages, 3000);

    const msgInput = document.getElementById("msgInput");

    msgInput.addEventListener("keydown", function(e){

        if(e.key === "Enter"){
            sendMessage();
        }

    });

});
function loadChatList(){

    fetch(
        `${SECONDIFY_BASE}/apps/controllers/user/loadChatList.php`
    )
    .then(res => res.json())
    .then(data => {

        const list = document.getElementById("chatList");

        list.innerHTML = "";

        data.forEach(user => {

            list.innerHTML += `
                <div class="chat-user"
                    onclick="window.location='chat.php?id_produk=' + ID_PRODUK + '&id_penjual=' + user.id_user'">

                    <div class="avatar">
                        ${user.nama_user.charAt(0).toUpperCase()}
                    </div>

                    <div>
                        <div class="name">
                            ${user.nama_user}
                        </div>
                    </div>

                </div>
            `;
        });

    });

}