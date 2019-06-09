<!DOCTYPE html>
<html lang="en">
<head>
<style>
.jstree-anchor { height:auto !important; white-space:normal !important; }

div.sticky {
  position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 0;
  padding: 1.0px;
  margin: 0.0px;
  background-color: #cae8ca;
  border: 2px solid #4CAF50; 
  z-index: 3; 
}
label {
  white-space: pre-wrap;
}
div.fixedpar {
  /*position: fixed; 
  right: 25px;
  margin-top: 0.0px;
  background-color: #cae8ca;*/
    position: -webkit-sticky;
    position: sticky;
    background-color: #cae8ca;
    top: 185px;
    z-index: 2;
}


.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 50px; }
  .toggle.ios .toggle-handle { border-radius: 50px; }

.red { background:red !important; }


sup{
    color:blue;
    font: italic bold 12px/30px Georgia, serif;
}
/*bold and italic*/
.mystyle {
  background-color: #1bb279;
  color: white;
}

/*
* to show and hidden code
*/
label.a {
  visibility: visible;
}

label.b {
  visibility: hidden;
}
</style>
        <!-- Switchery css -->
        <link href="{{ asset('/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet" />
        <!-- Bootstrap CSS -->
        <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Font Awesome CSS -->
        <link href="{{ asset('/assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Custom CSS -->
        <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

      

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/themes/default/style.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/jstree.min.js"></script>

    <!--NOTE-->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<!-- choice -->
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
 
 

</head>
<body>

    <div class="row sticky" style="border: 2px solid;padding: 5px;resize: vertical;overflow: auto;" >
            <!--        2           -->
        <div class="col-xs-16 col-sm-16 col-md-10 col-lg-10 col-xl-12" >
                <div class="row " >
                    <div class="col-md-1 mb-0 col-sm-0" style="padding-right: 1px;">
                        <label style="margin: 0.0px;"
                        > Code/P<span class="text-danger">*</span></label>
                        <input type="text" name="code" data-parsley-trigger="change" class="form-control" id="code"  style="height:30px" placeholder="Code">
                        <select class="form-control" name="parent_code" id="parent_code"  style="height:30px">
                        </select>
                        <input type= "text" name="parent__code" data-parsley-trigger="change" class="form-control" id="parent__code" readonly style="height:30px" placeholder="Code">
                    </div>
                    <div class="col-md-5 mb-0 col-sm-0" style="padding: 0.0px;">
                        <button id="previous_node" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-arrow-circle-left bigfonts" aria-hidden="true"></i></button>

                        <label style="padding: 0.0px;margin: 0.0px">Disease English Term<span class="text-danger">*</span></label>

                         
                        <button id="next_node" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-arrow-circle-right bigfonts" aria-hidden="true"></i></button>
                        <textarea rows="2" cols="78" type="text" name="en_term" data-parsley-trigger="change" class="form-control" id="en_term" style="font-size:15px;height:60px;font-weight:bold;"   ></textarea>
                    </div>
                    <div class="col-md-6 mb-0 col-sm-0" style="padding-left: 0.1px;">
                        <div class="row">
                            <div class="col-md-4 mb-0 col-sm-0" style="padding-right: 1px;">
                                 <button id="previous_node2" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-arrow-circle-left bigfonts" aria-hidden="true"></i></button> 

                                <label style="padding: 0.0px;margin: 0.0px">Disease Arabic Term</label>

                                <button id="next_node2" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-arrow-circle-right bigfonts" aria-hidden="true"></i></button>
                            </div>
                             <!--   -->
                            <div class="col-md-4 mb-0 col-sm-0" style="padding-left: 0.1px;">
                                <button type="Addbutton" id="AddButton" class="btn btn-outline-primary btn-sm" style="padding: 0.0px;margin-left: 5.0px;"><i class="fa fa-plus bigfonts"></i> Add </button>
                                <button id="EditButton" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin-left: 20.0px"><i class="fa fa-pencil"></i> Edit </button>
                                <button id="DeleteButton" type="button" class="btn btn-outline-danger btn-sm" style="padding: 0.0px;margin-left: 20.0px"><i class="fa fa-trash-o"></i> Delete </button>
                            </div>
                            <div class="col-md-4 mb-0 col-sm-0" style="padding-left: 0.1px;">
                                <button class="btn btn-outline-primary btn-sm" href="{{route('disease.export')}}" style="padding: 0.0px;margin-left: 20.0px"><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Export</button>
                                <a class="btn btn-outline-primary btn-sm" href="{{route('disease.import_interface')}}" target="_blank" style="padding: 0.0px;margin-left: 20.0px"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import</a>
                            </div>
                                <!-------->
                        </div>

                        <textarea rows="2" cols="78" type="text" name="ar_term" data-parsley-trigger="change"   class="form-control" id="ar_term"
                        dir="rtl" style="font-size:18px;height:60px;font-weight:bold;"></textarea>
                    </div>
                </div>



                <div class="row">
                {{ csrf_field() }}
                    <div class="col-md-6 mb-0 col-sm-0"  style="padding-right: 0.1px;">
                        <textarea id="note" name="note" class="summernote">Note : </textarea>
                    </div>
                    <div class="col-md-6 mb-0 col-sm-0" style="padding-left: 0.0px">
                        <textarea id="ar_note" name="ar_note" class="summernote">Note : </textarea>
                    </div>
                </div>
            </div>
    </div> 
