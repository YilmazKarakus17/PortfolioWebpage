<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    //declaring email and Password variable and assigning it to what the user had inputted
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
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
    /* ---------- checking if the username and password is of an admin -----------*/
    //Selecting the information from the adminLoginTable table
    $sql = "SELECT * FROM	adminLoginTable WHERE Email='$Email' AND Password='$Password'";
    $result = $conn->query($sql);
    //checks if the result variable contains any rows of data and if it does it means these credentials exist
    if($result->num_rows != 0)
    {
      //starting session
      session_start();
      //setting a session variable login to true
      $_SESSION['LoginStatus'] = true;
      //setting a session variable admin to true
      $_SESSION['AdminStatus'] = true;
      //closing connection
      $conn->close();
      //redirecting to addPost.html
      echo "<script>window.location.href='addPost.html'</script>";
    }
    else
    {
      /* ---------- checking if the username and password is of an User -----------*/
      //Selecting the information from the loginTable table
      $sql = "SELECT * FROM	loginTable WHERE Email='$Email' AND Password='$Password'";
      $result = $conn->query($sql);
      //checks if the result variable contains any rows of data and if it does it means these credentials exist
      if($result->num_rows != 0)
      {
        //starting session
        session_start();
        //setting a session variable login to true
        $_SESSION['LoginStatus'] = true;
        //setting a session variable admin to false
        $_SESSION['AdminStatus'] = false;
        //closing connection
        $conn->close();
        //redirecting to addPost.html
        echo "<script>window.location.href='addPost.html'</script>";
      }
      else{
        //if user doesn't exists it will output an error
        die("Invalid Credentials: Go back and try again");
      }
    }
  }
  else{
    die("Invalid Submission Request: You Need To First Enter Login Details");
  }
?>

<!DOCTYPE html>
<html>
  <head lang="en">
    <title>login.php</title>
  </head>
</html>
