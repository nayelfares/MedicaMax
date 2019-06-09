var tree;
var id;
var old_id;
var parent_code ;
var parent_id ;
var compare = 1;
var result_search;
var first = true;
var save_auto_choice = false;
var cut_node_id ;
var color_text="000000";
var color_background = "ffffff";
var bold = "normal";
var italic = "normal";
var copy_color_text="000000";
var copy_color_background = "ffffff";
var copy_bold = "normal";
var copy_italic = "normal";
var copy_style = false;
    $(document).ready(function(){ 
    //fill data to tree  with AJAX call
    tree =$('#container').jstree({
        'core' : {
            "check_callback": true,
            'data' : {
                "url" : "{{route('classification.build_tree_ar')}}",
                "plugins" : [  "checkbox","state"],
                "dataType" : "json" // needed only if you do not supply JSON headers
            },
            "themes": {
            "theme": "default",
            "dots": true,
            "icons": false,
        },
        },
        "search" : {
                'show_only_matches' : false,
            },
        "ui": {
            "select_limit": 1,
            "select_multiple_modifier": "none",

        },
       /* "types" : {
            "mytype" : { "a_attr" : { "style" : "color:#"+color_text } }
        },*/
        'plugins': [ "sort","state","themes", "json_data", "ui", "Select", "types", "crrm","html_data", "search", "massload","wholerow","dnd","changed"]
    }).on('create_node.jstree', function(e, data) {
    console.log('saved');
});
////////////////////////////////////////////////////////////////////////////////////////    
    //manul search
    $("#s").submit(function(e) {
        e.preventDefault();  

        search();
        //foucs
        var searchResult = $("#container").jstree('search', $("#plugins4_q").val());
        $(searchResult).find('.jstree-search').focus();
});

//after choise Event
    $('#container').on("changed.jstree", function (e, data) {

        if(id != null && save_auto_choice == true){
            var code = document.getElementById('code').value;
            var en_term = document.getElementById('en_term').value;
            var ar_term = document.getElementById('ar_term').value;
            var note;
            var myInput = document.getElementById('note').value;
            if(myInput)
                note = document.getElementById('note').value ;
            else
                note =  "Note :" ;
            var ar_note;
            var myInput = document.getElementById('ar_note').value;
            if(myInput)
                ar_note = document.getElementById('ar_note').value ;
            else
                ar_note =  "الملاحظات :" ;
            if(copy_style == true)
                save_auto(id,compare,code,en_term,ar_term,note,ar_note,copy_bold,copy_italic,copy_color_background,copy_color_text); 
            else   
                save_auto(id,compare,code,en_term,ar_term,note,ar_note,bold,italic,color_background,color_text);
        }
        id = data.selected[0];
        //parent_code = data.node.parent;
        /*for open all child node when click on node*/
        $("#container").jstree(true).open_all([data.selected[0]]);
        /**/
        if(id != null )
        {
            fill_field(compare); 
            if(copy_style == true)
                autoChangeFontStyle(copy_bold,copy_italic,copy_color_text,copy_color_background);
            /*else
                if(bold != "normal" || italic != "normal" || color_text!= "#000000" || color_background != "#ffffff")
                    autoChangeFontStyle(bold,italic,color_text,color_background);*/         
        }
    }); 
   //  
    //delete
    $('#DeleteButton').click(function(){
        if (confirm('Are you sure want to remove this classification?')) {
            $.ajax({
                type :'GET',
                url:"{{route('node.delete')}}",
                data:{
                    id : id
                },
                success:function(res){
                    if(res == "yes"){                              
                        //delete node without refresh
                            var sel = $('#container').jstree(true).get_selected();
                            $('#container').jstree(true).delete_node(sel);
                        }
                    else
                        window.alert("you can't remove it ,becuse it has child!!");
                }
            });
        }
    });
    //Edit
    $('#EditButton').click(function(){
        compare = 1;
        fill_field(compare);
    });
    //ADD
    $('#AddButton').click(function(){
        compare = 2;
        fill_field(compare);
    });
    //save  
    $('#save').click(function(){
        var code = document.getElementById('code').value;
        var en_term = document.getElementById('en_term').value;
        var ar_term = document.getElementById('ar_term').value;
        var note;
        var myInput = document.getElementById('note').value;
        if(myInput)
            note = document.getElementById('note').value ;
        else
            note =  "Note :" ;
        var ar_note;
        var myInput = document.getElementById('ar_note').value;
        if(myInput)
            ar_note = document.getElementById('ar_note').value ;
        else
            ar_note =  "الملاحظات :" ;
        save_auto(id,compare,code,en_term,ar_term,note,ar_note,bold,italic,color_background,color_text);    
    });

    //note
    $('#note').summernote();
    $('#ar_note').summernote();
    //choice
    $('#save_auto__').change(function(){

        if($(this).prop('checked'))
        {
            save_auto_choice = true;
            document.getElementById("save").style.display = "none";
        }
        else
        {
            save_auto_choice = false;
            document.getElementById("save").style.display = "block";   
        }
    });
    //cut_node
    $("#cut_node").click(function(){
        var node = $('#container').jstree(true).get_node(id);
        cut_node_id = node.id;
        $('#container').jstree(true).cut(node);
    });
    //past_node
    $("#past_node").click(function(){
        var parent = $('#container').jstree(true).get_node(id);
        parent_id =  parent.id;
         
        $.ajax({
            type : 'GET',
            url : "{{route('update_parent')}}",
            data : {
                id : cut_node_id,
                parent_id : parent_id,
            },
            success:function(res){
                $('#container').jstree(true).paste(parent,"first");
            }
        })
    });



   let colorPicker_text = document.getElementById("colorPicker_text");
    colorPicker_text.addEventListener("input", function(event) {
        color_text = colorPicker_text.value;
        autoChangeFontStyle(bold,italic,color_text,color_background)
      //  document.getElementById(id).style.color = event.target.value;
    }, false);
    colorPicker_text.addEventListener("change", function(event) {
        color_text = colorPicker_text.value;     
        autoChangeFontStyle(bold,italic,color_text,color_background)
      //  document.getElementById(id).style.color = colorPicker_text.value;
    }, false);

   let colorPicker_backgraound = document.getElementById("colorPicker_backgraound");
    colorPicker_backgraound.addEventListener("input", function(event) {
        color_background = colorPicker_backgraound.value;
        autoChangeFontStyle(bold,italic,color_text,color_background)
      //  document.getElementById(id).style.color = event.target.value;
    }, false);

    colorPicker_backgraound.addEventListener("change", function(event) {
        color_background = colorPicker_backgraound.value;
        autoChangeFontStyle(bold,italic,color_text,color_background)
      //  document.getElementById(id).style.color = colorPicker_backgraound.value;
    }, false);

});
//////////////////////////End  $(document).ready(function()


    $('#eraser_search').click(function(){
        document.getElementById("plugins4_q").value = "";
        $("#example").empty();
    });

    $('#next_node').click(function(){
        next_node();
    });

    
    $('#previous_node').click(function(){
        previous_node()
    });

    $('#next_node2').click(function(){
        next_node();
    });

    
    $('#previous_node2').click(function(){
        previous_node()
    });

    $('#replace_term').click(function(){
        replace_word_in_ar_en_term();
    });

    $('#eraser_replace').click(function(){
        document.getElementById("from_term").value = "";
        document.getElementById("to_term").value = "";
    });

    

