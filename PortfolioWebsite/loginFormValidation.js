//adding event listener to submit button
document.getElementById("submitBTN").addEventListener("click", ValidateLogin);
//handling the event by validating it
function ValidateLogin(event){
  if(validateEmail() == false){
    event.preventDefault();
    return;
  }
  if(validatePassword() == false){
    event.preventDefault();
    return;
  }
}

//validates if username passes all validation
function validateEmail()
{
  if(validateEmailExists() == false){return false;}
  if(validateValidEmailAddress() == false){return false;}
  return true;
}

//validates if a username is entered
function validateEmailExists()
{
  let email = document.getElementById("Email").value;
  if(email.trim() == "")
  {
    outputErrorMessage("Please enter a email address!")
    return false;
  }
  return true;
}

//validates if username contains @
function validateValidEmailAddress()
{
  let email = document.getElementById("Email").value;
  if(email.indexOf('@') == -1)
  {
    outputErrorMessage("Given email does not include @");
    return false;
  }
  return true;
}

function validatePassword()
{
  let password = document.getElementById("Password").value;
  if(password.trim() == "")
  {
    outputErrorMessage("Please enter a password!")
    return false;
  }
  return true;
}

//function to print out error messages
function outputErrorMessage(Message)
{
  let outputLabel = document.getElementById("loginOutput");
  outputLabel.innerHTML = Message;
}
