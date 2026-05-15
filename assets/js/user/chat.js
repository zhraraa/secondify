const SECONDIFY_BASE = `${window.location.origin}${window.location.pathname.split("/apps/")[0]}`;
const kategoriUrl = (params = "") => `${SECONDIFY_BASE}/apps/views/user/kategori.php${params}`;

function openChat(name) {
    document.getElementById("chatTitle").textContent = name;
    document.querySelectorAll(".chat-user").forEach(item => item.classList.remove("active"));
    const selected = [...document.querySelectorAll(".chat-user")]
        .find(item => item.querySelector(".name")?.textContent === name);
    if (selected) selected.classList.add("active");

    document.getElementById("messages").innerHTML = `
        <div class="msg sender">Halo kak</div>
        <div class="msg receiver">Iya kak, ada yang bisa dibantu?</div>
    `;
}

function sendMessage() {
    const input = document.getElementById("msgInput");
    const message = input.value.trim();
    if (!message) return;

    const bubble = document.createElement("div");
    bubble.className = "msg sender";
    bubble.textContent = message;
    document.getElementById("messages").appendChild(bubble);
    input.value = "";
}

document.addEventListener("DOMContentLoaded", () => {
    

    if (searchInput) {
        searchInput.addEventListener("keydown", event => {
            if (event.key === "Enter" && event.target.value.trim()) {
                window.location.href = kategoriUrl(`?kat=semua&q=${encodeURIComponent(event.target.value.trim())}`);
            }
        });
    }

    if (msgInput) {
        msgInput.addEventListener("keydown", event => {
            if (event.key === "Enter") sendMessage();
        });
    }
});
