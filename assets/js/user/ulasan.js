let rating = 0;

function setRating(value) {
    rating = value;

    const stars = document.querySelectorAll("#stars span");
    stars.forEach((star, index) => {
        star.classList.toggle("active", index < value);
    });
}

function submitReview() {
    const text = document.getElementById("reviewText").value;

    if (rating === 0 || text === "") {
        alert("Isi rating dan ulasan!");
        return;
    }

    const list = document.getElementById("reviewList");

    const item = document.createElement("div");
    item.className = "review-item";

    item.innerHTML = `
        <div>Rating: ${"⭐".repeat(rating)}</div>
        <div>${text}</div>
    `;

    list.appendChild(item);

    // reset
    document.getElementById("reviewText").value = "";
    setRating(0);
}