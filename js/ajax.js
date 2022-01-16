function addToQueue(login)
{
  sendAjax(`/controller/QueueController.php?add_queue_list&login=${login}`);
}
function sendAjax(destination) 
{
  var request = new XMLHttpRequest();
  request.open('GET', destination, true);

  request.onload = function () 
  {
    if (this.status >= 200 && this.status < 400) 
    {
      // Success!
       var resp = this.response;
       return resp.toString();
    } 
    else 
    {
      
    }
  };

  request.onerror = function () 
  {
    
  };
  request.send();
}