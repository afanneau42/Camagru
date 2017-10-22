(function() {
    
      var streaming = false,
          video        = document.querySelector('#video'),
          cover        = document.querySelector('#cover'),
          canvas       = document.querySelector('#canvas'),
          startbutton  = document.querySelector('#startbutton'),
          data = undefined,
          width = 320,
          height = 0;
    
      navigator.getMedia = ( navigator.getUserMedia ||
                             navigator.webkitGetUserMedia ||
                             navigator.mozGetUserMedia ||
                             navigator.msGetUserMedia);
    
      navigator.getMedia(
        {
          video: true,
          audio: false
        },
        function(stream) {
          if (navigator.mozGetUserMedia) {
            video.mozSrcObject = stream;
          } else {
            var vendorURL = window.URL || window.webkitURL;
              video.src = vendorURL.createObjectURL(stream);
          }
          video.play();
        },
        function(err) {
          console.log("An error occured! " + err);
        }
      );
      
      video.addEventListener('canplay', function(ev){
        if (!streaming) {
          height = video.videoHeight / (video.videoWidth/width);
          video.setAttribute('width', width);
          video.setAttribute('height', height);
          canvas.setAttribute('width', width);
          canvas.setAttribute('height', height);
          streaming = true;
          canvas.width = width;
          canvas.height = height;


          var ctx=canvas.getContext('2d');
          var i;
  
          i=window.setInterval(function() {ctx.drawImage(video,5,5,width,height)},20);

        }
      }, false);

      function takepicture() {
        var filter = undefined;
        data = canvas.toDataURL('image/png');

        

        if(document.getElementById('filter_input').checked)
          filter = "masque";
        else if(document.getElementById('filter_input2').checked)
          filter = "joint";
        else if(document.getElementById('filter_input3').checked)
          filter = "moustache";

        loadXMLDoc(data, filter);
      }
    
      function enablestartbutton() {
        if (!document.getElementById('startbutton').hasAttribute('value') && !document.getElementById('form_filter').hasAttribute('action') && streaming == true)
        { 
          startbutton.setAttribute('class', 'startbutton_enable');
          startbutton.setAttribute('value', 'startbutton');
          startbutton.disabled = false;
        }
      }

      
      
      document.getElementById("filter_input").onclick = function() {
        enablestartbutton();
        draw();
      }

      document.getElementById("filter_input2").onclick = function() {
        enablestartbutton();
      }

      document.getElementById("filter_input3").onclick = function() {
        enablestartbutton();
      }

      function draw() {
        var ctx=canvas.getContext("2d");
        var img=document.getElementById("masque");
        ctx.drawImage(img,0,0);
    };

      startbutton.addEventListener('click', function(ev){
          takepicture();
        ev.preventDefault();
      }, false);
    
      function loadXMLDoc(data, filter) {
        var xhr = new XMLHttpRequest();
    
        xhr.onreadystatechange = function () {
          var DONE = 4; // readyState 4 means the request is done.
          var OK = 200; // status 200 is a successful return.
          if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
              console.log(xhr.responseText); // 'This is the returned text.'
            } 
            else {
              console.log('Error: ' + xhr.status); // An error occurred during the request.
            }
          }
        };
        
        xhr.open('POST', 'functions/f_photomontage.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(encodeURI('data=' + data)+  encodeURI('&filter=' + filter));
    }

    })();