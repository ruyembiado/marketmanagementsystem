//Ajax that Get data from expiration_watcher every 5000 miliseconds = 5secs
setInterval(function () {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../includes/expiration_watcher.php", true);
  xhr.send();
}, 1000);
