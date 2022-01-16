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
      debugger;
       let resp = this.response;
       let respArray = JSON.parse(resp);
       if(respArray != null)
       {
        addNode(respArray['_queueOrderIndex'],respArray['_user_login'],respArray['_id']);
        queueSizeInc();
       }
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


function addNode(queueInd,accName,id)
{
  debugger;
  let mainCont = document.getElementById('queue_main_cont');
  let newNode = document.createElement('div');
  newNode.className = 'queueNode';

  let queueIndP = document.createElement('p');
  queueIndP.textContent = "Номер в очереди: " + queueInd;
  
  let accNameP = document.createElement('p');
  accNameP.textContent = "Имя аккаунта: " + accName;
  
  let idP = document.createElement('p');
  idP.textContent = "Уникальный Id: " + id;
  
  newNode.appendChild(queueIndP);
  newNode.appendChild(accNameP);
  newNode.appendChild(idP);
  mainCont.appendChild(newNode);
}

function queueSizeInc()
{
   let qSize = (document.getElementById('queue_size').textContent);
   qSize++;
   document.getElementById('queue_size').textContent = qSize.toString();
}