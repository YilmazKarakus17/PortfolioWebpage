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
  //--------------- creating the table for admins login if it doesn't exist ---------------//
  $sql = "CREATE TABLE IF NOT EXISTS adminLoginTable (id int NOT NULL AUTO_INCREMENT PRIMARY KEY, Email VARCHAR(255), Password VARCHAR(255))";
  $conn->query($sql);
  //creating the admin credentials if it doesn't exist
  $sql = "SELECT * FROM adminLoginTable WHERE Email='yilmazkarakus14@outlook.com' AND Password='YK17'";
  $result = $conn->query($sql);
  //checks if $result contains any rows of data if so does nothing
  if($result->num_rows > 0)
  {
    //DO NOTHING
  }
  else{
    $sql = "INSERT INTO adminLoginTable (Email, Password) VALUES ('yilmazkarakus14@outlook.com','YK17')";
    $conn->query($sql);
  }
  //--------------- creating the table for user login if it doesn't exist ---------------//
  $sql = "CREATE TABLE IF NOT EXISTS loginTable (id int NOT NULL AUTO_INCREMENT PRIMARY KEY, Email VARCHAR(255), Password VARCHAR(255))";
  $conn->query($sql);
  //--------------- creating the table for contact if it doesn't exist ---------------//
  $sql = "CREATE TABLE IF NOT EXISTS contactTable(id int NOT NULL AUTO_INCREMENT PRIMARY KEY, Name VARCHAR(50), Email VARCHAR(255), Telephone VARCHAR(11), Subject VARCHAR(200), Message VARCHAR(500))";
  $conn->query($sql);
  //inserting new data if exists
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $tel = $_POST["Telephone"];
    $subject = $_POST["Subject"];
    $message = $_POST["Message"];

    $sql = "INSERT INTO contactTable (Name,Email,Telephone,Subject,Message) VALUES ('$name','$email','$tel','$subject','$message')";
    $conn->query($sql);
  }
  //--------------- creating the table for blog posts if it doesn't exist ---------------//
  $sql = "CREATE TABLE IF NOT EXISTS blogPostTable (postID int NOT NULL AUTO_INCREMENT PRIMARY KEY, PostDateTime VARCHAR(255), Month int, PostTitle VARCHAR(100), PostBody VARCHAR(2000))";
  $conn->query($sql);
  //Closing the connection
  $conn->close();
