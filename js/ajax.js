//document.getElementById('deleteNote').addEventListener('click',function(){deleteFromQueue(login)},false)




document.onload = function (){connect()};
connect();
function connect()
{
debugger;
var vut = document.getElementById("deleteNote");
vut.addEventListener('click',function(){deleteFromQueue(document.getElementById('login').textContent)});
}


function addToQueue(login)
{
  sendAjaxToAdd(`/controller/QueueController.php?add_queue_note&login=${login}`);
}

function deleteFromQueue(login)
{
  sendAjaxToDelete(`/controller/QueueController.php?delete_queue_note&login=${login}`);
}

function sendAjaxToAdd(destination) 
{
  
  var request = new XMLHttpRequest();
  request.open('GET', destination, true);

  request.onload = function () 
  {
    if (this.status >= 200 && this.status < 400) 
    {
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

function sendAjaxToDelete(destination)
{
  var request = new XMLHttpRequest();
  request.open('GET', destination, true);

  request.onload = function () 
  {
    if (this.status >= 200 && this.status < 400) 
    {
      debugger;
       let resp = this.response;
       let respArray = JSON.parse(resp);
       if(respArray != null)
       {
          deleteNode(respArray);
          queueSizeDec();
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
  deleteButton.addEventListener('click',function(){deleteFromQueue(document.getElementById('login').textContent)});


  let mainCont = document.getElementById('queue_main_cont');
  let newNode = document.createElement('div');
  newNode.className = 'queueNode';
  newNode.id = accName;

  let queueIndP = document.createElement('p');
  queueIndP.textContent = queueInd;
  
  let accNameP = document.createElement('p');
  accNameP.textContent = accName;
  
  newNode.appendChild(queueIndP);
  newNode.appendChild(accNameP);
  newNode.appendChild(deleteButton);
  mainCont.appendChild(newNode);
}

function deleteNode(login)
{
  debugger;
   document.getElementById(login).remove();
}


function queueSizeInc()
{
   let qSize = (document.getElementById('queue_size').textContent);
   qSize++;
   document.getElementById('queue_size').textContent = qSize.toString();
}

function queueSizeDec()
{
   let qSize = (document.getElementById('queue_size').textContent);
   qSize--;
   document.getElementById('queue_size').textContent = qSize.toString();
}