function registerRider() {
    console.log("Registering rider...");

    let name = document.getElementById("reg_name").value;
    let contact = document.getElementById("reg_contact").value;
    let username = document.getElementById("reg_username").value;
    let password = document.getElementById("reg_password").value;
    let truepassword = document.getElementById("reg_truepassword").value;

    // ✅ check empty fields
    if (!name || !contact || !username || !password || !truepassword) {
        alert("Please fill all fields");
        return;
    }

    // ✅ check password match
    if (password !== truepassword) {
        alert("Passwords do not match!");
        return;
    }
    //this is where we send the data to the server using fetch API 
    //this enables us to read user input safely without problems of special characters breaking the request
    fetch("register.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: 
            "role=rider" +
            "&name=" + encodeURIComponent(name) +
            "&contact=" + encodeURIComponent(contact) +
            "&username=" + encodeURIComponent(username) +
            "&password=" + encodeURIComponent(password)
    })
    .then(response => response.text())
    .then(data => {
        console.log("Response:", data); // debug
        const responseEl = document.getElementById("response");
        if (responseEl) responseEl.innerHTML = data;
        
       // deletes user input if registration is successful, 
       // but first we need to make sure the response is exactly what we expect,
       //  without any hidden characters or formatting issues that could cause a
       //  simple string comparison to fail
        let cleanData = data.trim();
        
        console.log("1. What JS is looking for : 'Registered successfully!'");
        console.log("2. What PHP actually sent : '" + cleanData + "'");
        console.log("3. Do they match exactly? : ", cleanData === "Registered successfully!");

        // 3. The bulletproof fallback check
        if (cleanData === "Registered successfully!" || cleanData.includes("Registered successfully!")) {
            console.log("4. SUCCESS! Clearing the form now...");
            
            document.getElementById("reg_name").value = "";
            document.getElementById("reg_contact").value = "";
            document.getElementById("reg_username").value = "";
            document.getElementById("reg_password").value = "";
            document.getElementById("reg_truepassword").value = "";
        } else {
            console.log("4. FAILED: The text did not match.");
        }
    })
    //.catch(...): This is your fallback. If the fetch fails entirely—for example,
    //  if the internet goes down, or the server crashes before answering—this 
    // block catches the error and prints it to the console so your whole app doesn't break.
    .catch(error => {
        console.error("Fetch error:", error);
    });
}

function registerDriver() {
    console.log("Registering driver...");
    
    // 1. Get the Driver-specific input fields
    let name = document.getElementById("driver_name").value;
    let contact = document.getElementById("driver_contact").value;
    let username = document.getElementById("driver_username").value;
    let password = document.getElementById("driver_password").value;
    let truepassword = document.getElementById("driver_truepassword").value;
    let plate_no = document.getElementById("driver_plate").value;
    let brand = document.getElementById("driver_brand").value;
    let model = document.getElementById("driver_model").value;
    let color = document.getElementById("driver_color").value;

    // 2. Check empty fields
    if (!name || !contact || !username || !password || !truepassword || !plate_no || !brand || !model || !color) {
        alert("Please fill all fields!");
        return;
    }

    // 3. Check password match
    if (password !== truepassword) {
        alert("Passwords do not match!");
        return;
    }

    // 4. Send the data (Notice the "role=driver" flag at the top of the body!)
    fetch("register.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: 
            "role=driver" + 
            "&name=" + encodeURIComponent(name) +
            "&contact=" + encodeURIComponent(contact) +
            "&username=" + encodeURIComponent(username) +
            "&password=" + encodeURIComponent(password) +
            "&plate_no=" + encodeURIComponent(plate_no) +
            "&brand=" + encodeURIComponent(brand) +
            "&model=" + encodeURIComponent(model) +
            "&color=" + encodeURIComponent(color)
    })
    .then(response => response.text())
    .then(data => {
        console.log("Response:", data); 
        
        const responseEl = document.getElementById("response");
        if (responseEl) responseEl.innerHTML = data;
        
        // 5. The Bulletproof Clear
        let cleanData = data.trim();
        
        if (cleanData === "Registered successfully!" || cleanData.includes("Registered successfully!")) {
            console.log("Success! Clearing driver form...");
            
            // Clear all the driver inputs
            document.getElementById("driver_name").value = "";
            document.getElementById("driver_contact").value = "";
            document.getElementById("driver_username").value = "";
            document.getElementById("driver_password").value = "";
            document.getElementById("driver_truepassword").value = "";
            document.getElementById("driver_plate").value = "";
            document.getElementById("driver_brand").value = "";
            document.getElementById("driver_model").value = "";
            document.getElementById("driver_color").value = "";
        }
    })
    .catch(error => {
        console.error("Fetch error:", error);
    });
}

