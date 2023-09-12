
// Function to update location, time, and location name
function updateLocationAndTime() {
    // Geolocation script
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var location = "Latitude: " + latitude + ", Longitude: " + longitude;
            document.getElementById("location").textContent = location;

            // Reverse geocoding to get location name
            fetch(
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
                .then(response => response.json())
                .then(data => {
                    var locationName = data.display_name;
                    var locationNameElement = document.getElementById("locationName");
                    locationNameElement.innerHTML = `<i class='fas fa-map-marker'></i> ${locationName}`;
                })
                .catch(error => {
                    console.error("Error fetching location data:", error);
                    document.getElementById("locationName").textContent =
                        "Location data not available.";
                });
        });
    } else {
        document.getElementById("location").textContent = "Geolocation is not supported by this browser.";
    }

    // Time script
    function updateClock() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var ampm = hours >= 12 ? 'PM' : 'AM';

        // Convert to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // 0 should be displayed as 12
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        var timeString = hours + ":" + minutes + ":" + seconds + " " + ampm;
        document.getElementById("time").textContent = timeString;
    }

    // Update the clock every second
    setInterval(updateClock, 1000);

    // Initial update
    updateClock();
}

// Execute the update function when the DOM is fully loaded
document.addEventListener("DOMContentLoaded", updateLocationAndTime);