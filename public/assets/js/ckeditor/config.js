
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
              config.contentsCss = './assets/js/ckeditor/CustomFonts/fonts.css';
              //config.font_names =  'ArefRuqaa-Regular; ArefRuqaa-Regular;'+config.font_names;
              config.extraPlugins = 'sharedspace,lineheight,video,youtube,allowsave,deletenewline';
              config.removePlugins = 'resize';
              config.height = 140;
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
		[CKEDITOR.CTRL + 82, 'outdent' ]                      //CTRL + R
	];
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'Save', 'document', 'doctools' ] },
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
};
