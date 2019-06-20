
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
              config.extraPlugins = 'sharedspace,lineheight,video,youtube';
<<<<<<< HEAD
=======
              config.removePlugins = 'resize';
>>>>>>> ba78d44523fc37cda5acdde86e69b74d9302e9e6
              config.height = 140;
              config.enterMode = CKEDITOR.ENTER_BR;
              config.sharedSpaces = {
                top: 'top',
                bottom: 'bottom'
              };
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
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

	config.removeButtons = 'Print,NewPage,Save,HiddenField,ImageButton,Button,Select,Textarea,TextField,Radio,Checkbox';
};
