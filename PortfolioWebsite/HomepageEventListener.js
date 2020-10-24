//------------------------- Drop Down functions ------------------------//
document.getElementById("dropBtn").addEventListener("click",dropdownFunction);
//when dropdown button is pressed it shows the dropdown menu
function dropdownFunction(){
  document.getElementById("mydropdown").classList.toggle("show");
}

// if clicked outside the dropdown it closes it
window.onclick = function(event)
{
  if(!event.target.matches('.dropbtn'))
  {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for(let i = 0; i< dropdowns.length; i++)
    {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show'))
      {
        openDropdown.classList.remove('show');
      }
    }
  }
}
//------- Event handling the Gallery image left/right button -------//
//array containing the names of all the images to the left of the middle image
var lhsImagesArray = ["GalleryImageLeft1.png"];
lhsImagesArray.reverse();
//variable containing the name of the welcome image
var middleImage = "GalleryImage1.png";
//array containing the names of all the images to the right of the middle image
var rhsImagesArray = ["GalleryImageRight1.png"];
//array that will contain all the images
var imageGalleryArray = new Array();
//variable to keep track of the middle position
var middlePosition = 0;
//looping through all images in lhsImagesArray and pushing it to imageGalleryArray
for(let i=0; i<lhsImagesArray.length; i++)
{
  imageGalleryArray.push(lhsImagesArray[i]);
  middlePosition = i;
}
//inserting the middle image
imageGalleryArray.push(middleImage);
middlePosition = middlePosition + 1;
//looping through all images in rhsImagesArray and pushing it to imageGalleryArray
for(let i=0; i<rhsImagesArray.length; i++)
{
  imageGalleryArray.push(rhsImagesArray[i]);
}

var currentPosition = middlePosition;

//setting the default image to be the middle image
document.getElementById("GalleryImg").src = imageGalleryArray[middlePosition];
document.getElementById("GalleryImg").alt = "Welcome Image";

//Adding event listeners
document.getElementById("leftGalleryBtn").addEventListener("click",leftGalleryBtn);
document.getElementById("rightGalleryBtn").addEventListener("click",rightGalleryBtn);
document.getElementById("downButton").addEventListener("click",downGalleryBtn);

//event handlers
function leftGalleryBtn()
{
  document.getElementById("rightGalleryBtn").style.display = "block";
  document.getElementById("galleryCaption").innerHTML = "";
  if(currentPosition != 0)
  {
    if(currentPosition == 1)
    {
      document.getElementById("leftGalleryBtn").style.display = "none"
    }
    currentPosition = currentPosition - 1;
    if(imageGalleryArray[currentPosition] == "GalleryImageLeft1.png")
    {
      document.getElementById("GalleryImg").src = imageGalleryArray[currentPosition];
      document.getElementById("GalleryImg").alt = imageGalleryArray[currentPosition];
      document.getElementById("galleryCaption").innerHTML = "Image from https://unsplash.com/photos/wJK9eTiEZHY";
    }
    else{
      document.getElementById("GalleryImg").src = imageGalleryArray[currentPosition];
      document.getElementById("GalleryImg").alt = imageGalleryArray[currentPosition];
    }
  }
}

function rightGalleryBtn()
{
  document.getElementById("leftGalleryBtn").style.display = "block";
  document.getElementById("galleryCaption").innerHTML = "";
  if(currentPosition < imageGalleryArray.length-1)
  {
    if(currentPosition == imageGalleryArray.length-2)
    {
      document.getElementById("rightGalleryBtn").style.display = "none"
    }
    currentPosition = currentPosition + 1;
    document.getElementById("GalleryImg").src = imageGalleryArray[currentPosition];
    document.getElementById("GalleryImg").alt = imageGalleryArray[currentPosition];
  }
}

function downGalleryBtn(){
  window.location.href="#AboutMe";
}

