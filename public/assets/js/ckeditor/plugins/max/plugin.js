(function() {
    //Section 1 : Code to execute when the toolbar button is pressed
    var a = {
        exec: function(editor) {
			
            var text=editor.getData();
			    text='<big>'+text+'</big>';
			editor.setData(text);
        }
    },

    //Section 2 : Create the button and add the functionality to it
    b='max';
    CKEDITOR.plugins.add(b, {
        init: function(editor) {
            editor.addCommand(b, a);
            editor.ui.addButton("max", {
                label: 'Maximize Text', 
                icon: this.path+"icon/del.png",
                command: b
            });
        }
    }); 
})();