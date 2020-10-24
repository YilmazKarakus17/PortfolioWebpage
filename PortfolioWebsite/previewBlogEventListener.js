function CreatePreviewPost()
{
  let title = sessionStorage.getItem('postTitle');
  let body = sessionStorage.getItem('postBody');

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

  //populating the previewPost container
  document.getElementById("previewDate").innerHTML = dateTime;
  document.getElementById("previewTitle").innerHTML = title;
  document.getElementById("previewBody").innerHTML = body;
}



/*--------------------------------------- Adding event listener for edit button ----------------------------------------------------*/
document.getElementById("editBtn").addEventListener("click",editFunction);
//event handler for edit button
function editFunction()
{
  sessionStorage.setItem('editStatus',"1");
  window.location.href="addPost.html";
}

/*--------------------------------------- Adding event listener for upload button ----------------------------------------------------*/
document.getElementById("uploadBtn").addEventListener("click",uploadFunction);
//event handler for upload button
function uploadFunction()
{
  let title = sessionStorage.getItem('postTitle');
  let body = sessionStorage.getItem('postBody');
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

  //setting the title value
  document.getElementById("Title").value = title;
  //setting the body value
  document.getElementById("Body").value = body;
  //setting the Date value to todaysDate
  document.getElementById("DateTime").value = dateTime;
  //setting the Month value to this month
  let month = (todaysDateTime.getMonth()+1);
  document.getElementById("Month").value = month;
  //submitting the form
  if(sessionStorage.getItem('validSubmitMethod') != "1")
  {
    window.alert("Upload Failed: Need to fill out add post form");
  }
  else{
    document.getElementById("PostForm").submit();
  }
}