<!-------------------------------------->
     <div >
            <!--        1           -->
            <div class="col-md-24 mb-0 col-sm-0">
                <!--fixedpar-->
                <div class="row" style="width:90%;">
                    <button id="save_auto__" name="save_auto__"  onclick="saveAotuFunction()" style = "margin-left:35px;"><i class="fa fa-magic bigfonts" aria-hidden="true"></i></button>
                    <button id="save_create" class="btn btn-outline-success btn-sm" style = "margin-left: 2px;margin-right: 16px;"><i class="fa fa-save bigfonts" aria-hidden="true"></i></button>
                    <form id="s" >
                        <div class="row">
                            <input  type="search" id="plugins4_q" value="" class="input" style="display:block;  border-radius:1px; border:1px solid silver;"  >
                            <button type="submit" class="btn btn-outline-success btn-sm" ><i class="fa fa-search bigfonts" aria-hidden="true"></i></button>
                        </div>
                    </form>
                    <button style="margin-left: 1.0em;" id="eraser_search" name="eraser_search" class="btn btn-outline-success btn-sm"  ><i class="fa fa-eraser bigfonts" aria-hidden="true"></i></button>
                    <a class="btn btn-outline-success btn-sm" href="{{route('disease.draw_tree_ar') }}" padding="4px" ><i class="fa fa-language bigfonts" aria-hidden="true"></i></a>
                    <input id="cut_node" name="cut_node" type="button" class="btn btn-outline-success btn-sm"  value="Cut">
                    <input id="past_node" name="past_node" type="button" class="btn btn-outline-success btn-sm" value="Paste">

                    <input type="button" class="btn btn-outline-success btn-sm"  value="ColAll" onclick="$('#container').jstree('close_all');">
                    <input type="button" class="btn btn-outline-success btn-sm"  value="EXpAll" onclick="$('#container').jstree('open_all');">
                    <input id="replace_term" name="replace_term" type="button" class="btn btn-outline-success btn-sm" value="Replace">
                    <input dir="ltr"  id="from_term"  class="input" style="display:block;  border-radius:1px; border:1px solid silver;" placeholder="from">
                    <input dir="ltr" id="to_term"  class="input" style="display:block;  border-radius:1px; border:1px solid silver;" placeholder="to">
                    <button id="eraser_replace" name="eraser_replace" class="btn btn-outline-success btn-sm"  ><i class="fa fa-eraser bigfonts" aria-hidden="true"></i></button>
                     <button id="style_button" name="style_button" onclick="styleFunction()" ><i class="fa fa-strikethrough bigfonts" aria-hidden="true"></i></button> 
                    <input class="input" style="margin-top: 0.22em;display :none" type="color" value="#000000" id="colorPicker_text" >
                    <input class="input" style="margin-top: 0.22em;display :none" type="color" value="#ffffff" id="colorPicker_backgraound"> 
                    <button id="bold_button" name="bold_button" style=";display :none" onclick="boldFunction()" ><i class="fa fa-bold bigfonts" aria-hidden="true" ></i></button>
                    <button id="italic_button" name="italic_button" style=";display :none" onclick="italicFunction()"><i class="fa fa-italic bigfonts" aria-hidden="true" ></i></button>
                    <button id="underLine_button" name="underLine_button" style=";display :none" onclick="underLineFunction()" ><i class="fa fa-underline bigfonts" aria-hidden="true"></i></button>
                    <button id="up_size" name="up_size" style=";display :none" class="btn btn-outline-success btn-sm" ><i class="fa fa-sort-up bigfonts" aria-hidden="true"></i></button>
                    <button id="down_size" name="down_size" style=";display :none" class="btn btn-outline-success btn-sm" ><i class="fa fa-sort-desc bigfonts" aria-hidden="true"></i></button>  
                    <button id="copy_style_button" name="copy_style_button"  onclick="copyStyleFunction()"><i class="fa fa-copy bigfonts" aria-hidden="true"></i></button>
                </div>
                <!-- Tree  -->
                <hr class="fixedpar" style="float:left;border-style: inset; border-width: 0.8px;margin-top: 0.0em;margin-bottom: 0.0em; width:1425px;padding-bottom: 0.0px">
                <div  id="container"  style="margin-left:15px;display:block;overflow:auto;height:425px;width:1425px;">
                </div>
                <div >
                    <hr style="float:left;border-style: inset; border-width: 2px;margin-right: 10px; margin-top: 0.0em;margin-bottom:0.0em; width:1425px;padding-bottom: 0.0px;">
                    <div style="display:block;float:left;overflow:auto;height:195px;width:1425px;text-align: left;margin-left:15px; ">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered" style="width:1000%;text-align: center;">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</body>