//------- Event handling the About me figure image button -------//
//array of images of me
var myImages = new Array();
myImages.push("me1.jpg");
myImages.push("me2.jpg");
//setting defualt value of imageIndex to 0
var imageIndex = 0;
//setting the start image
document.getElementById("AboutMeImg").src = myImages[imageIndex];
//event listener for the button in figure
document.getElementById("AboutMeImgBtn").addEventListener("click", changeImage);
//event handler
function changeImage()
{
  if (imageIndex < myImages.length-1)
  {
    imageIndex++;
    document.getElementById("AboutMeImg").src = myImages[imageIndex];
  }
  else{
    if (imageIndex == myImages.length-1)
    {
      imageIndex = 0;
      document.getElementById("AboutMeImg").src = myImages[imageIndex];
    }
  }
}

//---------- event handling for when login button is pressed --------//
//Checking if button has id LoginBtn
if(document.getElementById("LoginBtn"))
{
  //event listener for login button which
  document.getElementById("LoginBtn").addEventListener("click", loginFunction);
}
//Checking if button has id LogoutBtn
if(document.getElementById("LogoutBtn"))
{
  //event listener for logout button
  document.getElementById("LogoutBtn").addEventListener("click", logoutFunction);
}

//function that redirects to login.html when login button is pressed.
function loginFunction()
{
  window.location.href = "login.html";
}

//function that redirects to logout.php when login button is pressed.
function logoutFunction()
{
  window.location.href = "logout.php";
}

//---------- event handling for when send button is pressed for contact form--------//
document.getElementById("contactFormSubmitBtn").addEventListener("click",function(event){
  //validates the name input
  if(validateName() == false)
  {
    event.preventDefault();
    return;
  }
  //validates whether at least one form of contact information is entered
  if(validateContactInfo() == false)
  {
    event.preventDefault();
    return;
  }
  //validates whether the subject of the form is left blank
  if(validateSubject() == false)
  {
    event.preventDefault();
    return;
  }
});

//validates the name input
function validateName()
{
  let name = document.getElementById("Name").value;
  //removes all white spaces
  if(name.trim() == "")
  {
    //updates the output Message by calling the errorMessage function
    errorMessage("Need to enter characters for you name!");
    return false;
  }
}

//as long as either the tel or the email is entered the validation will allow one to be left blank
function validateContactInfo()
{
  let amountOfContactInfoEntered = 0;
  let email = document.getElementById("Email").value;
  let tel = document.getElementById("Tel").value;

  //if email is not empty it will increment the counter
  if(email.trim() != "")
  {
    amountOfContactInfoEntered++;
  }
  //if telephone is not empty it will increment the counter
  if(tel.trim() != "")
  {
    amountOfContactInfoEntered++;
  }
  //if counter is still 0 return false
  if(amountOfContactInfoEntered == 0)
  {
    //updates the output Message by calling the errorMessage function
    errorMessage("Need a way to contact you: either fill out telephone or email");
    return false;
  }
  else {
    return true;
  }
}

//validates whether the subject of the form is left blank
function validateSubject()
{
  let subject = document.getElementById("Subject").value;
  if(subject.trim() == "")
  {
    //updates the output Message by calling the errorMessage function
    errorMessage("Subject has to be filled in");
    return false;
  }
  else {
    // replace(/\s/g, "") replaces all whitespaces with ""
    return validateSubjectLength(subject.replace(/\s/g, ""));
  }
}

//checks that the length of the subject is at least 5 characters
function validateSubjectLength(subjectLength)
{
  if(subjectLength.length < 5)
  {
    //updates the output Message by calling the errorMessage function
    errorMessage("Subject has to have a length of at least 5 characters");
    return false;
  }
  else{
    return true;
  }
}

//function that outputs a error message passed as an argument
function errorMessage(message)
{
  let output = document.getElementById("ContactFormOutput");
  //Styling
  output.style.color = "red";
  output.style.fontWeight = "bold";
  output.style.width = "100%";
  output.style.textAlign = "center";
  //outputting message
  output.innerHTML = message;
}
