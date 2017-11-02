function del_pic(id) {
    var xhr = new XMLHttpRequest();


    xhr.onreadystatechange = function () {
      var DONE = 4; // readyState 4 means the request is done.
      var OK = 200; // status 200 is a successful return.
      if (xhr.readyState === DONE) {
        if (xhr.status === OK) {
            // 'This is the returned text.'
            console.log(id);
        } 
        else {
          console.log('Error: ' + xhr.status); // An error occurred during the request.
        }
      }
    };
    
    xhr.open('GET', '../delete_post.php?id=' + id);
    xhr.send();
}

onload = function(e) {
    pic = document.getElementsByClassName("picture_history");
    for(i=0; i<pic.length; i++) {
        pic[i].firstChild.addEventListener('click', del_pic(pic[i].id.substr(4)), false);
    }
}
