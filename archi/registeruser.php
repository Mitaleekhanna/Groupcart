<?php require_once('dbconnection.php'); ?>
<?php
      // print_r($_POST);
      $sql = "SELECT user_id FROM users where email='".$_POST['email']."' AND password='".$_POST['password']."'";
      $result = DBConnect::getInstance()->query($sql);
      if($result){
      if ($result->num_rows <= 0) {
        $sql = "INSERT INTO users (name,address,email,password,phone_number) VALUES ('".$_POST['name']."','".$_POST['address']."','".$_POST['email']."','".$_POST['password']."',".$_POST['number'].")";
        $result = DBConnect::getInstance()->query($sql);
        $sql = "SELECT MAX(user_id) as user_id FROM users";
        $result = DBConnect::getInstance()->query($sql);
        $last_id = mysqli_fetch_array($result)['user_id'];
        echo $last_id;
      } }
      else{
        echo null;
      }
?>