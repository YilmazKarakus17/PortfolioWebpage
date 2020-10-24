<?php
  //checking if the method of accessing the site is a get
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    session_start();
    if(isset($_SESSION['AdminStatus']))
    {
      //credentials used to connect to SQLiteDatabase
      $dbhost = getenv("MYSQL_SERVICE_HOST");
      $dbport = getenv("MYSQL_SERVICE_PORT");
      $dbuser = getenv("DATABASE_USER");
      $dbpwd = getenv("DATABASE_PASSWORD");
      $dbname = getenv("DATABASE_NAME");
      // Creates connection
      $conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
      // Checks connection
      if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
      }
      //getting the datetime, month, title and body of the post
      $dateTime = $_POST['DateTime'];
      $Month = $_POST['Month'];
      $Title = $_POST['Title'];
      $Body = $_POST['Body'];
      // inserting into the database
      $sql = "INSERT INTO blogPostTable (PostDateTime,Month,PostTitle,PostBody) VALUES('$dateTime','$Month','$Title','$Body')";
      $conn->query($sql);
      //closing the connection
      $conn->close();
      //redirecting to viewBlog.php
      echo "<script>window.location.href='viewBlog.php'</script>";
    }
    else{
      echo "Need to Login in order to post blog entry. Please go to <a href='login.html'>Login Page</a>";
    }
  }
  else{
    echo "Incorrect Method Of Accessing Page: Please Try Again";
  }
?>
<!DOCTYPE html>
<html>
  <head lang="en">
    <meta charset="utf-8">
  </head>
  <body>
  </body>
</html>