<!-----------------------------------------> 
<script type="text/javascript">
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
var style_change = false;
var color_text="000000";
var color_background = "ffffff";
var bold = "normal !important";
var italic = "normal";
var under_line = "none"
var copy_color_text="000000";
var copy_color_background = "ffffff";
var copy_bold = "normal !important";
var copy_italic = "normal";
var copy_under_line = "none";
var copy_style = false;
var ar_size=18;
var copy_ar_size=18; 
var en_size=16;
var copy_en_size=16;
var type ;
var code_width;
var en_width;
var ar_width;
    $(document).ready(function(){ 
    //fill data to tree  with AJAX call
    tree =$('#container').jstree({
        'core' : {
            "check_callback": true,
            'data' : {
                "url" : "{{route('disease.en_tree')}}",
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
        "sort" :  function (a, b) {
            return this.get_node(a).original.px < this.get_node(b).original.px ? -1 : 1;
        },
        'plugins': [ "sort","state","themes", "json_data", "ui", "Select", "types", "crrm","html_data", "search", "massload","dnd","changed"]
    }).on('create_node.jstree', function(e, data) {
        console.log('saved');
    });

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
            var parent_code = document.getElementById('parent_code').value;
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
                save_auto(id,compare,code,parent_code,en_term,ar_term,note,ar_note,copy_bold,copy_italic,copy_color_text,copy_color_background,copy_under_line,copy_ar_size,copy_en_size);
            else
                if(style_change == true)
                    save_auto(id,compare,code,parent_code,en_term,ar_term,note,ar_note,bold,italic,color_text,color_background,under_line,ar_size,en_size);
                else{
                    save_auto(id,compare,code,parent_code,en_term,ar_term,note,ar_note,bold,italic,color_text,color_background,under_line,ar_size,en_size);
                }
        }
        id = data.selected[0];
        if(id != null )
        {
            fill_field(compare);
            if(copy_style == true) 
                autoChangeFontStyle(copy_bold,copy_italic,copy_color_text,copy_color_background,copy_under_line,copy_ar_size,copy_en_size);
            else
                if(style_change == true)
                    autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size);
        }
    });
    //delete
    $('#DeleteButton').click(function(){
        if (confirm('Are you sure want to remove this classification?')) {
            $.ajax({
                type :'GET',
                url:"{{route('disease_node.delete')}}",
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
    $('#save_create').click(function(){
        var code = document.getElementById('code').value;
        var parent_code = document.getElementById('parent_code').value;
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
                save_auto(id,compare,code,parent_code,en_term,ar_term,note,ar_note,copy_bold,copy_italic,copy_color_text,copy_color_background,copy_under_line,copy_ar_size,copy_en_size);
        else
            if(style_change == true)
                save_auto(id,compare,code,parent_code,en_term,ar_term,note,ar_note,bold,italic,color_text,color_background,under_line,ar_size,en_size);  
            else{
                save_auto(id,compare,code,parent_code,en_term,ar_term,note,ar_note,bold,italic,color_text,color_background,under_line,ar_size,en_size);
            }
    });

    //note
    $('#note').summernote();
    $('#ar_note').summernote();

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
            url : "{{route('update_parent_disease')}}",
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
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size)
    }, false);
    colorPicker_text.addEventListener("change", function(event) {
        color_text = colorPicker_text.value;     
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size);
    }, false);

   let colorPicker_backgraound = document.getElementById("colorPicker_backgraound");
    colorPicker_backgraound.addEventListener("input", function(event) {
        color_background = colorPicker_backgraound.value;
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size);
    }, false);

    colorPicker_backgraound.addEventListener("change", function(event) {
        color_background = colorPicker_backgraound.value;
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size);
    }, false);

    document.getElementById("parent__code").style.display = "none";
