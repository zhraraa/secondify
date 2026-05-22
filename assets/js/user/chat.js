const SECONDIFY_BASE = `${window.location.origin}${window.location.pathname.split("/apps/")[0]}`;
const kategoriUrl = (params = "") => `${SECONDIFY_BASE}/apps/views/user/kategori.php${params}`;
const CHAT_KEY = "secondifyChats";

let activeSeller = "";

function getChats() {
    try {
        return JSON.parse(localStorage.getItem(CHAT_KEY)) || {};
    } catch (error) {
        return {};
    }
}

function saveChats(chats) {
    localStorage.setItem(CHAT_KEY, JSON.stringify(chats));
}

function sellerInitial(name) {
    return name.trim().charAt(0).toUpperCase() || "S";
}

function escapeHTML(value) {
    return String(value)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function defaultMessages() {
    return [
        { from: "buyer", text: "Halo kak" },
        { from: "seller", text: "Iya kak, ada yang bisa dibantu?" },
    ];
}

function ensureChat(seller, initialMessage = "") {
    const chats = getChats();
    if (!chats[seller]) {
        chats[seller] = defaultMessages();
    }

    if (initialMessage && !chats[seller].some(msg => msg.text === initialMessage)) {
        chats[seller].push({ from: "buyer", text: initialMessage });
    }

    saveChats(chats);
}

function renderChatList() {
    const chats = getChats();
    const sellers = Object.keys(chats);
    const list = document.getElementById("chatList");

    if (sellers.length === 0) {
        list.innerHTML = `<div class="empty-chat">Belum ada chat.</div>`;
        return;
    }

    list.innerHTML = sellers.map(seller => {
        const messages = chats[seller] || [];
        const lastMessage = messages[messages.length - 1]?.text || "Mulai percakapan";
        return `
            <div class="chat-user ${seller === activeSeller ? "active" : ""}" data-seller="${escapeHTML(seller)}">
                <div class="avatar">${escapeHTML(sellerInitial(seller))}</div>
                <div>
                    <div class="name">${escapeHTML(seller)}</div>
                    <div class="last-msg">${escapeHTML(lastMessage)}</div>
                </div>
            </div>
        `;
    }).join("");

    list.querySelectorAll(".chat-user").forEach(item => {
        item.addEventListener("click", () => openChat(item.dataset.seller));
    });
}

function openChat(name) {
    activeSeller = name;
    document.getElementById("chatTitle").textContent = name;
    renderChatList();
    renderMessages();
}

function renderMessages() {
    const chats = getChats();
    const messages = chats[activeSeller] || [];
    const box = document.getElementById("messages");

    box.innerHTML = messages.map(message => {
        const className = message.from === "buyer" ? "sender" : "receiver";
        return `<div class="msg ${className}">${escapeHTML(message.text)}</div>`;
    }).join("");
    box.scrollTop = box.scrollHeight;
}

function sendMessage() {
    const input = document.getElementById("msgInput");
    const message = input.value.trim();
    if (!message || !activeSeller) return;

    const chats = getChats();
    chats[activeSeller] = chats[activeSeller] || defaultMessages();
    chats[activeSeller].push({ from: "buyer", text: message });
    saveChats(chats);

    input.value = "";
    renderChatList();
    renderMessages();
}

document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    const seller = params.get("seller") || "Toko Rizky";
    const initialMessage = params.get("message") || "";

    ensureChat(seller, initialMessage);
    openChat(seller);

    const searchInput = document.getElementById("searchInput");
    const msgInput = document.getElementById("msgInput");

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
