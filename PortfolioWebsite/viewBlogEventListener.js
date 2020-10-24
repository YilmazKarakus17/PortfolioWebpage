//----------------------- event listeners for dropdown -----------------------//
document.getElementById("dropdownBtn").addEventListener("click",dropDownMethod);
//event handler
function dropDownMethod()
{
  document.getElementById("dropdown-content").classList.toggle("show");
}
//when anything else is clicked
window.onclick = function(event)
{
  if(!event.target.matches("#dropdownBtn") && !event.target.matches(".dropdown-content-btns"))
  {
    let dropdown = document.getElementsByClassName("dropdown-content");
    for(let i=0; i<dropdown.length; i++)
    {
      if(dropdown[i].classList.contains("show"))
      {
        dropdown[i].classList.remove("show");
      }
    }
  }
}

//----------------------- event listeners for months button -----------------------//
var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];

window.onclick = function(event)
{
  for(let i=0; i<months.length; i++)
  {
    let idName = "#"+months[i]+"btn";
    if(event.target.matches(idName))
    {
      let monthNumber = i + 1;
      document.getElementById("Month").value = monthNumber;
      document.getElementById("chooseMonthForm").submit();
    }
  }
}
