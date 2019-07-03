(function() {
    //Section 1 : Code to execute when the toolbar button is pressed
    var a = {
        exec: function(editor) {
			
            var text=editor.getData();
			var con=text.search("<br />");
			while (con > -1) {

                 text=text.replace('<br />',' ');
				 con=text.search("<br />");
			}
			
			editor.setData(text);
        }
    },

    //Section 2 : Create the button and add the functionality to it
    b='deletenewline';
    CKEDITOR.plugins.add(b, {
        init: function(editor) {
            editor.addCommand(b, a);
            editor.ui.addButton("deletenewline", {
                label: 'Delete New Line', 
                icon: this.path+"icon/del.png",
                command: b
            });
        }
    }); 
})();