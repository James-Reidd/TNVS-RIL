function updateRider() {
    const name = document.getElementById("name").value.trim();
    const username = document.getElementById("username").value.trim();
    const contactNo = document.getElementById("contactNo").value.trim();
    const status = document.getElementById("status");

    fetch("update.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: 
            `role=rider&
            &name=${encodeURIComponent(name)}
            &username=${encodeURIComponent(username)}
            &contactNo=${encodeURIComponent(contactNo)}`
    })
    .then(response => response.text())
    .then(data => {
        status.style.display = "block";

        if (data.toLowerCase().includes("success")) {
            status.className = "status success";
            status.innerText = "✅ Changes saved successfully!";
        } else {
            status.className = "status error";
            status.innerText = "❌ Failed to save changes.";
        }
    })
    .catch(error => {
        status.style.display = "block";
        status.className = "status error";
        status.innerText = "⚠️ Something went wrong.";
        console.error(error);
    });
}

function updateDriver() {
    const name = document.getElementById("name").value.trim();
    const username = document.getElementById("username").value.trim();
    const contactNo = document.getElementById("contactNo").value.trim();
    const status = document.getElementById("status");

    fetch("update.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: 
            `role=driver&
            &name=${encodeURIComponent(name)}
            &username=${encodeURIComponent(username)}
            &contactNo=${encodeURIComponent(contactNo)}
            &role=driver`
    })
    .then(response => response.text())
    .then(data => {
        status.style.display = "block";

        if (data.toLowerCase().includes("success")) {
            status.className = "status success";
            status.innerText = "✅ Changes saved successfully!";
        } else {
            status.className = "status error";
            status.innerText = "❌ Failed to save changes.";
        }
    })
    .catch(error => {
        status.style.display = "block";
        status.className = "status error";
        status.innerText = "⚠️ Something went wrong.";
        console.error(error);
    });
}

document.getElementById("contactNo").addEventListener("input", function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});