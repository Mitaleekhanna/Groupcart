<?php
require_once('dbconnection.php');

if(isset($_POST['user_id']) && isset($_POST['group_id'])) {
  $sql = "SELECT * FROM user_to_group WHERE user_id=".$_POST['user_id']." AND group_id=".$_POST['group_id'];
  $result = DBConnect::getInstance()->query($sql);
  // echo $result->num_rows;
  if ($result->num_rows <= 0) {
      $sql = "INSERT INTO user_to_group (user_id,group_id) VALUES (".$_POST['user_id'].",".$_POST['group_id'].")";
      // echo $sql;
      $result = DBConnect::getInstance()->query($sql);
      echo true;
    }else{
      echo false;
    }
}
else{
  echo 'parameter missing';
}