let sub = document.querySelector('#messageForm');
let p = document.querySelector('#message');
let mes = document.querySelector('#inputMessage');

sub.addEventListener('submit', (e)=>{
    e.preventDefault();
    p.innerHTML = `tryin to send ${mes.value}`;

    let body = `message=${encodeURIComponent(mes.value)}`;

    let request = new XMLHttpRequest();
    request.open('POST', sub.action, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    request.onload = function() {
      if (request.status >= 200 && request.status < 400) {
        // Success!
        // console.log(request.responseText);
        // let data = JSON.parse(request.responseText);
        p.innerHTML = "server ansver is: " + request.responseText;
      } else {
        // We reached our target server, but it returned an error
        p.innerHTML = "Ошибка - " + request.responseText;
      }
    };
    
    request.onerror = function() {
      p.innerHTML = "Ошибка, сервер не найден";
    };
    
    request.send(body);
})