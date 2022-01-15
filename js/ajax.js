function sendClicked() 
{
  sendCodeToEmail(document.getElementById("loginText").value);
}

function sendCodeToEmail(login) 
{
  var request = new XMLHttpRequest();
  request.open('GET', `/view/Auth/sendemail.php?login=${login}`, true);

  request.onload = function () 
  {
    if (this.status >= 200 && this.status < 400) 
    {
      // Success!
       var resp = this.response;
       document.getElementById("headerText").textContent = `A confirmation code was sent to: ${resp}`;

    } else 
    {
      // We reached our target server, but it returned an error
      document.getElementById("headerText").textContent = `We've faced some issues`;
    }
  };

  request.onerror = function () 
  {
    
  };

  request.send();

}