const distances = {
  Cubao: { Marikina: 6, Manila: 10, Makati: 12, Taguig: 15, Caloocan: 14 },
  Marikina: { Cubao: 6, Manila: 12, Makati: 14, Taguig: 18, Caloocan: 16 },
  Manila: { Cubao: 10, Marikina: 12, Makati: 8, Taguig: 12, Caloocan: 9 },
  Makati: { Cubao: 12, Marikina: 14, Manila: 8, Taguig: 7, Caloocan: 15 },
  Taguig: { Cubao: 15, Marikina: 18, Manila: 12, Makati: 7, Caloocan: 20 },
  Caloocan: { Cubao: 14, Marikina: 16, Manila: 9, Makati: 15, Taguig: 20 }
};

function calculateFare() {
  const pickup = document.getElementById("pickup").value;
  const dropoff = document.getElementById("dropoff").value;

  if (!pickup || !dropoff) {
    alert("Please select both locations");
    return;
  }

  if (pickup === dropoff) {
    alert("Pickup and dropoff cannot be the same");
    return;
  }

  let distance = distances[pickup]?.[dropoff] || distances[dropoff]?.[pickup];

  if (!distance) {
    alert("Distance not available");
    return;
  }

  const baseFare = 40;
  const perKm = 10;
  const fare = baseFare + (distance * perKm);

  const driverList = document.getElementById("driverList");
  driverList.innerHTML = "<p>Loading drivers...</p>";

  fetch("getAvailableDrivers.php")
    .then(res => res.json())
    .then(drivers => {

      if (drivers.length === 0) {
        driverList.innerHTML = "<p>No drivers available</p>";
        return;
      }

      let html = "";

      drivers.forEach((driver, index) => {
        const finalFare = fare + (index * 10);
        const readableStatus = driver.status === "on" ? "Online" : "Offline";
        const initial = driver.name ? driver.name.charAt(0) : "?";

        html += `
          <div class="driver">
            <div class="driver-left">
              <div class="avatar">${initial}</div>
              <div>
                <strong>${driver.name}</strong>
                <p>${driver.brand} ${driver.model} • ${driver.color}</p>
                <small>Status: ${readableStatus}</sm/all>
              </div>
            </div>

            <div class="driver-right">
              <span class="fare">₱${finalFare}</span>
              <button class="request-btn">Request</button>
            </div>
          </div>
        `;
      });

    fetch("createRide.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
        pickup: pickup,
        dropoff: dropoff,
        fare: fare
        })
    });

      driverList.innerHTML = html;

      const panel = document.getElementById("driversPanel");
      panel.classList.remove("hidden");
      setTimeout(() => panel.classList.add("show"), 50);
    })
    .catch(err => {
      console.error("Error fetching drivers:", err);
      driverList.innerHTML = "<p>Error loading drivers</p>";
    });
}

setInterval(fetchRideRequests, 3000); // every 3 seconds

async function fetchRideRequests() {
  const res = await fetch("getRideRequests.php");
  const rides = await res.json();

  renderRideRequests(rides);
}

function renderRideRequests(rides) {
  const container = document.getElementById("rideRequests");
  container.innerHTML = "";

  rides.forEach(ride => {
    container.innerHTML += `
      <div class="ride">
        <strong>₱${ride.fare}</strong>
        <p>Pickup: ${ride.pickup}</p>
        <p>Dropoff: ${ride.dropoff}</p>

        <button onclick="acceptRide(${ride.id})">Accept</button>
        <button onclick="declineRide(${ride.id})">Decline</button>
      </div>
    `;
  });
}

function acceptRide(id) {
  updateRide(id, "accepted");
}

function declineRide(id) {
  updateRide(id, "declined");
}

function updateRide(id, status) {
  fetch("updateRide.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      ride_id: id,
      status: status
    })
  });
}