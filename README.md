# eie3117

## 1. $_SESSION variable
 - [username] // (username) // current login user<br>
 - [loggedin] // true/false // logged in or not
 - [id] // (id) // current lodin user's id
 - [verified] // 1/0 // verified account or not
 - [requestIdendity] // passenger/driver // current request indentity
 - [status] // 1-pending, 2-accepted, 3-started ride // current request status
 - [driver] // ture/false // current user registered driver or not
 - ~~current request identifier~~
   - ~~[passenger]~~
   - ~~[startingLocation_addr]~~
   - ~~[destination_addr]~~
   - ~~[pickupTime]~~
   - ~~[freeToll]~~
   - ~~[tips]~~
   - ~~[status] // 1-pending, 2-accepted, 3-started ride~~
   - ~~[totalcharge]~~
   
## 2. database setup (database: eie3117)
  - drivers
    - username, carClass, carModel, carPlateNum, profileImg (*photo address)
  - history
    - requestId, passengerName, driverName, startingLocation (*address), destinationLocation (*address), pickupTime (*date+time), tips, freeToll, status (*1-confirmed, 2-cancelled, 3-started, 4-completed)
  - passenger
    - username, homeLocation, workLocation
  - pending
    - pendingId, passenger, startingLocation_addr, startingLocation_placeId, destination_addr, destination_placeId, pickupTime, freeToll, tips
  - users
    - userId, username, password (*hash), phoneNumber, email, verified, verfication_code, created_at

## 3. unfinish function
 - upload and display profile image
 - calculate route distance 
 - calculate total charge
 - free toll option
 - better UI (history, current request)
