
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
              config.extraPlugins = 'sharedspace,lineheight,video,youtube,allowsave,deletenewline,link,max,min,t2s';
              config.removePlugins = 'resize';
              config.height = 140
			 // config.htmlEncodeOutput =false;
			//  config.entries=false;
              config.enterMode = CKEDITOR.ENTER_BR;
              config.sharedSpaces = {
                top: 'top',
                bottom: 'bottom'
              }; 
	config.keystrokes = [
    [ CKEDITOR.CTRL + 83, 'save' ] ,                      // CTRL + S
	[ CKEDITOR.CTRL + 76 , 'indent' ],                    //CTRL + L
	[CKEDITOR.CTRL + 82, 'outdent' ],                      //CTRL + R
	[CKEDITOR.CTRL + 68, 'deletenewline' ],               //CTRL + D
	[CKEDITOR.CTRL + 50, 'max' ],
	[CKEDITOR.CTRL + 51, 'min' ],
	[ CKEDITOR.CTRL + 49, 't2s' ]
];
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode','Save', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'Print,NewPage,HiddenField,ImageButton,Button,Select,Textarea,TextField,Radio,Checkbox';
	
	
	//...
    /* Filebrowser routes */
    // The location of an external file browser, that should be launched when "Browse Server" button is pressed.
    config.filebrowserBrowseUrl = "{{asset('/images')}}";

    // The location of an external file browser, that should be launched when "Browse Server" button is pressed in the Flash dialog.
    config.filebrowserFlashBrowseUrl = "/ckeditor/attachment_files";

    // The location of a script that handles file uploads in the Flash dialog.
    config.filebrowserFlashUploadUrl = "/ckeditor/attachment_files";

    // The location of an external file browser, that should be launched when "Browse Server" button is pressed in the Link tab of Image dialog.
    config.filebrowserImageBrowseLinkUrl = "/ckeditor/pictures";

    // The location of an external file browser, that should be launched when "Browse Server" button is pressed in the Image dialog.
    config.filebrowserImageBrowseUrl = "/ckeditor/pictures";

    // The location of a script that handles file uploads in the Image dialog.
    config.filebrowserImageUploadUrl = "/ckeditor/pictures";

    // The location of a script that handles file uploads.
    config.filebrowserUploadUrl = "/ckeditor/attachment_files";

    config.allowedContent = true;
};
