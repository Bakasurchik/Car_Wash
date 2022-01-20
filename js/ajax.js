//document.getElementById('deleteNote').addEventListener('click',function(){deleteFromQueue(login)},false)




document.onload = connect();

function connect()
{
debugger;
var vut = document.getElementById("deleteNote");
vut.addEventListener('click',function(){deleteFromQueue(document.getElementById('login').textContent)});
}


function addToQueue(login)
{
  sendAjax(`/controller/QueueController.php?add_queue_note&login=${login}`);
}

function deleteFromQueue(login)
{
  sendAjax(`/controller/QueueController.php?delete_queue_note&login=${login}`);
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
  let deleteButton = document.createElement('button');
  deleteButton.textContent = "Удалить запись";
  //deleteButton.addEventListener('click',function(){deleteFromQueue(accName)});
  deleteButton.onclick = "<?php deleteFromQueue(echo($_SESSION['login'])); ?>";


  let mainCont = document.getElementById('queue_main_cont');
  let newNode = document.createElement('div');
  newNode.className = 'queueNode';

  let queueIndP = document.createElement('p');
  queueIndP.textContent = queueInd;
  
  let accNameP = document.createElement('p');
  accNameP.textContent = accName;
  
  newNode.appendChild(queueIndP);
  newNode.appendChild(accNameP);
  mainCont.appendChild(newNode);
  mainCont.appendChild(deleteButton);
}

function queueSizeInc()
{
   let qSize = (document.getElementById('queue_size').textContent);
   qSize++;
   document.getElementById('queue_size').textContent = qSize.toString();
}