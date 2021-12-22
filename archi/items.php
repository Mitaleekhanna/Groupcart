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
    <body style="text-align:center; background: linear-gradient(to right, #4682B4, #D8BFD8); font-family: sans-seref;">

        <ul>
          <li><a href="mycart.php">My Cart</a></li>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="groups.php">Home</a></li>
          <li><a href="#notification">Notification</a></li>
        </ul>

        <h1 style="padding-top: 30px; font-size: 50px; color: white;"><b>Item Menu</b></h1>
        <p style="padding: 10px; font-size: 20px; color: white;">Choose all the items you like with quantity and deadlines to add to the cart.</p>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <?php
        require_once('dbconnection.php');?>
        <div class="container">
          <?php
          $items = get_items_from_group_id($_GET['group_id']);
          if($items){
            while ($item = $items->fetch_assoc()) {// print_r($item);?>
              <form>
                <div class="row">
                  <input type="hidden" name="user-id" value="<?php echo $_GET['user_id'];?>" />
                  <input type="hidden" name="group-id" value="<?php echo $_GET['group_id'];?>" />
                  <div class="col-sm-3">
                    <div class="item"><?php echo $item['item_name'] ?></div>
                    <input type="hidden" name="item-id" value="<?php echo $item['item_id'] ?>">
                    <!-- <input type="checkbox" id="checkbox-<?php echo $item['item_id'] ?>" name="item-id" value="<?php echo $item['item_id'] ?>">
                    <label for="checkbox-<?php echo $item['item_id'] ?>"> <?php echo $item['item_name'] ?></label> -->
                  </div>
                  <div class="col-sm-3">
                    <label style="color: #2F4F4F;" for="quantity-<?php echo $item['item_id'] ?>">Quantity:</label>
                    <input type="number" id="quantity-<?php echo $item['item_id'] ?>" name="quantity" min="1" max="5">
                  </div>
                  <div class="col-sm-3">
                    <label style="color: #2F4F4F;" for="deadline-<?php echo $item['item_id'] ?>">Deadline:</label>
                    <input type="date" id="deadline-<?php echo $item['item_id'] ?>" name="deadline">
                  </div>
                  <div class="col-sm-3">
                    <input type="submit" value="Add to cart" style="background-color: #4682B4; color: #2F4F4F;">
                  </div>
                </div>
              </form>
          <?php } }?>
        </div>

        <script>
            $(function () {

              $('form').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                  type: 'post',
                  url: 'additem.php',
                  data: $(this).serialize(),
                  success: function (data) {
                    if(data){
                      alert('Item has been added to the cart.');
                      }

                  }
                });

              });

            });
          </script>




        <?php
        function get_items_from_group_id($group_id){
            $sql = "SELECT * FROM  items  WHERE group_id =".$group_id;
            $result = DBConnect::getInstance()->query($sql);
            // var_dump($result);
            if ($result->num_rows > 0) {
            return $result;
            }
            else{
            return false;
            }
        }
        ?>
      </body>
    </head>
  </html>