<!DOCTYPE html>
<html  lang="ar" >
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
                        > P/Code<span class="text-danger">*</span></label>
                        <input type="text" name="parent_code" data-parsley-trigger="change"  class="form-control" id="parent_code" readOnly  style="height:30px" placeholder="Parent">
                        <input type="text" name="code" data-parsley-trigger="change" class="form-control" id="code"  style="height:30px" placeholder="Code">
                    </div>
                    <div class="col-md-5 mb-0 col-sm-0" style="padding: 0.0px;">
                        <button id="previous_node" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-arrow-circle-left bigfonts" aria-hidden="true"></i></button>

                        <label style="padding: 0.0px;margin: 0.0px">Classification English Term<span class="text-danger">*</span></label>

                         
                        <button id="next_node" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-arrow-circle-right bigfonts" aria-hidden="true"></i></button>



                        <textarea rows="2" cols="78" type="text" name="en_term" data-parsley-trigger="change" class="form-control" id="en_term" style="font-size:15px;height:60px;font-weight:bold;"   ></textarea>
                    </div>
                    <div class="col-md-6 mb-0 col-sm-0" style="padding-left: 0.1px;">
                        <div class="row">
                            <div class="col-md-4 mb-0 col-sm-0" style="padding-right: 1px;">
                                 <button id="previous_node2" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-arrow-circle-left bigfonts" aria-hidden="true"></i></button> 

                                <label style="padding: 0.0px;margin: 0.0px">Classification Arabic Term</label>

                                <button id="next_node2" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-arrow-circle-right bigfonts" aria-hidden="true"></i></button>
                            </div>
                             <!--   -->
                            <div class="col-md-4 mb-0 col-sm-0" style="padding-left: 0.1px;">
                                <button type="Addbutton" id="AddButton" class="btn btn-outline-primary btn-sm" style="padding: 0.0px;margin-left: 5.0px;"><i class="fa fa-plus bigfonts"></i> Add </button>
                                <button id="EditButton" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin-left: 20.0px"><i class="fa fa-pencil"></i> Edit </button>
                                <button id="DeleteButton" type="button" class="btn btn-outline-danger btn-sm" style="padding: 0.0px;margin-left: 20.0px"><i class="fa fa-trash-o"></i> Delete </button>
                            </div>
                            <div class="col-md-4 mb-0 col-sm-0" style="padding-left: 0.1px;">
                                <button class="btn btn-outline-primary btn-sm" href="{{route('classification.export')}}" style="padding: 0.0px;margin-left: 20.0px"><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Export</button>
                                <a class="btn btn-outline-primary btn-sm" href="{{route('classification.import_interface')}}" target="_blank" style="padding: 0.0px;margin-left: 20.0px"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import</a>
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
        <div dir="rtl">
            <!--        1           -->
            <div class="col-md-12 mb-0 col-sm-0">
                <!--fixedpar-->
                <div class="row">
                     <button id="save_auto__" name="save_auto__"  onclick="saveAotuFunction()" style = "margin-right:15px;"><i class="fa fa-magic bigfonts" aria-hidden="true"></i></button> 
                    <button id="save_create" class="btn btn-outline-success btn-sm" style = "margin-left: 1.0em;"><i class="fa fa-save bigfonts" aria-hidden="true"></i></button>
                    <form id="s" >
                        <div class="row">
                            <input  type="search" id="plugins4_q" value="" class="input" style="display:block;  border-radius:1px; border:1px solid silver;"  >
                            <button type="submit" class="btn btn-outline-success btn-sm" ><i class="fa fa-search bigfonts" aria-hidden="true"></i></button>
                        </div>
                    </form>
                    <button style="margin-right: 1.0em;" id="eraser_search" name="eraser_search" class="btn btn-outline-success btn-sm"  ><i class="fa fa-eraser bigfonts" aria-hidden="true"></i></button>
                   <a class="btn btn-outline-success btn-sm" href="{{route('classification.draw_tree3') }}" padding="4px" ><i class="fa fa-language bigfonts" aria-hidden="true"></i></a>
                    <input id="cut_node" name="cut_node" type="button" class="btn btn-outline-success btn-sm"  value="Cut">
                    <input id="past_node" name="past_node" type="button" class="btn btn-outline-success btn-sm" value="Paste">
                    <input type="button" class="btn btn-outline-success btn-sm"  value="ColAll" onclick="$('#container').jstree('close_all');">
                    <input type="button" class="btn btn-outline-success btn-sm"  value="EXpAll" onclick="$('#container').jstree('open_all');">
                    <input id="replace_term" name="replace_term" type="button" class="btn btn-outline-success btn-sm" value="Replace">
                    <input dir="ltr" id="to_term"  class="input" style="display:block;  border-radius:1px; border:1px solid silver;" placeholder="to">
                    <input dir="ltr"  id="from_term"  class="input" style="display:block;  border-radius:1px; border:1px solid silver;" placeholder="from">
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
                <hr class="fixedpar" style="float:right;border-style: inset; border-width: 0.8px;margin-top: 0.0em;margin-bottom: 0.0em; width:1100px;padding-bottom: 0.0px">
                <div  id="container"  style="display:block;overflow:auto;height:425px;width:1100px;text-align: right;"  >
                </div>
            </div>
        </div>


        <div dir="rtl">
            <hr style="float:right;border-style: inset; border-width: 2px;margin-right: 10px; margin-top: 0.0em;margin-bottom:0.0em; width:1100px;padding-bottom: 0.0px;">
            <div style="display:block;float:right;overflow:auto;height:195px;width:1105px;text-align: right;margin-right:10px; ">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered" style="width:100%;text-align: center;">
                    </table>
                </div>
            </div>
        </div>
 

