(function() {
    //Section 1 : Code to execute when the toolbar button is pressed
    var a = {
        exec: function(editor) {	
		
				navigator.mediaDevices.getUserMedia({ audio: false })
				  .then(function(stream) {
					console.log('You let me use your mic!')
				  })
				  .catch(function(err) {
					console.log('No mic for you!')
				  });
		
		
        if ('webkitSpeechRecognition' in window) {
		 	var oldText=editor.getData();
				oldText = oldText.replace('<big>','');
				oldText = oldText.replace('</big>','');
            var speechRecognizer = new webkitSpeechRecognition();
            speechRecognizer.continuous = true;
            speechRecognizer.interimResults = true;
            speechRecognizer.lang = 'ar-SA';
            speechRecognizer.start();
            speechRecognizer.stop();
			
        } else {
            r.innerHTML = 'Your browser is not supported. If google chrome, please upgrade!';
        }
			
        }
    },

    //Section 2 : Create the button and add the functionality to it
    b='v2tstop';
    CKEDITOR.plugins.add(b, {
        init: function(editor) {
            editor.addCommand(b, a);
            editor.ui.addButton("v2tstop", {
                label: 'Stop Talking', 
                icon: this.path+"icon/del.png",
                command: b
            });
        }
    }); 
})();