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
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var uluru = {lat: 22.304691, lng: 114.179596};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 17, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
}
    </script>
          <div class="card-body">
           <h5 class="card-title">Use location services</h5>
          <p class="card-text">Allow us to use location services to find your pickup address automatically.</p>
             <button  onclick="window.location.href='search/destination.php'" type="button" class="btn btn-primary btn-info btn-lg btn-block" >USE LOCATION SERVICES</button>
              <button onclick="window.location.href='search/pickup.php'"type="button" class="btn btn-secondary btn-lg btn-block">TYPE PICK UP ADDRESS</button>
           </div>
          </div>
        </div>
 <!-- <div class="container-fluid"> -->
      </div>

    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDQSwfy3WYNrr2lOvQTPfbGHVHpPxuUus&callback=initMap">
    </script>
  </body>
</html>