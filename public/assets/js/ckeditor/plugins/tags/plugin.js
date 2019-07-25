

CKEDITOR.plugins.add('tags',
{
requires : ['richcombo'],
init : function( editor )
{
// array of strings to choose from that'll be inserted into the editor
var strings = [];
	
$.ajax({
        type:"GET",
        url:route_insert_tag_js,
        cache: false,
        success:function(res){
            styles =  JSON.parse(res);
           	console.log(styles);
            styles.forEach(function(item){
               strings.push([item.tag_text_for_replace,item.tag_text,item.tag_text]);
            });
        }
      });

// add the menu to the editor
editor.ui.addRichCombo('tags',
{
label: 'Insert Tags',
title: 'Insert Tags',
voiceLabel: 'Insert Tags',
className: 'cke_format',
multiSelect:false,
panel:
{
css: [CKEDITOR.skin.getPath('editor') ],
voiceLabel: editor.lang.panelVoiceLabel
},

init: function()
{
this.startGroup( "Insert Tags" );
for (var i in strings)
{
this.add(strings[i][0], strings[i][1], strings[i][2]);
}
},

onClick: function( value )
{
editor.focus();
editor.fire( 'saveSnapshot' );
editor.insertHtml(value);
editor.fire( 'saveSnapshot' );
}
});
}
});