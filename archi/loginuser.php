<?php require_once('dbconnection.php'); ?>
<?php
      // print_r($_POST);
      $sql = "SELECT user_id FROM users where email='".$_POST['email']."' AND password='".$_POST['password']."'";
      // echo $sql;
      $result = DBConnect::getInstance()->query($sql);
      // print_r(mysqli_num_rows($result));
      if(mysqli_num_rows($result) > 0){
        // if ($result->num_rows > 0) {
          $last_id = mysqli_fetch_array($result)['user_id'];
          echo $last_id;
        // }
      } else{
        echo false;
      }
?>