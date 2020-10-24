<!DOCTYPE html>
<html>
  <head lang="en">
    <meta charset="utf-8">
    <title>Preview Blog</title>
    <link rel="stylesheet" type="text/css" href="viewBlog.css">
    <link rel="stylesheet" type="text/css" href="reset.css">
    <link rel="stylesheet" type="text/css" href="previewBlog.css">
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
          //getting all the blog posts
          $sql = "SELECT PostDateTime, PostTitle, PostBody FROM blogPostTable ORDER BY postID DESC";
          $results = $conn->query($sql);
          echo "<div id='postContainer'>";

          echo "<div class='posts' id='previewPost'>
          <i class='far fa-clock fa-1x PostDates' id='previewDate'></i>
          <h2 class='postTitles' id='previewTitle'></h2>
          <p class='postBody' id='previewBody'></p>
          <div id='buttonContainer'>
          <button class='previewBtns' id='editBtn'>Edit</button>
          <button class='previewBtns' id='uploadBtn'>Upload</button>
          </div>
          </div>";

          //running javascript function
          echo "<script src='previewBlogEventListener.js'></script>";
          echo "<script>CreatePreviewPost();</script>";

          //making a hidden form
          echo "<form id='PostForm' method='POST' action='addPost.php'>
          <input type='hidden' id='DateTime' name='DateTime'/>
          <input type='hidden' id='Month' name='Month'/>
          <input type='hidden' class='postInputs' id='Title' name='Title'/>
          <input type='hidden' id='Body' name='Body'/>
          </form>";

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
  </body>
</html>
