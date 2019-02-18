<?php
// Initialize the session
session_start();

// include '../../locations_model.php';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// $random = $_POST["id"];
// echo $random;

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
      var startingLocation_placeID = "";
      var destination_placeID ="";

   
      var polyu = {lat: 22.304691, lng: 114.179596};
      var startingLocation = "";

// Initialize and add the map
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    mapTypeControl: false,
    center: {lat: 22.304691, lng: 114.179596},
    zoom: 17
  });

       // HTML5 geolocation.
  if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var infoWindow = new google.maps.InfoWindow;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var directionsService = new google.maps.DirectionsService;
            var geocoder = new google.maps.Geocoder;
            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
            // startingLocation = pos;
            directionsDisplay.setMap(map);

            geocoder.geocode({'location': pos}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
           startingLocation= results[0].formatted_address;
           console.log(startingLocation);
            new AutocompleteDirectionsHandler(map);

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

     new AutocompleteDirectionsHandler(map);

}
  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
/**
 * @constructor
 */
function AutocompleteDirectionsHandler(map) {
  this.map = map;
  this.originPlaceId = null;
  this.destinationPlaceId = null;
  this.travelMode = 'DRIVING';
  this.directionsService = new google.maps.DirectionsService;
  this.directionsDisplay = new google.maps.DirectionsRenderer;
  this.directionsDisplay.setMap(map);

console.log("AutocompleteDirectionsHandler "+ startingLocation);
  document.getElementById('startingLocation-input').value = startingLocation;
  var originInput = document.getElementById('startingLocation-input');
  var destinationInput = document.getElementById('destination-input');
  var modeSelector = 'DRIVING';

  var originAutocomplete = new google.maps.places.Autocomplete(originInput);
  // Specify just the place data fields that you need.
  originAutocomplete.setFields(['place_id']);


  var destinationAutocomplete =
      new google.maps.places.Autocomplete(destinationInput);
  // Specify just the place data fields that you need.
  destinationAutocomplete.setFields(['place_id']);


  this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
  this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

  var input = document.getElementById("destination-input").value;
  var startingLocation_input = document.getElementById("startingLocation-input").value;

  var options = {}
  var autocomplete_new = new google.maps.places.Autocomplete(destinationInput, options);
  var autocomplete_new_startingLocation = new google.maps.places.Autocomplete(originInput, options);

//destination_LatLng
  autocomplete_new.addListener('place_changed', function() {
    var place = autocomplete_new.getPlace();
    var lat = place.geometry.location.lat();
    var lng = place.geometry.location.lng();
    document.getElementById("destination_lat").value = lat;
    document.getElementById("destination_lng").value = lng;
    console.log(lat);
    console.log(lng);
    });
//StartingLocation_LatLng
   autocomplete_new_startingLocation.addListener('place_changed', function() {
    var place = autocomplete_new_startingLocation.getPlace();
    var lat = place.geometry.location.lat();
    var lng = place.geometry.location.lng();
    document.getElementById("startingLocation_lat").value = lat;
    document.getElementById("startingLocation_lng").value = lng;
    console.log(lat);
    console.log(lng);
    })
  // this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
  // this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(
  //     destinationInput);
  // this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
}




// Sets a listener on a radio button to change the filter type on Places
// Autocomplete.
AutocompleteDirectionsHandler.prototype.setupClickListener = function(
    id, mode) {
  var radioButton = document.getElementById(id);
  var me = this;

  radioButton.addEventListener('click', function() {
    me.travelMode = mode;
    me.route();
  });
};

AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(
    autocomplete, mode) {
  var me = this;
  autocomplete.bindTo('bounds', this.map);

  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();

    if (!place.place_id) {
      window.alert('Please select an option from the dropdown list.');
      return;
    }
    if (mode === 'ORIG') {
      me.originPlaceId = place.place_id;
      startingLocation_placeID = place.place_id;

      document.getElementById("startingLocation_placeID").value = startingLocation_placeID;

      console.log(startingLocation_placeID);
    } else {
      me.destinationPlaceId = place.place_id;
      destination_placeID = place.place_id;
      console.log(startingLocation_placeID);

       document.getElementById("destination_placeID").value = destination_placeID;
    }
    me.route();
  });
};

