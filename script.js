document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const hamburger = document.getElementById("hamburger");

    hamburger.addEventListener("click", () => {
        sidebar.classList.toggle("open");
    });
});

function loadContent(event, page) {
    event.preventDefault(); // ป้องกันไม่ให้รีเฟรชหน้า
    fetch(page)
        .then(response => response.text())
        .then(data => {
            document.getElementById("content").innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
}
