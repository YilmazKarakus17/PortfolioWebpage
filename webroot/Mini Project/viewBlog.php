<?php
  //checking if there is any blogs stored and if not it will redirect to login.html
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
  //getting all the blog posts
  $sql = "SELECT PostDateTime, PostTitle, PostBody FROM blogPostTable ORDER BY postID DESC";
  $results = $conn->query($sql);
  //checking if the number of rows are more than 0
  if($results->num_rows >0)
  {
    //do nothing
  }
  else {
    //redirects to login.html
    echo "<script>window.location.href='login.html';";
  }
?>
<!DOCTYPE html>
<html>
  <head lang="en">
    <meta charset="utf-8">
    <title>View Blog</title>
    <link rel="stylesheet" type="text/css" href="viewBlog.css">
    <link rel="stylesheet" type="text/css" href="reset.css">
    <script src="https://kit.fontawesome.com/1b5902ce56.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header id="MainHeader">
      <div class="homepageLink">
        <a href="index.php">
          <hgroup>
              <h1>Yilmaz Karakus</h1>
              <h2>Computer Science Student</h2>
          </hgroup>
        </a>
      </div>
      <nav id="HeaderNav">
        <button id="dropdownBtn">Months</button>
        <?php
          echo "<div id='dropdown-content' class='dropdown-content'>";
          //creating all the buttons
          $months  = array("January","February","March","April","May","June","July","August","September","October","November","December");
          foreach($months as $value)
          {
            echo "<button class='dropdown-content-btns' id=".$value."btn>$value</button><br/>";
          }
          echo
          "<form id='chooseMonthForm' method='GET' action='viewBlog.php'>
          <input type='hidden' id='Month' name='Month'>
          </form>";
          echo "</div>";
        ?>
        <?php
          session_start();
          if(isset($_SESSION['AdminStatus']))
          {
            echo "<a class='navigation-btns' id='addPostBtn' href='addPost.html'>Add Post</a>";
          }
          else{
            echo "<a class='navigation-btns' id='addPostBtn' href='login.html'>Add Post</a>";
          }
        ?>
        <a class='navigation-btns' href='logout.php'>Logout</a>
      </nav>
    </header>
    <section id="main">
      <?php
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
          //if the $_GET['Month'] is set then show the posts belonging to that month
          if(isset($_GET['Month']))
          {
            $MonthArgument = $_GET['Month'];
            //getting all the blog posts
            $sql = "SELECT PostDateTime, PostTitle, PostBody FROM blogPostTable WHERE Month='$MonthArgument' ORDER BY postID DESC";
            $results = $conn->query($sql);
            echo "<section id='postContainer'>";
            //outputting all the rows of data
            for($i=1; $i<=$results->num_rows;$i++)
            {
              $row = $results->fetch_assoc();
              echo"<article class='posts'>
              <i class='far fa-clock fa-1x PostDates'>".$row["PostDateTime"]."</i>
              <h2 class='postTitles'>".$row["PostTitle"]."</h2>
              <p class='postBody'>".$row["PostBody"]."</p>
              </article>";
            }
            echo "</section>";
            $conn->close();
          }
          else{
            //getting all the blog posts
            $sql = "SELECT PostDateTime, PostTitle, PostBody FROM blogPostTable ORDER BY postID DESC";
            $results = $conn->query($sql);
            echo "<div id='postContainer'>";
            //outputting all the rows of data
            for($i=1; $i<=$results->num_rows;$i++)
            {
              $row = $results->fetch_assoc();
              echo"<div class='posts'>
              <i class='far fa-clock fa-1x PostDates'>".$row["PostDateTime"]."</i>
              <h2 class='postTitles'>".$row["PostTitle"]."</h2>
              <p class='postBody'>".$row["PostBody"]."</p>
              </div>";
            }
            echo "</div>";
            $conn->close();
          }
       ?>
    </section>
    <footer>
      <nav id="footerNavigation">
        <ul class="footer-links">
          <a href="index.php#AboutMe">About Me</a>
          <a href="index.php#Contact">Contact</a>
          <a href="mailto:ec19224@qmul.ac.uk">Email</a>
        </ul>
      </nav>
      <div class="footer-copyright">© 2020 Copyright
        <a href="index.php">Yilmaz Karakus</a>
      </div>
    </footer>
    <script src="viewBlogEventListener.js"></script>
  </body>
</html>
