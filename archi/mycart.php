<html>
  <head>
    <style>
      .container{
        padding-top: 100px;
        font-size: 18px;
      }
      .item{
        color: white;
        font-size: 25px;
      }
      .attributes{
        color: #2F4F4F;
        font-size: 20px;
      }
      .row{
        padding: 15px;
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

  <body style="text-align:center; background: linear-gradient(to right, #4682B4, #D8BFD8); font-family: sans-seref;">

    <ul>
      <li><a class="active" href="mycart.php">My Cart</a></li>
      <li><a href="profile.php">Profile</a></li>
      <li><a href="groups.php">Home</a></li>
      <li><a href="#notification">Notification</a></li>
    </ul>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <?php
    require_once('dbconnection.php');?>

    <div class="container">
      <h1 style="padding-top: 15px; padding-bottom: 100px; font-size: 50px; color: white;"><b>My cart</b></h1>
      <?php if(isset($_GET['user_id'])){
          $cart_data = get_cartdata($_GET['user_id']);
          if($cart_data){
            while ($data = $cart_data->fetch_assoc()) {// print_r($item);?>

          <div class="row">

            <div class="col-sm-1">
              <div class="item"><?php echo $data['item_name'] ?></div>
            </div>
            <div class="col-sm-2">
              <div class="attributes"><?php echo 'Quantity: '.$data['quantity'] ?></div>
            </div>
            <div class="col-sm-2">
              <div class="attributes"><?php echo 'Deadline: '.$data['deadline'] ?></div>
            </div>
            <div class="col-sm-2">
              <div class="attributes"><?php echo 'Group: '.$data['group_name'] ?></div>
            </div>
            <div class="col-sm-1">
              <div class="attributes"><?php echo 'Status: '.$data['status'] ?></div>
            </div>
            <div class="col-sm-2">
              <div><?php echo 'User: '.$data['name'] ?></div>
            </div>
            <div class="col-sm-1">
              <?php  $shopper_name = get_shoppername($data['shopper_id']);
              if($shopper_name){
                while ($data = $shopper_name->fetch_assoc()) {?>
                  <div><?php echo $data['name'] ?></div>
              <?php } } else{ ?>
                  <div class="attributes"><p>Shopper: None</p></div>
              <?php } ?>
            </div>
          </div>
      <?php } } } ?>
    </div>


    <?php
    function get_cartdata($user_id){
      $sql = "SELECT * FROM  user_to_item as ui left join items as i on ui.item_id = i.item_id left join groups as g on ui.group_id = g.group_id left join users as u on ui.user_id = u.user_id WHERE ui.user_id =".$user_id;
      $result = DBConnect::getInstance()->query($sql);
      // var_dump($result);
      if ($result->num_rows > 0) {
        return $result;
      }
      else{
        return false;
      }
    }

    function get_shoppername($shopper_id){
      $sql = "SELECT name FROM users WHERE user_id = ".$shopper_id;
        $result = DBConnect::getInstance()->query($sql);
        // var_dump($result);
        if(!$result){
          return false;
        }
        else {
          if($result->num_rows > 0) {
            return $result;
        }
      }
    }
    ?>
  </body>
</html>