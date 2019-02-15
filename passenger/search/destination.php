<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
  </head>
  <body>

     <div class="container-fluid">
      <div class="card mb-3">
     
    <!--The div element for the map -->
    <div id="map"></div>
    <script>

      // global scope

   
      var polyu = {lat: 22.304691, lng: 114.179596};
      var startingLocation = {lat: 22.304691, lng: 114.179596};
    

// Initialize and add the map
function initMap() {
  // The location of Uluru
  var uluru = {lat: 22.304691, lng: 114.179596};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 17, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
  var infoWindow = new google.maps.InfoWindow;
  var directionsDisplay = new google.maps.DirectionsRenderer;
  var directionsService = new google.maps.DirectionsService;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
          // startingLocation.lat = pos.lat;
          // startingLocation.lng = pos.lng;
          // console.log(tartingLocation.lat);
          // console.log(tartingLocation.lng);

  


            var geocoder = new google.maps.Geocoder;
            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            // infoWindow.open(map);
            map.setCenter(pos);

            directionsDisplay.setMap(map);
calculateAndDisplayRoute(directionsService, directionsDisplay);

            geocoder.geocode({'location': pos}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
        
          
           document.getElementById("startingLocation").innerHTML = results[0].formatted_address;
           console.log("results[0].formatted_address");
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });


          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

        var input = document.getElementById('destination');
      var autocomplete = new google.maps.places.Autocomplete(input);


      autocomplete.bindTo('bounds', map);
      autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

      //  function geocodeLatLng(geocoder, map, infowindow) {
      //   var input = document.getElementById('latlng').value;
      //   var latlngStr = input.split(',', 2);
      //   var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
      //   geocoder.geocode({'location': latlng}, function(results, status) {
      //     if (status === 'OK') {
      //       if (results[0]) {
      //         map.setZoom(11);
      //         var marker = new google.maps.Marker({
      //           position: latlng,
      //           map: map
      //         });
      //         infowindow.setContent(results[0].formatted_address);
      //         infowindow.open(map, marker);
      //       } else {
      //         window.alert('No results found');
      //       }
      //     } else {
      //       window.alert('Geocoder failed due to: ' + status);
      //     }
      //   });
      // }

      
  function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var selectedMode = 'DRIVING';
        var destination = document.getElementById("destination").value;

        console.log("calculateAndDisplayRoute: "+ startingLocation.lat);

        directionsService.route({

         origin: {lat: startingLocation.lat, lng: startingLocation.lng }, // Haight.
         // console.log(starting);
          destination: {lat: 22.306209, lng: 114.165987},  // Ocean Beach.
          // Note that Javascript allows us to access the constant
          // using square brackets and a string value as its
          // "property."
          travelMode: google.maps.TravelMode[selectedMode]
        }, function(response, status) {
          if (status == 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
          <div class="card-body">
           <h5 class="card-title">Welcome to Weber</h5>
          <!-- <p class="card-text">Allow us to use location services to find your pickup address automatically.</p> -->
            <button type="button" style="text-align:left" class="btn btn-lg btn-block btn-outline-dark">Starting:<span id="startingLocation"></span></button>
          <!--  <button type="button" style="text-align:left" class="btn btn-lg btn-block btn-outline-dark">Destination: </button> -->
           <form>
            <div class="form-group">
              <input type="text"  class="form-control form-control-lg" id="destination" placeholder="Destination:">
            </div>
          </form>
           <button class="btn btn-info"" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Advanced options
            </button>
           </div>
           
           
          
          <div class="collapse" id="collapseExample">
          <div class="card card-body">
    <form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Pick up time</label>
      <div>

      <input id="appt-time" type="time" name="appt-time">
    </div>
      <!-- <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> -->
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Tips</label>
      <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">$</span>
  </div>
  <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
  <div class="input-group-append">
    <span class="input-group-text">.00</span>
  </div>
</div>
      <!-- <input type="password" class="form-control" id="inputPassword4" placeholder="Password"> -->

    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
       Free toll
      </label>
    </div>
  </div>
  <!-- <button type="submit" class="btn btn-primary">Sign in</button> -->
</form>
  </div>
</div>
            <button type="button" class="btn btn-secondary">Next</button>
          </div>
        </div>
 <!-- <div class="container-fluid"> -->
      </div>

    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDQSwfy3WYNrr2lOvQTPfbGHVHpPxuUus&libraries=places&callback=initMap"
        async defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>