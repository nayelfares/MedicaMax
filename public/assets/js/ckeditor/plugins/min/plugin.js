(function() {
    //Section 1 : Code to execute when the toolbar button is pressed
    var a = {
        exec: function(editor) {
			
            var text=editor.getData();
            text=text.replace('<big>','');
			text=text.replace('</big>','');
			editor.setData(text);
        }
    },

    //Section 2 : Create the button and add the functionality to it
    b='min';
    CKEDITOR.plugins.add(b, {
        init: function(editor) {
            editor.addCommand(b, a);
            editor.ui.addButton("min", {
                label: 'Minimize Text', 
                icon: this.path+"icon/del.png",
                command: b
            });
        }
    }); 
})();