//End Document ready
});

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


        function clickOnRow(id) {
            $('#container').jstree(true).deselect_all();
            $('#container').jstree(true).select_node("'"+id+"'");
            
            if(compare == 1)
            {
                //edit
                $.ajax({
                    type :'GET',
                    url:"{{route('disease_node.view')}}",
                    data:{
                        id : id,
                        parents_code : 1
                    },
                    success:function(res){
                        result_view =  JSON.parse(res);
                        var node =result_view.node;
                        document.getElementById('code').value = node.code;
                        document.getElementById("parent__code").style.display = "none";
                        document.getElementById("parent_code").style.display = "block";
                        $('#parent_code').empty();
                        $('#parent_code').append('<option value="'+node.parent_code+'">'+node.parent_code+'</option>');
                        $.each(result_view.parent_code,function(key,value){
                            $('#parent_code').append('<option value="'+key+'">'+value+'</option>');
                        });  
                        document.getElementById('en_term').value = node.en_term;
                        document.getElementById('ar_term').value = node.ar_term;
                        //initialize summernote
                        $('.summernote').summernote();
                        $("#note").summernote('code',res.note);
                        $("#ar_note").summernote('code',res.ar_note);
                        
                        $("#container").jstree(true).get_node(id, true).children('.jstree-anchor').focus();
                    }
                });
            }
            else
            {
                $.ajax({
                    type :'GET',
                    url:"{{route('disease_node.view')}}",
                    data:{
                        id : id,
                        parents_code : 0
                    },
                    success:function(res){
                        //add
                        result_view =  JSON.parse(res);
                        var node =result_view.node;
                        document.getElementById("parent_code").style.display = "none";
                        document.getElementById("parent__code").style.display = "block";
                        document.getElementById("parent__code").value = node.code;
                        document.getElementById("code").value = ""; 
                        document.getElementById("en_term").value = "";
                        document.getElementById("ar_term").value = "";
                        //initialize summernote
                        $('.summernote').summernote();
                        $('.summernote').summernote('code', "");
                        $('.summernote').summernote('code', "");
                    }
                });
            }
        }

    function fill_field(compare){
    if(id != null){
        if(compare == 1)
        {
            $.ajax({
                type :"GET",
                url:"{{route('disease_node.view')}}",
                data:{
                    id : id,
                    parents_code : 1
                },
                success:function(res){
                            result_view =  JSON.parse(res);
                            var node =result_view.node;
                            document.getElementById('code').value = node.code;
                            document.getElementById("parent__code").style.display = "none";
                            document.getElementById("parent_code").style.display = "block";
                            $('#parent_code').empty();
                            $('#parent_code').append('<option value="'+node.parent_code+'">'+node.parent_code+'</option>');
                            $.each(result_view.parent_code,function(key,value){
                                $('#parent_code').append('<option value="'+key+'">'+value+'</option>');
                            });
                            $('#parent_code').append('<option value="null">'+''+'</option>'); 
                            document.getElementById('en_term').value = node.en_term;
                            document.getElementById('ar_term').value = node.ar_term;
                            color_text=node.text_color;
                            color_background = node.background_color;
                            bold = node.bold;
                            italic = node.italic;
                            under_line = node.under_line;
                            en_size = node.en_size;
                            ar_size = node.ar_size;

                            type = result_view.type;
                            code_width = result_view.code_width;
                            ar_width = result_view.ar_width;
                            en_width = result_view.en_width;
                            //initialize summernote
                            $('.summernote').summernote();
                            $("#note").summernote('code',node.note);
                            $("#ar_note").summernote('code',node.ar_note);                     
                }
            });
        }
        else
        {
            $.ajax({
                type :'GET',
                url:"{{route('disease_node.view')}}",
                data:{
                    id : id,
                    parents_code : 0
                },
                success:function(res){
                    result_view =  JSON.parse(res);
                    var node =result_view.node;
                    document.getElementById("parent_code").style.display = "none";
                    document.getElementById("parent__code").style.display = "block";
                    document.getElementById("parent__code").value = node.code;
                    document.getElementById('code').value = "";
                    document.getElementById('en_term').value = "";
                    document.getElementById('ar_term').value = "";
                    document.getElementById("parent_code").readOnly = true;
                    //initialize summernote
                    $('.summernote').summernote();
                    $('.summernote').summernote('code', "");
                    $('.summernote').summernote('code', "");
                }
            });
        }
    }}

    function search(){
        $.ajax({
            type :'GET',
            url:"{{route('disease_node.search')}}",
            data:{
                condition : $("#plugins4_q").val()
            },
            success:function(res){
                $("#example").empty();
                if(res){
                    $("#example").append("<thead><tr style='font-weight:bold'><td>id</td><td>Code</td><td>English Term</td><td>Arabic Term</td></tr></thead><tbody>")
                    result_search =  JSON.parse(res);
                    result_search.forEach(function(item){
                        $("#example").append("<tr onclick='clickOnRow("+item.id+")'><td>"+item.id+"</td><td>"+item.code+"</td><td>"+item.en_term+"</td><td>"+item.ar_term+"</td></tr>");
                    });
                    $("#example").append("</tbody>");
                } 
            }
        });
    }