/////////////////////////////////////////////////////////////Function
    function clickOnRow(x) {
        $('#container').jstree(true).deselect_all();
        $('#container').jstree(true).select_node("'"+id+"'");
        id = x;
        
        
        if(compare == 1)
        {
            document.getElementById("save").value= "save";
            document.getElementById("save").style.display = "block";
            console.log(id);
            $.ajax({
                type :'GET',
                url:"{{route('node.view')}}",
                data:{
                    id : id
                },
                success:function(res){
                    console.log(res);
                    document.getElementById('code').value = res.code;
                    document.getElementById("parent_code").value = res.parent_code; 
                    document.getElementById('en_term').value = res.en_term;
                    document.getElementById('ar_term').value = res.ar_term;
                    //initialize summernote
                    $('.summernote').summernote();
                    $("#note").summernote('code',res.note);
                    $("#ar_note").summernote('code',res.ar_note);
                    //foucs
                    /*
                    var searchResult = $("#container").jstree('search',res.code+res.ar_term+);
                    $(searchResult).find('.jstree-search').focus();
                    */
                    $("#container").jstree(true).get_node(id, true).children('.jstree-anchor').focus();
 
        
                }
            });
        }
        else
        {
            document.getElementById("save").value= "save";
            document.getElementById("save").style.display = "block";
            document.getElementById("parent_code").value = code;
            document.getElementById("code").value = ""; 
            document.getElementById("en_term").value = "";
            document.getElementById("ar_term").value = "";
            //initialize summernote
            $('.summernote').summernote();
            $('.summernote').summernote('code', "");
            $('.summernote').summernote('code', "");
        }
    }


    function fill_field(compare){
        if(compare == 1)
        {
            document.getElementById("save").value= "save";
            document.getElementById("save").style.display = "block";
            $.ajax({
                type :"GET",
                url:"{{route('node.view')}}",
                data:{
                    id : id
                },
                success:function(res){
                    document.getElementById('code').value = res.code;
                    document.getElementById('parent_code').value = res.parent_code; 
                    document.getElementById('en_term').value = res.en_term;
                    document.getElementById('ar_term').value = res.ar_term;
                    //initialize summernote
                    
                    $('.summernote').summernote();
                    $("#note").summernote('code',res.note);
                    $("#ar_note").summernote('code',res.ar_note);
                }
            });
        }
        else
        {
            document.getElementById("save").value= "create";
            document.getElementById("save").style.display = "block";
            $.ajax({
                type :'GET',
                url:"{{route('node.view')}}",
                data:{
                    id : id
                },
                success:function(res){
                    document.getElementById("parent_code").value = res.code;
                    document.getElementById('code').value = "";
                    document.getElementById('en_term').value = "";
                    document.getElementById('ar_term').value = "";
                    //initialize summernote
                    $('.summernote').summernote();
                    $('.summernote').summernote('code', "");
                    $('.summernote').summernote('code', "");
                }
            });
        }
    }


    function search(){
        $.ajax({
                type :'GET',
                url:"{{route('classification.search_')}}",
                data:{
                    condition : $("#plugins4_q").val()
                },
                success:function(res){
                    $("#example").empty();
                    if(res){
                        $("#example").append("<thead><tr><th>id</th><th>Code</th><th>English Term</th><th>Arabic Term</th></tr></thead><tbody>")
                        result_search =  JSON.parse(res);
                        result_search.forEach(function(item){
                            
                            $("#example").append("<tr onclick='clickOnRow("+item.id+")'><td>"+item.id+"</td><td>"+item.code+"</td><td>"+ item.ar_term+"</td><td>"+item.en_term+"</td></tr>");
                        });
                        $("#example").append("</tbody>");
                    } 
                }
            });
    }

    function save_auto(id,compare,code,en_term,ar_term,note,ar_note,text_bold,text_italic,background_color,text_color) {
//        console.log(id+"--"+compare+"--"+code+"--"+en_term+"--"+ar_term+"--"+note);

        if(compare == 2){
            parent_id = id;
            id = null;
        }
        /*console.log(id);
        console.log(parent_id);
        console.log(code);
        console.log(en_term);
        console.log(ar_term);
        console.log(bold);
        console.log(italic);
        console.log(color_text);
        console.log(color_background);*/
        ar_term=super_script(ar_term);
        en_term=super_script(en_term);
        $.ajax({
                type :'GET',
                url:"{{route('node.save')}}",
                data:{
                    id : id,
                    parent_id : parent_id,
                    code : code,
                    en_term : en_term,
                    ar_term : ar_term,
                    note : note,
                    ar_note : ar_note,
                    bold : text_bold,
                    italic : text_italic,
                    color_text : text_color,
                    color_background : background_color
                },
                success:function(res){
                    //console.log(res);
                    //edit
                   var diminsion = JSON.parse(res);
                   //console.log(diminsion[0].code_width);
                    var text_ = "<div  style='font-weight: font-weight: "+text_bold+";font-style: "+text_italic+"; color:"+text_color+";background-color:"+background_color+";'><label  style='font-weight: "+text_bold+";float:right; width:"+diminsion[0].code_width+"px;font-size:16px;padding: 0.0ex ;' >"+diminsion[0].code+"</label>            <label style='font-weight: "+text_bold+";float:right; width:500px;direction:rtl;text-align:right;font-size:18px;padding: 0.0ex ;margint-buttom:0.01ex;' >"+diminsion[0].ar_term+"</label> <label  style='font-weight: "+text_bold+";text-align:left;width:"+diminsion[0].en_wdith+"px;font-size:16px;padding: 0.0ex ;margint-buttom:0.01ex;'>"+diminsion[0].en_term+"</label></div>";
                    if(compare == 1)
                    { 
                        var node = $('#container').jstree(true).get_node(id);
                        
                        node.text = text_ ;
                        $('#container').jstree(true).redraw_node(node, false, false, false);
                    }
                    //create
                    else
                    {
                        
                          $('#container').jstree().create_node(diminsion[0].parent_id ,  { "id" : diminsion[0].id, "text" : text_ }, "last", false);

                       // $('#container').jstree(true).refresh();               
                    }
                }               
            });

        // in case the node after update do not contain text this i want search it so i will search agian
        if(document.getElementById("plugins4_q").value.length != 0)
        {
            search();
        }
    }

    function createNode(parent_node, new_node_id, new_node_text, position) {
    $('#jstree').jstree('create_node', $(parent_node), { "text":new_node_text, "id":new_node_id }, position, false, false); 
    }

    function next_node(){
        var tree = $ ('#container'). jstree (true)
        curr = tree.get_selected (false);
        tree.deselect_all ();
        tree.open_all ();
        var n = tree.get_next_dom (curr);
        tree.select_node (n);
    }

    function previous_node(){
        var tree = $ ('#container'). jstree (true)
        curr = tree.get_selected (false);
        tree.deselect_all ();
        tree.open_all ();
        var n = tree.get_prev_dom (curr);
        tree.select_node (n);     
    }

    function replace_word_in_ar_en_term(from , to)
    {
        $.ajax({
                type :'GET',
                url:"{{route('classification.term_replace')}}",
                data:{
                    from :  $("#from_term").val(),
                    to :  $("#to_term").val(),
                },
                success:function(res){
                    console.log(res);
                    $('#container').jstree(true).refresh();
                }

        });
    }

     function super_script(text){
        var bold = /\*\*(\S(.*?\S)?)\*\*/gm;
        var html = text.replace(bold, '<sup style="color:blue;"><i><b>$1</b></i></sup>');            
        //var html = text.replace(bold, '<sup>$1</sup>');            
        return html;
    }
