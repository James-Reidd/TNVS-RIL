document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("statusToggle");
    const statusText = document.getElementById("statusText");
    const onlineContent = document.getElementById("onlineContent");
    const offlineContent = document.getElementById("offlineContent");

    // Initial display based on default toggle state
    if (toggle.checked) {
        onlineContent.style.display = "block";
        offlineContent.style.display = "none";
    } else {
        onlineContent.style.display = "none";
        offlineContent.style.display = "block";
    }

    toggle.addEventListener("change", function() {
        const newStatus = toggle.checked ? "Online" : "Offline";
        statusText.textContent = newStatus;

        // Show/hide content
        if (toggle.checked) {
            onlineContent.style.display = "block";
            offlineContent.style.display = "none";
        } else {
            onlineContent.style.display = "none";
            offlineContent.style.display = "block";
        }

        // Optional: send status to backend
        fetch("togglestatus.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `status=${newStatus}`
        })
        .then(response => response.text())
        .then(data => console.log("Server response:", data))
        .catch(err => console.error("Error:", err));
    });
});