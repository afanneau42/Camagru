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
        }
      }, false);

      function takepicture() {
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        data = canvas.toDataURL('image/png');
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
      }

      document.getElementById("filter_input2").onclick = function() {
        enablestartbutton();
      }

      document.getElementById("filter_input3").onclick = function() {
        enablestartbutton();
      }

      startbutton.addEventListener('click', function(ev){
          takepicture();
        ev.preventDefault();
      }, false);
    
    })();