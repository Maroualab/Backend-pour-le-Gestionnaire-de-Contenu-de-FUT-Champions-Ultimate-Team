<?php 
include 'connect.php'; 


// $sql = "
// INSERT INTO 

//  ";

// $result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Add Player</title>
</head>
<body>


<form action="insert.php" method="post" class="form-control form-control-sm">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPlayerName">Player Name</label>
      <input type="text" class="form-control" id="playerName" placeholder="Player Name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPosition">Position</label>
      <input type="text" class="form-control" id="position" placeholder="Player Position">
    </div>
  </div>
  <div class="form-row">

  <div class="form-group col-md-6">
    <label for="photoUrl">Photo Url</label>
    <input type="url" class="form-control" id="PlayerPhoto" placeholder="url player's photo">
  </div>
  <div class="form-group col-md-3">
    <label for="nationality">Nationality</label>
    <input type="text" class="form-control" id="PlayerNationality" placeholder="player's nationality">
  </div>
  <div class="form-group col-md-3">
    <label for="flagUrl">Flag Url</label>
    <input type="url" class="form-control" id="nationalityFlag" placeholder="flag's URL">
  </div>
</div>
  
  <div class="form-row">
  <div class="form-group col-md-1 ">
    <label for="rating">Rating</label>
    <input type="number" class="form-control" id="rating" >
  </div>
    <div class="form-group col-md-1 ">
      <label for="pace">Pace</label>
      <input type="number" class="form-control" id="pace">
    </div>
    <div class="form-group col-md-1 ">
    <label for="shooting">Shooting</label>
      <input type="number" class="form-control" id="shooting">
    </div>
    <div class="form-group col-md-1 ">
    <label for="passing">Passing</label>
      <input type="number" class="form-control" id="passing">
    </div>
    <div class="form-group col-md-1 ">
    <label for="dribbling">Dribbling</label>
      <input type="number" class="form-control" id="dribbling">
    </div>
    <div class="form-group col-md-1 ">
    <label for="defending">Defending</label>
      <input type="number" class="form-control" id="defending">
    </div>
    <div class="form-group col-md-1 ">
    <label for="physical">Physical</label>
      <input type="number" class="form-control" id="physical">
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Add Player</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>

<!-- 
<select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select> -->