(function() {
    //Section 1 : Code to execute when the toolbar button is pressed
    var a = {
        exec: function(editor) {	
        if ('webkitSpeechRecognition' in window) {
		 	var oldText=editor.getData();
				oldText = oldText.replace('<big>','');
				oldText = oldText.replace('</big>','');
            var speechRecognizer = new webkitSpeechRecognition();
            speechRecognizer.continuous = true;
            speechRecognizer.interimResults = true;
            speechRecognizer.lang = 'ar-SA';
            speechRecognizer.start();
            var finalTranscripts = '';
            speechRecognizer.onresult = function(event) {
                var interimTranscripts = '';
                for (var i = event.resultIndex; i < event.results.length; i++) {
                    var transcript = event.results[i][0].transcript;
                    transcript.replace("\n", "<br>");
                    if (event.results[i].isFinal) {
                        finalTranscripts += transcript;
                        var speechresult = finalTranscripts;
                        console.log(speechresult);
                        if (speechresult) {
						
                        }
                    } else {
                        interimTranscripts += transcript;
                    }
                }
                editor.setData(oldText+' '+finalTranscripts + '<span style="color:#999">' + interimTranscripts + '</span>');
				console.log(finalTranscripts);
				//speechRecognizer.stop();
				
            };
            speechRecognizer.onerror = function(event) {};
			
        } else {
            r.innerHTML = 'Your browser is not supported. If google chrome, please upgrade!';
        }
			
        }
    },

    //Section 2 : Create the button and add the functionality to it
    b='v2t';
    CKEDITOR.plugins.add(b, {
        init: function(editor) {
            editor.addCommand(b, a);
            editor.ui.addButton("v2t", {
                label: 'Voice To Text', 
                icon: this.path+"icon/del.png",
                command: b
            });
        }
    }); 
})();