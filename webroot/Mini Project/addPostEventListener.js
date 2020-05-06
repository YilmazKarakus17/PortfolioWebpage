//populates the inputs if editStatus is 1
if(sessionStorage.getItem('editStatus') == "1")
{
  document.getElementById("Title").value = sessionStorage.getItem('postTitle');
  document.getElementById("Body").value = sessionStorage.getItem('postBody');
  sessionStorage.setItem('editStatus',"0");
}

/*----------------------------- Event Listener for reset button --------------------*/
document.getElementById("resetBtn").addEventListener("click",confirmClear);
/* function which pops up an alert asking whether
 * the user indeed wants to clear the data */
function confirmClear(event)
{
  if(window.confirm("You sure you want to clear everthing?") == true)
  {
    return true;
  }
  else{
    event.preventDefault();
  }
}

/*----------------------------- Event Listener for preview button --------------------*/
document.getElementById("previewBtn").addEventListener("click",preview);
//event handler
function preview(event){
  //first checks if the form has valid input
  if (validatePost(event) == false)
  {
    return false;
  }
  //saving the data on the title and body of post
  let title = document.getElementById("Title").value;
  let body = document.getElementById("Body").value;

  sessionStorage.setItem('postTitle',title);
  sessionStorage.setItem('postBody',body);
  sessionStorage.setItem('validSubmitMethod',"1");
  window.location.href="previewBlog.php";
}

//---------- event listener for uploadbtn and submit button --------------//
document.getElementById("submitBtn").addEventListener("click", submitFunction);
//submit function which checks if validation isn't false then posts
function submitFunction(event)
{
  //first checks if the form has valid input
  if (validatePost(event) == false)
  {
    return false;
  }
  //creating todays Date
  let todaysDateTime = new Date();
  //getting the day and month from the todaysDateTime object
  if(todaysDateTime.getDate() == 1 || todaysDateTime.getDate() == 21 || todaysDateTime.getDate() == 31)
  {
    var day = todaysDateTime.getDate() + "st";
  }
  else{
    if(todaysDateTime.getDate() == 2 || todaysDateTime.getDate() == 22)
    {
      var day = todaysDateTime.getDate() + "nd";
    }
    else{
      if(todaysDateTime.getDate() == 3 || todaysDateTime.getDate() == 23)
      {
        var day = todaysDateTime.getDate() + "rd";
      }
      else{
        var day = todaysDateTime.getDate() + "th";
      }
    }
  }
  let monthName = ["January","February","March","April","May","June","July","August","September","October","November","December"];
  //getting the minutes
  if((todaysDateTime.getMinutes()+1) < 10)
  {
    var minute = "0"+(todaysDateTime.getMinutes()+1);
  }
  else{
    var minute = (todaysDateTime.getMinutes()+1);
  }
  //outputting the datetime
  let dateTime =  day+"-"+(monthName[todaysDateTime.getMonth()])+"-"+todaysDateTime.getFullYear()+", "+todaysDateTime.getHours()+":"+minute+" "+"UTC";
  //setting the Date value to todaysDate
  document.getElementById("DateTime").value = dateTime;
  //setting the Month value to this month
  let month = (todaysDateTime.getMonth()+1);
  document.getElementById("Month").value = month;
  //submitting the form
  document.getElementById("addPostForm").submit();
}


//---------------------------function which checks if the form inputs pass validations---------------------//
function validatePost(event)
{
  if(validateTitleExists() == false)
  {
    highlightTitle();
    event.preventDefault();
    return false;
  }
  if(validateTitleLength(5) == false)
  {
    resetTitleHighlight();
    errorMessage("The title has to be at least 5 characters");
    event.preventDefault();
    return false;
  }
  if(validateBodyExists() == false)
  {
    resetTitleHighlight();
    highlightBody();
    event.preventDefault();
    return false;
  }
  if(validateBodyLength(20) == false)
  {
    resetBodyHighlight();
    errorMessage("The body of post has to be at least 20 characters");
    event.preventDefault();
    return false;
  }
  return true;
}

//function that checks that a title is entered
function validateTitleExists()
{
  let Title = document.getElementById("Title").value;
  if(Title.trim() == "")
  {
    return false;
  }
  return true;
}

//function that checks that a body is entered
function validateBodyExists()
{
  let Body = document.getElementById("Body").value;
  if(Body.trim() == "")
  {
    return false;
  }
  return true;
}

//function which validates that the length of the title is at least n length
function validateTitleLength(n)
{
  let Title = document.getElementById("Title").value;
  Title = Title.replace(/\s/g,"");
  if(Title.length < n)
  {
    return false;
  }
  return true;
}

//function which validates that the length of the body is at least n length
function validateBodyLength(n)
{
  let Body = document.getElementById("Body").value;
  Body = Body.replace(/\s/g,"");
  if(Body.length < n)
  {
    return false;
  }
  return true;
}

//funciton used to highlight the title
function highlightTitle(){
  document.getElementById("Title").style.backgroundColor = "#f2913d";
}
//function to reset title to no longer be highlighted
function resetTitleHighlight()
{
  document.getElementById("Title").style.backgroundColor = "white";
}

//funciton used to highlight the body
function highlightBody(){
  document.getElementById("Body").style.backgroundColor = "#f2913d";
}

//function to reset body to no longer be highlighted
function resetBodyHighlight()
{
  document.getElementById("Body").style.backgroundColor = "white";
}

//funciton used to output error messages
function errorMessage(Message)
{
  document.getElementById("errorMessage").innerHTML = Message;
}