?>
<!DOCTYPE html>
<html>
  <head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Portfolio</title>
    <link rel="stylesheet" href="reset.css" type="text/css"/>
    <link rel="stylesheet" href="Homepage.css" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1b5902ce56.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header id="MainHeader">
      <nav id="HeaderNav">
        <hgroup>
            <h1>Yilmaz Karakus</h1>
            <h2>Computer Science Student</h2>
        </hgroup>
        <div class="dropdown">
            <button id="dropBtn" class="dropbtn">≡</button>
            <div id="mydropdown" class="dropdown-content">
              <a href="#Top">Home</a>
              <a href="#AboutMe">About</a>
              <a href="#Skills">Skills</a>
              <a href="#education">Education</a>
              <a href="#Contact">Contact</a>
              <?php
                session_start();
                if(isset($_SESSION['AdminStatus']))
                {
                  echo "<a href='addPost.html'>Add Post</a>";
                }
                else{
                  echo "<a href='login.html'>Add Post</a>";
                }
              ?>
              <a href="viewBlog.php">View Blog</a>
              <a href="CV.docx" download>Download CV </a>
              <a href="mailto:ec19224@qmul.ac.uk">Email</a>
              <?php
                if(!isset($_SESSION['AdminStatus']))
                {
                  echo "<button id='LoginBtn' class='logout-button'>Login</button>";
                }
                else {
                  echo "<button id='LogoutBtn' class='logout-button'>logout</button>";
                }
              ?>
            </div>
        </div>
      </nav>
    </header>
    <section class="row0" id="Gallery">
      <img id="GalleryImg"><figcaption id="galleryCaption"></figcaption>
      <button id="leftGalleryBtn">&lt;</button>
      <button id="rightGalleryBtn">&gt;</button>
      <button id="downButton">V</button>
    </section>
    <section class="row1" id="AboutMe">
    </br>
      <h2 class="H2SubHeading">About Me</h2>
      <aside class="research-interests left-aside">
        <h4 class="aside-subheadings">Research Interests </h4>
        <ul>
          <li>Software Engineering</li>
          <li>Game Development - Game Programming</li>
          <li>Artificial Intelligence</li>
          <li>Cyber Security</li>
        </ul>
      </aside>
      <div class="mainArticle">
        <h3>My name is Yilmaz Karakus, I am an undergraduate student within the school of Electronic Engineering and Computer Science (EECS) at Queen Mary University of London.</h3>
        <br/>
        <article>
          <p id="AboutMeParagraph">
            I love to program and I love to work on projects; I am currently talking to other like-minded students to come up with a new project to work on.
            I love to work in a team and recognize its importance, because without team work the human race wouldn’t be where it is currently.
            I can lead a team if I am required to but I am also happy to listen to others.
            It is for this reason I believe I am extremely self-controlled. In addition, I very flexible with my time and willingness to help, because it is very likely for me to spend extra time out of my day to help others whether that be my teammates or colleagues.
          </p>
        </article>
        <figure>
          <button id="AboutMeImgBtn"><img id="AboutMeImg" alt="pic of me" title="Yilmaz Karakus" width=155 height=155></button><br/>
          <figcaption>Yilmaz Karakus</figcaption>
        </figure>
      </div>
      <aside class="Hobbies right-aside">
        <h4 class="aside-subheadings">Hobbies </h4>
        <ul class="list-unstyled text-center ">
          <li>Going to the Gym</li>
          <li>Learning new skills</li>
          <li>Playing competitively with a team</li>
          <li>Paintball</li>
        </ul>
      </aside>
    </section>
    <section class="row2 coloured-bg" id="Skills"><br/>
      <h2 class="H2SubHeading">What Can I Do</h2>
      <div class="mySkills">
        I first started learning Java and Python before starting university,
        however thanks to the amazing lecturers and the diversity in the modules,
        over the course of a year I have been given the opportunity to learn <b>Java</b>, <b>JavaScript</b>, <b>PHP</b>, <b>CSS</b>, <b>HTML</b>.
        Through my modules, I have been able to improve on my prior knowledge on programming as well as learn new concepts and languages,
        and I now aim to put them in practice over the summer of 2020. I will continue to acquire new skills both independently and through <b>QMUL</b>.
      </div>
      <div id="SkillsIcon">
        <ul>
          <li><i class="fas fa-laptop-code fa-5x"></i><br/>Adept programmer</li>
          <li><i class="fas fa-users fa-5x"></i><br/>A Team Player</li>
          <li><i class="far fa-comments fa-5x"></i><br/>Communicating Skills</li>
        </ul>
      </div>
    </section>
    <section class="row3" id="Experience">
    <h2 class="H2SubHeading">Experiences</h2><br/>
    <table>
      <tbody>
        <thead>
          <tr>
            <td><b>Experience</b></td>
            <td><b>What I did</b></td>
            <td><b>Acquired Skills From The Experience</b></td>
          </tr>
        </thead>
        <tr>
          <td><b>Working With Network Admins of HWS</<b></td>
          <td>As a part of my sixth forms work experience week in year 12, I worked with school's network admins. I helped then locate faulty ports, monitored the school servers CPU status, Installed custom OS onto school computers, etc.</td>
          <td>Through Working with them, I have gained essential team work skills and a part of that was due realising the needs of the team should always come first.</td>
        </tr>
        <tr>
          <td><b>Hosting Workshops</<b></td>
          <td>I volunteered to give a demonstrations on how to build custom computers (e.g. checking the compatibility of the parts) to a group of students in my sixth form.</td>
          <td>Through this experience, I have gained teaching and communication skills, because I had to learn to simplify the explanation of concepts into bite size pieces.</td>
        </tr>
      </tbody>
    </table>
    </section>
    <section class="row4 coloured-bg" id="education">
      <h2 class="H2SubHeading">Education</h2>
      <br/>
      <div class="container" id="FullScreenEducationContainer">
        <div class="row" id="row4">
          <section class="col-sm-12">
            <div class="row">
              <section class="col-sm-4" id="hws">
                <a href="https://hws.creativeschools.co.uk/">
                  <img class="EducationLogo" src="https://www.wisepay.co.uk/store/images/headers/header_front_42621_123859.png" alt="HWS logo">
                </a>
              </section>
              <section class="col-sm-4" id="hws6">
                <a href="http://www.hws.haringey.sch.uk/post16/2015/" alt="HWS Sixth Form Logo">
                  <img class="EducationLogo" src="hws.png">
                </a>
              </section>
              <section class="col-sm-4" id="qmul">
                <a href="https://www.qmul.ac.uk/">
                  <img class="EducationLogo" src="https://storage-prtl-co.imgix.net/endor/organisations/17843/logos/1545296417_qmul.gif" alt="QMUL Logo">
                </a>
              </section>
            </div>
            <div class="row">
              <section class="col-sm-4">
                <dl>
                  <dt class="EducationTitle">Highgate Wood Secondary School</dt>
                  <dt class="EducationYears"><b>2011-2017 </b></dt>
                  <br/>
                    <dt>Subjects I graduated with:</dt>
                    <dd><b>Mandatory Subjects:</b></dd>
                    <dd>English - literature and writing</dd>
                    <dd>Maths</dd>
                    <dd>Physics</dd>
                    <dd>Chemistry</dd>
                    <dd>Biology</dd>
                    <dd>Religion Education</dd>
                    <dd><b>Subjects I Picked:</b></dd>
                    <dd>Computer Science</dd>
                    <dd>History</dd>
                    <dd>Design and Technology</dd>
                </dl>
              </section>
              <section class="col-sm-4">
                <dl>
                  <dt class="EducationTitle">Highgate Wood Sixth Form</dt>
                  <dt class="EducationYears"><b>2017-2019</b></dt>
                  <br/>
                    <dt>Subjects I graduated with:</dt>
                    <dd>Computer Science</dd>
                    <dd>Psychology</dd>
                    <dd>Sociology</dd>
                </dl>
              </section>
              <section class="col-sm-4">
                <dl>
                  <dt class="EducationTitle">Queen Mary University of London</dt>
                  <dt class="EducationYears"><b>2019-Present</b></dt>
                  <br/>
                    <dt>Year 1 modules I have taken:</dt>
                    <dd>Procedural programming <b>|</b> Object Oriented Programming <b>|</b> Fundamentals of web dev <b>|</b>
                    Computer Systems and Networks <b>|</b> information system analysis</dd>
                </dl>
              </section>
            </div>
          </section>
        </div>
      </div>
      <div class="display-at-800px">
        <table>
          <thead>
            <tr>
              <td><b>2019-Present</<b></td>
              <td><a href="https://www.qmul.ac.uk/">BSc Computer Science - Queen Mary University of London</a></td>
            </tr>
            <tr class="middle-column">
              <td>2017-2019</td>
              <td><a href="http://www.hws.haringey.sch.uk/post16/2015/">A-Levels - Highgate Wood Sixth Form</a></td>
            </tr>
            <tr>
              <td>2011-2017</td>
              <td><a href="https://hws.creativeschools.co.uk/">GCSEs - Highgate Wood Secondary School</a></td>
            </tr>
          </thead>
        </table>
      </div>
    </section>
    <section class="row 5" id="PortfolioRow">
      <h2 class="H2SubHeading">Portfolio</h2>
      <table class="fullSizeTable">
        <thead>
          <tr>
            <td>Project Title</td>
            <td>Project Description</td>
            <td>Evidence/Links</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>A-level project</td>
            <td>As a part of my coursework for year 13, I was required to create a fully functional system for a local business.
              This required me to use python to create many sub-systems such as signup page for new customers, a GUI ordering system in which a
              database stores all the transactions and an email system to send out the receipts to customers or their login details if when they forget.
            </td>
            <td>The admins may have a copy on server: <a href="tel:020 8342 7970">020 8342 7970</a></td>
          </tr>
          <tr>
            <td>Procedurally programmed game for semester 1</td>
            <td>
              I created a basic game in java in which players can explore a haunted house using commands and find keys, disable traps that can kill them and gain points.
            </td>
            <td><a href="http://prntscr.com/sau4hc">Screenshot of the files</a></td>
          </tr>
          <tr>
            <td>Object Oriented Game for semester 2 </td>
            <td>
              I created a game that had GUI and could store player information persistently to later be accessed.
              Players were allowed to explore a map with randomly placed villains and could pick up items to add to their inventory.
               The game also included different types of villains with different abilities.
            </td>
            <td><a href="http://prntscr.com/sau8gp">Screenshot of the files</a></td>
          </tr>
        </tbody>
      </table>
      <table class="mobileFriendlyTable">
        <thead>
          <tr>
            <td>Project Title</td>
            <td>Project Description</td>
            <td>Evidence/Links</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>A-level project</td>
            <td>As a part of my coursework, I was required to create a fully functional system for a local business.
            </td>
            <td>Ask the admins in my sixth form:<a href="tel:020 8342 7970"></br>020 8342 7970</a></td>
          </tr>
          <tr>
            <td>Procedurally programmed game for semester 1</td>
            <td>
              I created a basic game in java in which players can explore a haunted house using commands and find keys, disable traps that can kill them and gain points.
            </td>
            <td><a href="http://prntscr.com/sau4hc">Screenshot of the files</a></td>
          </tr>
          <tr>
            <td>Object Oriented Game for semester 2 </td>
            <td>
              I created a game that had GUI and could store player information persistently to later be accessed.
              Players were allowed to explore a map with randomly placed villains and could pick up items to add to their inventory.
            </td>
            <td><a href="http://prntscr.com/sau8gp">Screenshot of the files</a></td>
          </tr>
        </tbody>
      </table>
    </section>
    <div class="container">
      <div class="row">
        <section class="col-sm-12" id="Contact">
          <h2 class="H2SubHeading">Contact</h2>
          <div  id="formContainer">
            <form method="post" action="index.php">
              <fieldset>
                <legend>Contact Form</legend>
                <section class="form-row mb-4">
                  <!--  Name -->
                  <section class="col">
                    <input type="text" id="Name" name="Name" placeholder="Your Name" class="form-control"/>
                  </section>
                  <!--  Email -->
                  <section class="col">
                    <input type="email" id="Email" name="Email" placeholder="Email Address" class="form-control"/>
                  </section>
                  <!-- Telephone -->
                  <section class="col">
                    <input type="tel" id="Tel" name="Telephone" pattern="[0][7][0-9]{9}" placeholder="Telephone" class="form-control"/>
                  </section>
                </section>
              </fieldset>
              <fieldset class="form-row mb-4">
                <section class="col">
                  <!-- Subject -->
                  <input type="text" id="Subject" name="Subject" placeholder="Subject" class="form-control"/>
                  <br/>
                  <!-- Message box -->
                  <textarea rows="3" cols="4" id="Message" name="Message" placeholder="Write me a message..." class="form-control"></textarea>
                </section>
              </fieldset>
              <fieldset  id="SubmitFieldset" class="form-row mb-4">
                <section class="col">
                <!-- Output Message -->
                <label id="ContactFormOutput"></label>
                <!-- submit button -->
                <input id="contactFormSubmitBtn" class="form-buttons" type="submit" value="Send"/>
              </fieldset>
            </form>
          </div>
        </section>
      </div>
    </div>
    <!-- Footer -->
    <footer>
      <nav id="footerNavigation">
        <ul class="footer-links">
          <a href="#Top">Go up</a>
          <a href="viewBlog.php">Blog</a>
          <a href="mailto:ec19224@qmul.ac.uk">Email</a>
        </ul>
      </nav>
      <div class="footer-copyright">© 2020 Copyright
        <a href="index.php">Yilmaz Karakus</a>
      </div>
    </footer>
    <!-- Scripts -->
    <script src="HomepageEventListener.js"></script>
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
