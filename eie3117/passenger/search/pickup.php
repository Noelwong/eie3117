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
     
          <div class="card-body">
           <h5 class="card-title">Welcome to Weber</h5>
   
              <div id="locationField">
              <input type="text"  class="form-control form-control-lg" id="startingLocation" placeholder="Starting:">
            
           
              <input type="text"  class="form-control form-control-lg" id="destination" placeholder="Destination:">
            </div>

           </div>
            <button type="button" class="btn btn-secondary">Next</button>
          </div>
        </div>
 <!-- <div class="container-fluid"> -->
      </div>
  
 <script>


function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  var autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'));

  var autocomplete2 = new google.maps.places.Autocomplete(
      document.getElementById('startingLocation'));

  var autocomplete3 = new google.maps.places.Autocomplete(
      document.getElementById('destination'));
 
}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDQSwfy3WYNrr2lOvQTPfbGHVHpPxuUus&libraries=places&callback=initAutocomplete"
        async defer></script>
  </body>
</html>