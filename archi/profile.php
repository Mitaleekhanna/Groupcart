<html>

<head>
  <style>
    body {
      background: #67B26F;
      /* fallback for old browsers */
      background: -webkit-linear-gradient(to right, #4ca2cd, #67B26F);
      /* Chrome 10-25, Safari 5.1-6 */
      background: linear-gradient(to right, #4682B4, #D8BFD8);
      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
      padding: 20px;
      margin-top: 20px;
      font-family: sans-serif;
      color: #2F4F4F;
    }
    .student-profile .card {
      border-radius: 10px;
    }
    .student-profile .card .card-header .profile_img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      /* margin: 10px auto; */
      border: 10px solid #ccc;
      border-radius: 50%;
      margin-top: 20px;
    }
    .student-profile .card h3 {
      font-size: 20px;
      font-weight: 700;
    }
    .student-profile .card p {
      font-size: 16px;
      color: #000;
    }
    .student-profile .table th,
    .student-profile .table td {
      font-size: 14px;
      padding: 5px 10px;
      color: #000;
    }
    .card-body {
      margin-top: 20px;
    }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #D8BFD8;
      position: -webkit-sticky; /* Safari */
      position: sticky;
      top: 0;
    }
    li {
      float: right;
      color: #9ACD32;
      font-size: 20px;
    }
    li a {
      display: block;
      color: #2F4F4F;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }
    li a:hover {
      background-color: rgb(71, 99, 136);
    }
    .active {
      background-color: #4682B4;
      color: white;
    }
  </style>
</head>

<body>

  <ul>
    <li><a class="active" href="profile.php">Profile</a></li>
    <li><a href="groups.php">Home</a></li>
    <li><a href="mycart.php">My Cart</a></li>
    <li><a href="#notification">Notification</a></li>
  </ul>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <?php
  require_once('dbconnection.php'); ?>

  <div>
    <?php if (isset($_GET['user_id'])) {
      $user_data = get_userdata($_GET['user_id']);
      if ($user_data) {
        while ($data = $user_data->fetch_assoc()) { // print_r($item);
    ?>
          <h1 style="color:white;"><b>Profile</b></h1>

          <div class="student-profile py-4">
            <div class="row">
              <div class="col-lg-4">
                <div class="card shadow-sm">
                  <div class="card-header bg-transparent">
                    <img class="profile_img" src="https://source.unsplash.com/600x300/?student" alt="student dp">
                    <h3 style="color:white;"><?php echo $data['name']; ?></h3>
                  </div>
                  <div class="card-body">
                    <!-- <p class="mb-0"><strong class="pr-1">UserId:</strong>anitadas</p> -->
                    <p class="mb-0"><strong class="pr-1" style="color:white;">Email Address : </strong><?php echo $data['email']; ?></p>
                  </div>
                  <div class="card-body">
                    <p class="mb-0"><strong class="pr-1" style="color:white;">Contact No : </strong><?php echo $data['phone_number']; ?></p>
                  </div>
                  <div class="card-body">
                    <p class="mb-0"><strong class="pr-1" style="color:white;">Shipping Address : </strong><?php echo $data['address']; ?></p>
                  </div>
                </div>
              
              <div class="card-body">
                <p class="mb-0" style="text-decoration: underline;" >My Cart</p>
              </div>
              <div class="card-body">
                <p class="mb-0" style="text-decoration: underline;">Shopping to do</p>
              </div>
              </div>
            </div>

          </div>
  </div>
  </div>

<?php }
      }
    } ?>
</div>

<?php
function get_userdata($user_id)
{
  $sql = "SELECT * FROM  users  WHERE user_id =" . $user_id;

  echo "<script>console.log('user id=: " . $user_id . "' );</script>";
  echo "<script>
    console.log(<?= json_encode($user_id); ?>);
</script>";

  $result = DBConnect::getInstance()->query($sql);
  // var_dump($result);
  if ($result->num_rows > 0) {
    return $result;
  } else {
    return false;
  }
}
?>

</body>
</html>