AutocompleteDirectionsHandler.prototype.route = function() {
  if (!this.originPlaceId || !this.destinationPlaceId) {
    return;
  }
  var me = this;

  this.directionsService.route(
      {
        origin: {'placeId': this.originPlaceId},
        destination: {'placeId': this.destinationPlaceId},
        travelMode: this.travelMode
      },
      function(response, status) {
        if (status === 'OK') {
          me.directionsDisplay.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      });
};

// function saveData() {
            // var description = document.getElementById('manual_description').value;

// var url = window.location.href;
// var params = url.split('?ID=');
// var id = (params[1]);
//         $.ajax({
//         type:"POST",
//         url:"page.php",
//         data:{id:id},
//         success:function(result){
//         $("#content").html(result);
//         }
//         });

             // $login_session = $row['username']
             // var pickUpTime = document.getElementById('appt-time').value;
             // var tips = document.getElementById('tips').value;
             // var freeToll = document.getElementById('gridCheck').checked;

          //   console.log(startingLocation_placeID);
          //    console.log(destination_placeID);
          //    console.log(pickUpTime);
          //    console.log(tips);
          //    console.log(freeToll);

          // var url = '../../locations_model.php?add_location&startingLocation_placeID='+startingLocation_placeID+
          // '&destination_placeID='+ destination_placeID+ 
          // '&pickUpTime= '+pickUpTime +
          // '&tips=' + tips + 
          // '&freeToll=' + freeToll;

          //    console.log(url);
          //   downloadUrl(url, function(data, responseCode) {
          //       if (responseCode === 200  && data.length > 1) {
          //          alert("success!!!!");

          //       }else{
          //           console.log(responseCode);
          //           console.log(data);
          //           infowindow.setContent("<div style='color: red; font-size: 25px;'>Inserting Errors</div>");
          //       }
          //   });

   
        // }

         function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                    callback(request.responseText, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }

  

    </script>
<form action="../../locations_model.php" method="post">
          <div class="card-body">
           <h5 class="card-title">Welcome to Weber</h5>
          <p class="card-text">Allow us to use location services to find your pickup address automatically.</p>
              <input type="text"  class="form-control form-control-lg" id="startingLocation-input" name="startingLocation_addr" placeholder="Starting:">
              <input type="text"  class="form-control form-control-lg" id="destination-input" name="destination_addr" placeholder="Destination:">
      
          
           <button class="btn btn-info"" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Advanced options
            </button>
           </div>
           
  
          
          <div class="collapse" id="collapseExample">
          <div class="card card-body">


      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Pick up time</label>
          <div>
            <input id="appt-time"  type="time" name="pickUpTime" value="13:30">
          </div>
      <!-- <input type="email" class="form-control" id="inputEmail4" placeholder="Email"> -->
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Tips</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
            <input id="tips" name="tips" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
              <div class="input-group-append">
                <span class="input-group-text">.00</span>
              </div>
            </div>
      <!-- <input type="password" class="form-control" id="inputPassword4" placeholder="Password"> -->
          </div>
        </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck" name="freeToll" value="1">
      <label class="form-check-label" for="gridCheck">
       Free toll
      </label>
    </div>
  </div>
  <!-- <button type="submit" class="btn btn-primary">Sign in</button> -->

  </div>
</div>

<input id = "startingLocation_placeID" type="hidden" name="startingLocation_placeID" value="" ></input>
<input id = "destination_placeID"type="hidden" name="destination_placeID" value="" /></input>
<input id = "startingLocation_lat"type="hidden" name="startingLocation_lat" value="" /></input>
<input id = "startingLocation_lng"type="hidden" name="startingLocation_lng" value="" /></input>
<input id = "destination_lat"type="hidden" name="destination_lat" value="" /></input>
<input id = "destination_lng"type="hidden" name="destination_lng" value="" /></input>
            <button type="submit" name="request_submit" class="btn btn-secondary" >Next</button>
          </div>
        </div>
    
 <!-- <div class="container-fluid"> -->
      </div>
    </form>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDQSwfy3WYNrr2lOvQTPfbGHVHpPxuUus&libraries=places&callback=initMap&language=en-GB"
        async defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>