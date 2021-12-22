<html>
  <head>
    <style>
      .form_div{
        /* width:70%; */
        /* margin-left:320px; */
        /* background-image: url('../pages/img1.jpeg'); */
        /* text-align: center; */
      }
      .form_label{
        font-size:30px;
        font-weight:bold;
        color:white;
        padding:10px;
      }
      .name{
        color: #2F4F4F;
        /* text-align: center; */
        font-size:25px;
        font-weight:bold;
        padding: 10px;
      }
      .inp{
        padding: 10px;
        width: 50%;
      }
      .input{
        padding:10px;
        margin:10px;
        width: 30%;
      }
      .btnn{
        padding:10px;
        margin-top:20px;
        margin: 10px;
        width:10%;
        background-color: #D8BFD8;
      }
    </style>
  </head>

  <body style="background: linear-gradient(to right, #4682B4, #D8BFD8);">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <?php
    require_once('dbconnection.php');?>
      <div id="wrapper">
        <div class="form_div">
          <div style="padding: 10px;">
            <p class="form_label">Login </p>
            <form method="post" action="">
              <p class="name">EmailAddress</p>
              <p><input type="text" placeholder="Enter Email" name="email" id="email" required class="input"></p>
              <p class="name">Password</p>
              <p><input type="password" placeholder="Enter Password" name="password" id="password" required class="input"></p>
              <p><input type="submit" value="Log In" class="btnn"></p>
            </form>
          </div>
        </div>
      </div>

    <script>
        $(function () {
          $('form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
              type: 'post',
              url: 'loginuser.php',
              data: $(this).serialize(),
              success: function (data) {
                console.log(data);
                // data = json_decode(data);
                if(data == false){
                    alert('invalid email or password');
                  }else{
                  // alert(data);
                  alert("Log In Successful");
                  window.location.href = "./groups.php?user_id="+data;
                }
              }
            });
          });
        });
    </script>
  </body>
</html>