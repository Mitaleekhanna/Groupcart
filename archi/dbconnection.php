<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
class DBConnect{
  private static $conn;
   public function __construct(){

   }
   public static function getInstance()
   {
     if(!self::$conn){
       self::connect();
       return self::$conn;
     }else{
       return self::$conn;
     }
   }
   private static function connect(){
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "groupcart";
     // Create connection
     DBConnect::$conn = new mysqli($servername, $username, $password,$dbname);
     if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
     // Check connection
     if (DBConnect::$conn->connect_error) {
       die("Connection failed: " .DBConnect::$conn->connect_error);
     }
     // echo "Connected successfully.........................";
   }
   public function query($qry){
     return DBConnect::$conn->query($qry);
   }

   public function closeconnection(){
      self::$conn->close();
   }
}