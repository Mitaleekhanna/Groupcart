<html>
    <head>
        <style>
            .grid-item {
                background-color: #D8BFD8;
                border: 1px solid rgba(0, 0, 0, 0.8); 
                padding: 20px;
                font-size: 40px;
                text-align: center;
                float: left;
                width: 48%;
                border-radius: 8px;
                margin: 10px;
                height: 40%;
                color: #2F4F4F;
                padding-top: 120px;
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
    <body style="background-color: #4682B4; color: white; font-family: sans-seref;">  

        <ul>
            <li><a class="active" href="groups.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="mycart.php">My Cart</a></li>
            <li><a href="#notification">Notification</a></li>
        </ul>

        <h1 style="text-align: center; font-size: 60px; padding-top: 70px;">GroupCart</h1>
        <p style="text-align: center; font-size: 17px; padding-bottom: 70px;">'Place to share with friends'</p>
          
        <div class="grid-container">
            <div>
                <?php
                    require_once('dbconnection.php');
                    $user_id = 1;
                    $groups = get_all_groups();

                    // print_r($items);
                    while ($group = $groups->fetch_assoc()) {// print_r($item);
                        $check_subscribed =  check_subscription($user_id,$group['group_id']);
                ?>
            </div>
                <div  class="grid-item">
                    <?php echo $group['group_name']?>
                        <p style="font-size: 20px;"><?php echo $group['description']?></p>
                        
                    <?php if($check_subscribed){
                        $link = "/items.php?group_id=".$group['group_id'];?>
                            <input type="button" style="font-size: 20px;" value="Subscribed"  disabled>
                            <a href="<?php echo $link;?>" style="font-size: 20px;"> View </a>
                    <?php } else{ ?>
                            <input type="button" style="font-size: 20px;" value="Subscribe" onclick="add_user_to_group(<?php echo $user_id ?>,<?php echo $group['group_id'] ?>)">
                    <?php }} ?>
                </div>
            </div>
  <!-- <div no-margin no-padding class="row">
    <div no-margin no-padding class="column">
      <div>
      </div>
    </div>
    <div no-margin no-padding class="column">
      <div>
      </div>
    </div>
  </div> -->

         <!-- <div class="grid-container">
        // <div class="grid-item">For groceries 
        //     <p style="font-size: 20px;">The group is made for grocery shopping.</p>
        //     <button style="font-size: 20px;">Subscribe!</button>
        // </div>
        // <div class="grid-item">For medicines
        //     <p style="font-size: 20px;">The group is for to buy medicines.</p>
        //     <button style="font-size: 20px;">Subscribe!</button>
        // </div>
        // <div class="grid-item">Us neighbours
        //     <p style="font-size: 20px;">Lets help our neighbours in shopping.</p>
        //     <button style="font-size: 20px;">Subscribe!</button>
        // </div>  
        // <div class="grid-item">Friends
        //     <p style="font-size: 20px;">Lets shop together and have fun.</p>
        //     <button style="font-size: 20px;">Subscribe!</button>
        // </div>
        // <div class="grid-item">Party
        //     <p style="font-size: 20px;">Party stuff? Post the items here.</p>
        //     <button style="font-size: 20px;">Subscribe!</button>
        // </div>
        // <div class="grid-item">Fresh groceries
        //     <p style="font-size: 20px;">Group for groceries.</p>
        //     <button style="font-size: 20px;">Subscribe!</button>
        // </div>    
        // </div> -->

        <?php
            function get_all_groups(){
                $sql = "SELECT * FROM groups";
                $result = DBConnect::getInstance()->query($sql);
                // var_dump($result);
                if ($result->num_rows > 0) {
                return $result;
                }
                else{
                return false;
                }
            }

            function check_subscription($user_id,$group_id){
                $sql = "SELECT * FROM user_to_group WHERE user_id=".$user_id." AND group_id=".$group_id;
                $result = DBConnect::getInstance()->query($sql);
                // var_dump($result);
                if ($result->num_rows > 0) {
                return true;
                }
                else{
                return false;
                }
            }
        ?>

        <script>
            function add_user_to_group(user_id,group_id){
                // window.location.href = '/groupcart/group.php?group_id='+group_id+'&user_id='+user_id;
                $.ajax({
                method: "POST",
                url: "subscribe.php",
                data: { user_id: user_id, group_id: group_id}
                })
                .done(function( msg ) {
                    // alert( "Data Saved: " + msg );
                    if(msg){
                    alert("You have subscribed")
                    location.reload();
                    }else{
                    alert("You are already subscribed")
                    }
                });
            }
        </script>
    </body>
</html>