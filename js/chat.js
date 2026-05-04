function sendMessage() {
    const input = document.getElementById("msgInput");
    const msg = input.value.trim();

    if (msg === "") return;

    const messages = document.getElementById("messages");

    const newMsg = document.createElement("div");
    newMsg.className = "msg sender";
    newMsg.innerText = msg;

    messages.appendChild(newMsg);

    input.value = "";

    messages.scrollTop = messages.scrollHeight;
}

function openChat(name) {
    document.getElementById("chatTitle").innerText = name;

    const users = document.querySelectorAll(".chat-user");
    users.forEach(u => u.classList.remove("active"));

    event.currentTarget.classList.add("active");
}