//parent_code contain parent_id
    function save_auto(id,compare,code,parent_code,en_term,ar_term,note,ar_note,text_bold,text_italic,text_color,background_color,under_line,ar_size,en_size) {
        console.log(ar_term);
        console.log(en_term);
        console.log(ar_note);
        console.log(note);
        console.log(code);

        console.log(id);
        if(compare == 2){
            parent_id = id;
            id = null;
        } 
        ar_term=super_script(ar_term);
        en_term=super_script(en_term);
        $.ajax({
            type :'GET',
            url:"{{route('disease_node.save')}}",
            data:{
                id : id,
                parent_id : parent_id,
                parent_code : parent_code, 
                code : code,
                en_term : en_term,
                ar_term : ar_term,
                note : note,
                ar_note : ar_note,
                bold : text_bold,
                italic : text_italic,
                color_text : text_color,
                color_background : background_color,
                under_line : under_line,
                ar_size :ar_size,
                en_size :en_size,
            },
            success:function(res){
                //edit
                console.log(res);
                var diminsion = JSON.parse(res);
                var code_width = diminsion[0].code_width;
                var en_width = diminsion[0].en_width;
                var ar_width = diminsion[0].ar_width;
                var type = diminsion[0].type;
                var id = diminsion[0].id;
                var parent_id = diminsion[0].parent_id;
                var text_ ="<div style='font-weight: "+text_bold+";font-style: "+text_italic+";'><label class="+type+" style='background-color:"+background_color+";color:"+text_color+";word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";float:left; width:"+code_width+"px;font-size:"+en_size+"px;padding: 0.0ex ;' >"+code+"</label><label  style='background-color:"+background_color+";color:"+text_color+";word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";width:"+en_width+"px;font-size:"+en_size+"px;float:left;text-align:left;padding: 0.0ex ;margint-buttom:0.01ex;'>"+en_term+"</label><label dir='rtl' style='background-color:"+background_color+";color:"+text_color+";word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";float:right; width:"+ar_width+"px;direction:rtl;text-align:right;font-size:"+ar_size+"px;padding: 0.0ex ;margint-buttom:0.01ex;' >"+ar_term+"</label></div>";
                if(compare == 1)
                { 
                    if(parent_id == 0)
                    {
                        var node_tree = $('#container').jstree(true).get_node(id);
                        node_tree.text = text_ ;
                        console.log(id);
                        $('#container').jstree(true).redraw_node(node_tree, false, false, false);
                    }
                    else
                    {
                        $('#container').jstree(true).refresh();
                    }
                }
                //create
                else
                {
                      $('#container').jstree().create_node(parent_id ,  { "id" : id, "text" : text_ }, "first", false);              
                }
            }              
        });
        // in case the node after update do not contain text this i want search it so i will search agian
        if(document.getElementById("plugins4_q").value.length != 0)
        {
            search();
        }
    }

    function next_node(){
        var tree = $ ('#container').jstree (true)
        curr = tree.get_selected (false);
        tree.deselect_all ();
        tree.open_all ();
        var n = tree.get_next_dom (curr);
        tree.select_node(n);
        //foucs
        $("#container").jstree(true).get_node(n[0].id, true).children('.jstree-anchor').focus();
    }

    function previous_node(){
        var tree = $ ('#container'). jstree (true)
        curr = tree.get_selected (false);
        tree.deselect_all ();
        tree.open_all ();
        var n = tree.get_prev_dom (curr);
        tree.select_node (n);
        //foucs
        $("#container").jstree(true).get_node(n[0].id, true).children('.jstree-anchor').focus();     
    }

    function replace_word_in_ar_en_term(from , to){
        $.ajax({
            type :'GET',
            url:"{{route('disease_term.replace')}}",
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
        return html;
    }

    $('#save_auto__').click(function() {
        $(this).toggleClass('activated');
        if($(this).hasClass('activated') == true)
            save_auto_choice = true;
        else
            save_auto_choice = false;
    });

    $('#style_button').click(function() {
        $(this).toggleClass('activated');
        if($(this).hasClass('activated') == true)
        {
            style_change = true;
            document.getElementById("bold_button").style.display = "block";
            document.getElementById("italic_button").style.display = "block";
            document.getElementById("underLine_button").style.display = "block";
            document.getElementById("colorPicker_text").style.display = "block";
            document.getElementById("colorPicker_backgraound").style.display = "block";
            document.getElementById("up_size").style.display = "block";
            document.getElementById("down_size").style.display = "block";
        }
        else
        {
            style_change = false;
            document.getElementById("bold_button").style.display = "none";
            document.getElementById("italic_button").style.display = "none";
            document.getElementById("underLine_button").style.display = "none";
            document.getElementById("colorPicker_text").style.display = "none";
            document.getElementById("colorPicker_backgraound").style.display = "none";
            document.getElementById("up_size").style.display = "none";
            document.getElementById("down_size").style.display = "none";
        }
    });

    $('#bold_button').click(function() {
        $(this).toggleClass('activated');
        if($(this).hasClass('activated') == true)
            bold = "bold";
        else
            bold = "normal";
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size)
    });

    $('#italic_button').click(function() {
        $(this).toggleClass('activated');
        if($(this).hasClass('activated') == true)
            italic = "italic";
        else
            italic = "normal";
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size);      
    });
    $('#underLine_button').click(function() {
        $(this).toggleClass('activated');
        if($(this).hasClass('activated') == true)
            under_line = "underline";
        else
            under_line = "none";
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size);
    });

    $('#up_size').click(function() {   
        ar_size = 2 + parseInt(ar_size);
        en_size = 2 + parseInt(en_size);
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size);
    });

    $('#down_size').click(function() {
        ar_size = ar_size - 2;
        en_size = en_size - 2;
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size);
    });

    $('#copy_style_button').click(function() {
        $(this).toggleClass('activated');
        if($(this).hasClass('activated') == true)
        {
            copy_style = true;
            document.getElementById("bold_button").style.display = "none";
            document.getElementById("italic_button").style.display = "none";
            document.getElementById("underLine_button").style.display = "none";
            document.getElementById("colorPicker_text").style.display = "none";
            document.getElementById("colorPicker_backgraound").style.display = "none";
            document.getElementById("up_size").style.display = "none";
            document.getElementById("down_size").style.display = "none";
        }
        else
        {
            copy_style = false;
            if(style_change == true)
            {
                document.getElementById("bold_button").style.display = "block";
                document.getElementById("italic_button").style.display = "block";
                document.getElementById("underLine_button").style.display = "block";
                document.getElementById("colorPicker_text").style.display = "block";
                document.getElementById("colorPicker_backgraound").style.display = "block";
                document.getElementById("up_size").style.display = "block";
                document.getElementById("down_size").style.display = "block";
            }      
        }
    });

    function saveAotuFunction() {
        var element = document.getElementById("save_auto__");
        if (element.classList) { 
            element.classList.toggle("mystyle");
        } 
    }

    function styleFunction() {
        var element = document.getElementById("style_button");
        if (element.classList) { 
            element.classList.toggle("mystyle");
        } 
    }

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

    function underLineFunction() {
        var element = document.getElementById("underLine_button");
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
                url:"{{route('disease_node.view')}}",
                data:{
                    id : id,
                    parents_code : 0
                },
                success:function(res){
                    result_view =  JSON.parse(res);
                    var node =result_view.node;
                    
                    copy_bold = node.bold;
                    copy_italic = node.italic;
                    copy_color_background = node.background_color;
                    copy_color_text = node.text_color;
                    copy_under_line = node.under_line;
                    copy_en_size = node.en_size;
                    copy_ar_size = node.ar_size;

                }
            }); 
    }

    function autoChangeFontStyle(text_bold,text_italic,text_color,background_color,under_line,ar_size,en_size){
            $.ajax({
                type :'GET',
                url:"{{route('disease_node.view')}}",
                data:{
                    id : id ,
                    parents_code : 0
                },
                success:function(res){
                    result_view =  JSON.parse(res);
                    console.log(result_view);
                    var node =result_view.node;
                    var code_width = result_view.code_width;
                    var ar_width = result_view.ar_width;
                    var en_width = result_view.en_width;
                    var type = result_view.type;
                    var text_ ="<div style='font-weight: "+text_bold+";font-style: "+text_italic+"; background-color:"+background_color+";'><label class="+type+" style='color:"+text_color+";word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";float:left; width:"+code_width+"px;font-size:"+en_size+"px;padding: 0.0ex ;' >"+node.code+"</label><label   style='color:"+text_color+";word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";float:left;width:"+en_width+"px;text-align:left;font-size:"+en_size+"px;padding: 0.0ex ;margint-buttom:0.01ex;'>"+node.en_term+"</label><label dir='rtl' style='color:"+text_color+";text-align:right;word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";width:"+ar_width+"px;font-size:"+ar_size+"px;padding: 0.0ex ;margint-buttom:0.01ex;' >"+node.ar_term+"</label></div>";
                    var node_tree = $('#container').jstree(true).get_node(node.id);    
                    node_tree.text = text_ ;
                    $('#container').jstree(true).redraw_node(node_tree, false, false, false);
                }
            });
        }
</script>


</html>
