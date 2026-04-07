document.addEventListener("DOMContentLoaded", function () {

    const toggle = document.getElementById("statusToggle");
    const statusText = document.getElementById("statusText");
    const onlineContent = document.getElementById("onlineContent");
    const offlineContent = document.getElementById("offlineContent");

    function updateUI(data) {
        if (data === "ONLINE") {
            statusText.innerText = "Online";
            toggle.checked = true;
            onlineContent.style.display = "block";
            offlineContent.style.display = "none";
        } else {
            statusText.innerText = "Offline";
            toggle.checked = false;
            onlineContent.style.display = "none";
            offlineContent.style.display = "block";
        }
    }

    // Toggle click
    toggle.addEventListener("change", function() {
        fetch("togglestatus.php", { method: "POST" })
        .then(res => res.text())
        .then(data => {
            updateUI(data);
        });
    });

    // Load on refresh
    fetch("getstatus.php")
    .then(res => res.text())
    .then(data => {
        updateUI(data);
    });

});

function loadRideRequests() {
  fetch("getPendingRides.php")
    .then(res => res.text())
    .then(html => {
      document.getElementById("rideRequests").innerHTML = html;
      attachAcceptDeclineEvents(); // add click listeners
    });
}

// Load every 5 seconds
setInterval(loadRideRequests, 5000);

// Initial load
loadRideRequests();

// Attach Accept/Decline button actions
function attachAcceptDeclineEvents() {
  document.querySelectorAll(".accept-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const rideId = btn.dataset.id;
      fetch("updateRideStatus.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: `id=${rideId}&status=accepted`
      }).then(() => btn.closest(".ride").remove());
    });
  });

  document.querySelectorAll(".decline-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const rideId = btn.dataset.id;
      fetch("updateRideStatus.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: `id=${rideId}&status=declined`
      }).then(() => btn.closest(".ride").remove());
    });
  });
}