///////////////////////////
    $('#bold_button').click(function() {
        $(this).toggleClass('activated');
        //alert('Clicked, value = ' + $(this).hasClass('activated'));
        if($(this).hasClass('activated') == true)
            bold = "bold";
        else
            bold = "normal";
        autoChangeFontStyle(bold,italic,color_text,color_background)
    });
    $('#italic_button').click(function() {
        $(this).toggleClass('activated');
        //alert('Clicked, value = ' + $(this).hasClass('activated'));
        if($(this).hasClass('activated') == true)
            italic = "italic";
        else
            italic = "normal";
        autoChangeFontStyle(bold,italic,color_text,color_background)      
    });
    $('#copy_style_button').click(function() {
        $(this).toggleClass('activated');
        //alert('Clicked, value = ' + $(this).hasClass('activated'));
        if($(this).hasClass('activated') == true)
            copy_style = true;
        else
            copy_style = false;      
    });

    function boldFunction() {
        var element = document.getElementById("bold_button");
        if (element.classList) { 
            element.classList.toggle("mystyle");
        } 
    }

    function italicFunction() {
        var element = document.getElementById("italic_button");
        if (element.classList) { 
            element.classList.toggle("mystyle");
        } 
    }

    function copyStyleFunction() {
        var element = document.getElementById("copy_style_button");
        if (element.classList) { 
            element.classList.toggle("mystyle");
        }
        $.ajax({
                type :'GET',
                url:"{{route('node.view')}}",
                data:{
                    id : id
                },
                success:function(res){
                    console.log(res);
                    var level =res.classification_level;
                    copy_bold = res.bold;
                    copy_italic = res.italic;
                    copy_color_background = res.background_color;
                    copy_color_text = res.text_color;
                    copy_style = true;
                }
            }); 
    }

    function autoChangeFontStyle(bold,italic,color_text,color_background){
        $.ajax({
                type :'GET',
                url:"{{route('node.view')}}",
                data:{
                    id : id
                },
                success:function(res){
                    var level =res.classification_level;
                    var code_width = 40 + 10 * level;
                    var en_width = 500 - 22 * level - 1.15 * code_width;
                    var text_ ="<div  style='font-weight: font-weight: "+bold+";font-style: "+italic+"; color:"+color_text+";background-color:"+color_background+";'><label  style='font-weight: "+bold+";float:right; width:"+code_width+"px;font-size:16px;padding: 0.0ex ;' >"+res.code+"</label>            <label style='font-weight: "+bold+";float:right; width:500px;direction:rtl;text-align:right;font-size:18px;padding: 0.0ex ;margint-buttom:0.01ex;' >"+res.ar_term+"</label> <label  style='font-weight: "+bold+";text-align:left;width:"+en_width+"px;font-size:16px;padding: 0.0ex ;margint-buttom:0.01ex;'>"+res.en_term+"</label></div>";

                    var node = $('#container').jstree(true).get_node(id);    
                    node.text = text_ ;
                    $('#container').jstree(true).redraw_node(node, false, false, false);
                }
            });
    }