</body>



<!---------------------------------------------------------------------------------------------------->
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
        "sort" :  function (a, b) {
            return this.get_node(a).original.px < this.get_node(b).original.px ? -1 : 1;
        },
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

            var ar_note;
            var myInput = document.getElementById('ar_note').value;
            if(myInput)
                ar_note = document.getElementById('ar_note').value ;

            console.log(copy_style);
            console.log(style_change);
            if(copy_style == true) 
                save_auto(id,compare,code,en_term,ar_term,note,ar_note,copy_bold,copy_italic,copy_color_text,copy_color_background,copy_under_line,copy_ar_size,copy_en_size);
            else
                if(style_change == true)
                    save_auto(id,compare,code,en_term,ar_term,note,ar_note,bold,italic,color_text,color_background,under_line,ar_size,en_size);
                else{
                    save_auto(id,compare,code,en_term,ar_term,note,ar_note,bold,italic,color_text,color_background,under_line,ar_size,en_size);
                }
        }
        id = data.selected[0];
        //parent_code = data.node.parent;
        /*for open all child node when click on node*/
       // $("#container").jstree(true).open_all([data.selected[0]]);
       //$("#container").jstree(true).open_node([data.selected[0]]);
        /**/
        if(id != null )
        {
            fill_field(compare);
            console.log(copy_style);
            console.log(style_change);
            if(copy_style == true) 
                autoChangeFontStyle(copy_bold,copy_italic,copy_color_text,copy_color_background,copy_under_line,copy_ar_size,copy_en_size);
            else
                if(style_change == true)
                    autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size);
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
    $('#save_create').click(function(){
        var code = document.getElementById('code').value;
        var en_term = document.getElementById('en_term').value;
        var ar_term = document.getElementById('ar_term').value;
        var note;
        var myInput = document.getElementById('note').value;
        if(myInput)
            note = document.getElementById('note').value ;

        var ar_note;
        var myInput = document.getElementById('ar_note').value;
        if(myInput)
            ar_note = document.getElementById('ar_note').value ;

        console.log(copy_style);
            console.log(style_change);
        if(copy_style == true) 
                save_auto(id,compare,code,en_term,ar_term,note,ar_note,copy_bold,copy_italic,copy_color_text,copy_color_background,copy_under_line,copy_ar_size,copy_en_size);
        else
            if(style_change == true)
                save_auto(id,compare,code,en_term,ar_term,note,ar_note,bold,italic,color_text,color_background,under_line,ar_size,en_size);  
            else{
                save_auto(id,compare,code,en_term,ar_term,note,ar_note,bold,italic,color_text,color_background,under_line,ar_size,en_size);
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

//////////

   let colorPicker_text = document.getElementById("colorPicker_text");
    colorPicker_text.addEventListener("input", function(event) {
        color_text = colorPicker_text.value;
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size)
      //  document.getElementById(id).style.color = event.target.value;
    }, false);
    colorPicker_text.addEventListener("change", function(event) {
        color_text = colorPicker_text.value;     
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size);
      //  document.getElementById(id).style.color = colorPicker_text.value;
    }, false);

   let colorPicker_backgraound = document.getElementById("colorPicker_backgraound");
    colorPicker_backgraound.addEventListener("input", function(event) {
        color_background = colorPicker_backgraound.value;
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size);
      //  document.getElementById(id).style.color = event.target.value;
    }, false);

    colorPicker_backgraound.addEventListener("change", function(event) {
        color_background = colorPicker_backgraound.value;
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size);
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
            /*document.getElementById("save").value= "save";
            document.getElementById("save").style.display = "block";*/
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
                    
                    $("#container").jstree(true).get_node(id, true).children('.jstree-anchor').focus();
 
        
                }
            });
        }
        else
        {
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
                    color_text=res.text_color;
                    color_background = res.background_color;
                    bold = res.bold;
                    italic = res.italic;
                    under_line = res.under_line;
                    en_size = res.en_size;
                    ar_size = res.ar_size
                    //initialize summernote
                    
                    $('.summernote').summernote();
                    $("#note").summernote('code',res.note);
                    $("#ar_note").summernote('code',res.ar_note);
                }
            });
        }
        else
        {
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
                        $("#example").append("<thead><tr style='font-weight:bold'><td>id</td><td>Code</td><td>Arabic Term</td><td>English Term</td></tr></thead><tbody>")
                        result_search =  JSON.parse(res);
                        result_search.forEach(function(item){
                            
                            $("#example").append("<tr onclick='clickOnRow("+item.id+")'><td>"+item.id+"</td><td>"+item.code+"</td><td>"+ item.ar_term+"</td><td>"+item.en_term+"</td></tr>");
                        });
                        $("#example").append("</tbody>");
                    } 
                }
            });
    }

    function save_auto(id,compare,code,en_term,ar_term,note,ar_note,text_bold,text_italic,text_color,background_color,under_line,ar_size,en_size) {
//        console.log(id+"--"+compare+"--"+code+"--"+en_term+"--"+ar_term+"--"+note);

        if(compare == 2){
            parent_id = id;
            id = null;
        } 
        console.log(under_line);
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
                    color_background : background_color,
                    under_line : under_line,
                    ar_size :ar_size,
                    en_size :en_size,
                },
                success:function(res){
                    console.log(res);
                    //edit
                   var diminsion = JSON.parse(res);
                   console.log(diminsion[0]);

                    var text_ ="<div style='word-wrap: break-word;font-weight: "+text_bold+";font-style: "+text_italic+"; color:"+text_color+";background-color:"+background_color+";'><label  style='word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";float:right; width:"+diminsion[0].code_width+"px;font-size:"+en_size+"px;padding: 0.0ex ;' >"+code+"</label><label style='word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";float:right; width:"+diminsion[0].width+"px;direction:rtl;text-align:right;font-size:"+ar_size+"px;padding: 0.0ex ;margint-buttom:0.01ex;' >"+ar_term+"</label><label dir='ltr'  style='word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";width:"+diminsion[0].width+"px;font-size:"+en_size+"px;padding: 0.0ex ;margint-buttom:0.01ex;'>"+en_term+"</label></div>";
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

    function replace_word_in_ar_en_term(from , to){
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
    //choice
  /*  $('#save_auto__').change(function(){

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
    });*/
    $('#save_auto__').click(function() {
        $(this).toggleClass('activated');
        //alert('Clicked, value = ' + $(this).hasClass('activated'));
        if($(this).hasClass('activated') == true)
            save_auto_choice = true;
        else
            save_auto_choice = false;
    });

    $('#style_button').click(function() {
        $(this).toggleClass('activated');
        //alert('Clicked, value = ' + $(this).hasClass('activated'));
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
        //alert('Clicked, value = ' + $(this).hasClass('activated'));
        if($(this).hasClass('activated') == true)
            bold = "bold";
        else
            bold = "normal";
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size)
    });
    $('#italic_button').click(function() {
        $(this).toggleClass('activated');
        //alert('Clicked, value = ' + $(this).hasClass('activated'));
        if($(this).hasClass('activated') == true)
            italic = "italic";
        else
            italic = "normal";
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size)      
    });
    $('#underLine_button').click(function() {
        $(this).toggleClass('activated');
        //alert('Clicked, value = ' + $(this).hasClass('activated'));
        if($(this).hasClass('activated') == true)
            under_line = "underline";
        else
            under_line = "none";
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size)
    });
    $('#up_size').click(function() {
        
            ar_size = 2 + parseInt(ar_size);
            en_size = 2 + parseInt(en_size);
        
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size)
    });
    $('#down_size').click(function() {
        ar_size = ar_size - 2;
        en_size = en_size - 2;
        autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size)
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
                    copy_under_line = res.under_line;
                    copy_en_size = res.en_size;
                    copy_ar_size = res.ar_size;

                }
            }); 
    }

    function autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size){
        console.log(under_line);
        $.ajax({
                type :'GET',
                url:"{{route('node.view')}}",
                data:{
                    id : id
                },
                success:function(res){
                    var level =res.classification_level;
                    var code_width = 40 + 10 * level;
                    if(level == 1){
                        width_ = 460.25; 
                    }
                    else
                        if(level==2)
                        {
                            width_ = 443.5;
                        }
                        else
                            if(level==3)
                            {
                                width_ = 426.75;
                            }
                            else
                                if(level==4)
                                {
                                    width_ = 410;
                                }
                                else
                                    if(level==5)
                                    {
                                        width_ = 393.25;
                                    }
                    var text_ ="<div style='font-weight: font-weight: "+bold+";font-style: "+italic+"; color:"+color_text+";background-color:"+color_background+";'><label  style='word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+bold+";float:right; width:"+code_width+"px;font-size:"+en_size+"px;padding: 0.0ex ;' >"+res.code+"</label><label style='word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+bold+";float:right; width:"+width_+"px;direction:rtl;text-align:right;font-size:"+ar_size+"px;padding: 0.0ex ;margint-buttom:0.01ex;' >"+res.ar_term+"</label><label dir='ltr'  style='word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+bold+";width:"+width_+"px;font-size:"+en_size+"px;padding: 0.0ex ;margint-buttom:0.01ex;'>"+res.en_term+"</label></div>";

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







</script>
</html>