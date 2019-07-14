(function() {
    //Section 1 : Code to execute when the toolbar button is pressed
	//import('https://code.responsivevoice.org/responsivevoice.js?key=1TqJG1P0');
    var a = {
        exec: function(editor) {			
			 var text=editor.document.getBody().getText();
			  // console.log(text);
			   /*  responsiveVoice.speak(text,'US English Male');
				 responsiveVoice.lang='ar-SA';*/
				  //   console.log('Nayel '+$('#ar_term').val());
				     text = text.replace('<big>','');
					 text = text.replace('</big>','');
					  var res = text.substring(0,1);
					 var reg = /^[a-z]+$/i;
						if(reg.test(res) ){
							responsiveVoice.speak(text,'US English Male');
							console.log('English');
						}
						else{
                            responsiveVoice.speak(text, "Arabic Male", {
                                pitch: 1
                            }, {
                                rate: 1
                            });
							console.log('Arabic');
						}
			
        }
    },

    //Section 2 : Create the button and add the functionality to it
    b='t2s';
    CKEDITOR.plugins.add(b, {
        init: function(editor) {
            editor.addCommand(b, a);
            editor.ui.addButton("t2s", {
                label: 'Read Aloud', 
                icon: this.path+"icon/del.png",
                command: b
            });
        }
    }); 
})();