//for detect node 
    /*function autoDetermine(id){
        $.ajax({
                type :'GET',
                url:"{{route('node.view')}}",
                data:{
                    id : id
                },
                success:function(res){
                    old_id = res.id;
                    var level =res.classification_level;
                    var code_width = 40 + 10 * level;
                    var en_width = 500 - 22 * level - 1.15 * code_width;
                    var text_ = "<div style='font-weight: "+res.bold+";font-style: "+res.italic+"; color:"+res.text_color+";background-color:#c5e6f6'><label style='float:right; width:"+code_width+"px;font-size:16px;padding: 0.0ex ;'>"+res.code+"</label><label style='float:right; width:500px;direction:rtl;text-align:right;font-size:18px;padding: 0.0ex ;margint-buttom:0.01ex;'>"+res.ar_term+"</label><label style='text-align:left;width:"+en_width+"px;font-size:16px;padding: 0.0ex ;margint-buttom:0.01ex;'>"+res.en_term+"</label></div>";

                    var node = $('#container').jstree(true).get_node(id);    
                    node.text = text_ ;
                    $('#container').jstree(true).redraw_node(node, false, false, false);
                }
            });
    }

    function undetermine(old_id){
        $.ajax({
                type :'GET',
                url:"{{route('node.view')}}",
                data:{
                    id : old_id
                },
                success:function(res){
                    var level =res.classification_level;
                    var code_width = 40 + 10 * level;
                    var en_width = 500 - 22 * level - 1.15 * code_width;
                    var text_ = "<div style='font-weight: "+res.bold+";font-style: "+res.italic+"; color:"+res.text_color+";background-color:"+res.background_color+"'><label style='float:right; width:"+code_width+"px;font-size:16px;padding: 0.0ex ;'>"+res.code+"</label><label style='float:right; width:500px;direction:rtl;text-align:right;font-size:18px;padding: 0.0ex ;margint-buttom:0.01ex;'>"+res.ar_term+"</label><label style='text-align:left;width:"+en_width+"px;font-size:16px;padding: 0.0ex ;margint-buttom:0.01ex;'>"+res.en_term+"</label></div>";

                    var node = $('#container').jstree(true).get_node(id);    
                    node.text = text_ ;
                    $('#container').jstree(true).redraw_node(node, false, false, false);
                }
            });

    }*/






