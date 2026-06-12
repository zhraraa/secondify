const SECONDIFY_BASE =
`${window.location.origin}${window.location.pathname.split("/apps/")[0]}`;


// ====================
// KIRIM PESAN
// ====================
function sendMessage(){

    const input =
    document.getElementById("msgInput");

    const pesan =
    input.value.trim();

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
    `id_produk=${ID_PRODUK || ''}` +
    `&id_penerima=${ID_PENJUAL}` +
    `&pesan=${encodeURIComponent(pesan)}`
        }
    )
    .then(res => res.text())
   .then(data => {

    console.log("KIRIM =", data);

    if(data.trim() === "success"){

        input.value = "";

        loadMessages();
        loadChatList();

    }

});
}



// ====================
// LOAD CHAT
// ====================
function loadMessages(){

    fetch(
        `${SECONDIFY_BASE}/apps/controllers/user/loadPesan.php?id_penjual=${ID_PENJUAL}`
    )
    .then(res => res.json())
    .then(data => {

        console.log("DATA CHAT =", data);
        console.log(data[0]);
        const box =
        document.getElementById("messages");

        box.innerHTML = "";

        data.forEach(msg => {

            let cls = "sender";

            if(Number(msg.id_pengirim) === Number(ID_PENJUAL)){
                cls = "receiver";
            }

            const div =
            document.createElement("div");

            div.className =
            `msg ${cls}`;

            div.textContent =
            msg.isi_pesan;

            box.appendChild(div);

        });

        box.scrollTop =
        box.scrollHeight;

    })
    .catch(err => console.log(err));

}


// ====================
// SIDEBAR CHAT
// ====================
function loadChatList(){

    fetch(
        `${SECONDIFY_BASE}/apps/controllers/user/loadChatList.php`
    )
    .then(res => res.json())
    .then(data => {

        const list =
        document.getElementById("chatList");

        list.innerHTML = "";

        data.forEach(chat => {

            list.innerHTML += `
                <div class="chat-user"
                onclick="window.location.href='chat.php?id_penjual=${chat.id_user}'">

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

    });

}



// ====================
// LOAD
// ====================
document.addEventListener("DOMContentLoaded", () => {

    loadChatList();

    if(ID_PENJUAL > 0){

        loadMessages();

        setInterval(
            loadMessages,
            3000
        );

    }

    const input =
    document.getElementById("msgInput");

    input.addEventListener(
        "keydown",
        function(e){

            if(e.key === "Enter"){

                sendMessage();

            }

        }
    );

});