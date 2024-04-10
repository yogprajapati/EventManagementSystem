
function populateCities() {
    var stateSelect = document.getElementById("stateSelect");
    var citySelect = document.getElementById("citySelect");
    var selectedState = stateSelect.value;

    // Clear previous options
    citySelect.innerHTML = "";

    if (selectedState === "Gujarat") {
        var cities = ["Ahmedabad", "Surat", "Vadodara", "Rajkot", "Gandhinagar", "Bhavnagar", "Junagadh", "Anand", "Jamnagar"];
    } else if (selectedState === "Maharashtra") {
        var cities = ["Mumbai", "Pune", "Nagpur", "Nashik", "Thane", "Aurangabad", "Solapur", "Kolhapur", "Amravati"];
    }
    // Add more states and their respective cities here

    // Populate the city dropdown
    cities.forEach(function (city) {
        var option = document.createElement("option");
        option.text = city;
        option.value = city.toLowerCase().replace(/\s+/g, ''); // Convert to lowercase and remove spaces
        citySelect.add(option);
    });
}


function populateVenues() {
    var venueSelect = document.getElementById("venueSelect");
    var selectedCity = document.getElementById("citySelect").value;
    var venues = [];
    
    // Dummy data for venues
    if (selectedCity === "ahmedabad") {
      venues = ["Venue 1", "Venue 2", "Venue 3"];
    } else if (selectedCity === "mumbai") {
      venues = ["Venue A", "Venue B", "Venue C"];
    }
    
    // Populate venues dropdown
    venueSelect.innerHTML = "<option value='select'>Select Venue</option>";
    venues.forEach(function(venue) {
      var option = document.createElement("option");
      option.text = venue;
      option.value = venue.toLowerCase().replace(/\s+/g, '');
      venueSelect.add(option);
    });
  }


  


