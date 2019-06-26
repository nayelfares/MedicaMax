<!DOCTYPE html>
<html lang="en">
 <meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
#bottom{
         visibility:hidden;
    }
    
/*    summercontainer*/    
#summercontainer{
        position: relative;
        height: 350px;
        width: 1335px;
    }


.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 50px; }
  .toggle.ios .toggle-handle { border-radius: 50px; }



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
/*Change background colour on mouse over of all rows in table  */
tbody tr:hover {
  background-color: #bedcfc;
}

label.solid {border-style: solid; border-width: 0.5px;}
div.groove {border-style: groove;}
div.ridge {border-style: ridge;}
div.none {border-style: none;}

.selected{background-color: red; }

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link href="{{asset('/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<script src="{{asset('/assets/plugins/select2/js/select2.min.js')}}"></script>
 

        <!-- Switchery css -->
        <link href="{{ asset('/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet" />
        <!-- Bootstrap CSS -->
        <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Font Awesome CSS -->
        <link href="{{ asset('/assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Custom CSS -->
        <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

      


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/themes/default/style.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/jstree.min.js"></script>

    <!--NOTE-->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
   <script src="{{asset('/assets/js/ckeditor/ckeditor.js')}}"></script>

<!-- choice -->
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

</head>
<body>

    <div class="row sticky" style="border: 2px solid;padding: 0px;resize: none;overflow: auto;" >
            <!--        2           -->
            <div id="top">    <!-- This div will handle all bottom bars. -->  </div>
                 <div id="summercontainer" style="margin-top: 0.0em;margin-bottom: 0.0em;">
                    <div class="row "  >
                        <div class="col-md-1 mb-0 col-sm-0" style="padding-right: 1px;">
                            <label style="margin: 0.0px;height:30px;"
                            > P/Code<span class="text-danger">**</span></label>
                            <div id="div_parent">
                                <select class="form-control select2" name="parent_code" id="parent_code"  style="height:30px">
                                </select>
                            </div>
                            <input type= "text" name="parent__code" data-parsley-trigger="change" class="form-control" id="parent__code" readonly style="height:30px" placeholder="Code">
                            <input type= "text" name="term_id" id="term_id">
                            <input type="text" name="code" data-parsley-trigger="change" class="form-control" id="code"  style="height:30px" placeholder="Code">

                             <input type= "text" name="style 1" id="style1" placeholder="Style 1" style="width:95px;">
                            <input type= "text" name="style 2" id="style2" placeholder="Style 2" style="width:95px;"> 
                            <input type= "text" name="style 3" id="style3" placeholder="Style 3" style="width:95px;"> 
                            <input type= "text" name="style 4" id="style4" placeholder="Style 4" style="width:95px;">
                        </div>
                        <div class="col-md-5 mb-0 col-sm-0" style="padding: 0.0px;">
                             
                            <button id="sdf_previous_node" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-caret-square-o-up bigfonts" aria-hidden="true"></i></button> 
                                     
                            <button id="previous_node" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-arrow-circle-left bigfonts" aria-hidden="true"></i></button>

                            <label style="padding: 0.0px;margin: 0.0px;height:30px;">English Term<span class="text-danger">*</span></label>
                             
                            <button id="next_node" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-arrow-circle-right bigfonts" aria-hidden="true"></i></button>
                            <button id="sdf_next_node" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-caret-square-o-down bigfonts" aria-hidden="true"></i></button>
                           <button type="Addbutton" id="AddButton" class="btn btn-outline-primary btn-sm" style="padding: 0.0px;margin-left: 5.0px;"><i class="fa fa-plus bigfonts"></i> Add </button>
                           <button id="EditButton" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin-left: 20.0px"><i class="fa fa-pencil"></i> Edit </button>
                           <button id="DeleteButton" type="button" class="btn btn-outline-danger btn-sm" style="padding: 0.0px;margin-left: 20.0px"><i class="fa fa-trash-o"></i> Delete </button>
                            <textarea rows="2" cols="78" type="text" name="en_term" data-parsley-trigger="change" class="form-control" id="en_term" style="font-size:15px;height:100px;font-weight:bold;resize:none;"   ></textarea>
                        </div>
                        <div class="col-md-6 mb-0 col-sm-0" style="padding-left: 0.1px;">
                            <div class="row">
                                <div class="col-md-4 mb-0 col-sm-0" style="padding-right: 1px;">
                                     <button id="sdf_previous_node2" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-caret-square-o-up bigfonts" aria-hidden="true"></i></button> 

                                     <button id="previous_node2" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-arrow-circle-left bigfonts" aria-hidden="true"></i></button> 

                                    <label style="padding: 0.0px;margin: 0.0px">Arabic Term</label>

                                    <button id="next_node2" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-arrow-circle-right bigfonts" aria-hidden="true"></i></button>
                                    <button id="sdf_next_node2" type="button" class="btn btn-outline-success btn-sm" style="padding: 0.0px;margin: 0.0px"><i class="fa fa-caret-square-o-down bigfonts" aria-hidden="true"></i></button>
                                </div>
                                 <!--   -->
                                <div class="col-md-4 mb-0 col-sm-0" style="padding-left: 0.1px;">
                                     <button id="save_auto__" name="save_auto__"  onclick="saveAotuFunction()" style = "margin-left:35px;"><i class="fa fa-magic bigfonts" aria-hidden="true"></i></button>
                                    <button id="save_create" class="btn btn-outline-success btn-sm" style = "margin-left: 2px;margin-right: 16px;"><i class="fa fa-save bigfonts" aria-hidden="true"></i></button>
                                </div>
                                <div class="col-md-4 mb-0 col-sm-0" style="padding-left: 0.1px;">
                                   <!-- <button class="btn btn-outline-primary btn-sm" href="{{route('dif_dia.export')}}" style="padding: 0.0px;margin-left: 20.0px"><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Export</button>-->
                                    <a class="btn btn-outline-primary btn-sm" href="{{route('dif_dia.import_interface')}}" target="_blank" style="padding: 0.0px;margin-left: 20.0px"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import</a>
                                </div>
                                    <!-------->
                            </div>

                            <textarea rows="2" cols="78" type="text" name="ar_term" data-parsley-trigger="change"   class="form-control" id="ar_term"
                            dir="rtl" style="font-size:18px;height:100px;font-weight:bold;resize:none;"></textarea>
                        </div>
                    </div>


                    <div class="row" style="margin-top: 0.0em;margin-bottom: 0.0em;height:160px;">
                    {{ csrf_field() }}
                        <div class="col-md-6 mb-0 col-sm-0"  style="padding-right: 0.1px;margin-top: 0.0em;margin-bottom: 0.0em;">
                            <textarea id="en_note" name="en_note" > </textarea>
                        </div>
                        <div class="col-md-6 mb-0 col-sm-0" style="padding-left: 0.0px;margin-top: 0.0em;margin-bottom: 0.0em;text-align:right;">
                            <textarea id="ar_note" name="ar_note"  > </textarea>
                        </div>
                    </div>
                </div>
                <div id="bottom" >    <!-- This div will handle all bottom bars. -->  </div>
                <hr class="fixedpar" style="float:left;border-style: inset; border-width: 0.8px;margin-top: 0.0em;margin-bottom: 0.0em; width:100%;padding-bottom: 0.0px">
                
         <!--fixedpar-->
                <div class="row" style="width:90%;">

                    <form id="s" >
                        <div class="row" style="margin-left:30px;">
                            <input  type="search" id="plugins4_q" value="" class="input" style="display:block;  border-radius:1px; border:1px solid silver;"  >
                            <button type="submit" class="btn btn-outline-success btn-sm" ><i class="fa fa-search bigfonts" aria-hidden="true"></i></button>
                        </div>
                    </form>
                    <button style="margin-left: 1.0em;" id="eraser_search" name="eraser_search" class="btn btn-outline-success btn-sm"  ><i class="fa fa-eraser bigfonts" aria-hidden="true"></i></button>
                    <input id="cut_node" name="cut_node" type="button" class="btn btn-outline-success btn-sm"  value="Cut">
                    <input id="past_node" name="past_node" type="button" class="btn btn-outline-success btn-sm" value="Paste">

                    <input type="button" class="btn btn-outline-success btn-sm"  value="ColAll" onclick="$('#container').jstree('close_all');">
                    <input type="button" class="btn btn-outline-success btn-sm"  value="EXpAll" onclick="$('#container').jstree('open_all');">
                    <input type="button" class="btn btn-outline-success btn-sm"  value="EXpNode" onclick="open_all_child()">
                    <input id="replace_term" name="replace_term" type="button" class="btn btn-outline-success btn-sm" value="Replace">
                    <input dir="ltr"  id="from_term"  class="input" style="display:block;  border-radius:1px; border:1px solid silver;" placeholder="from">
                    <input dir="ltr" id="to_term"  class="input" style="display:block;  border-radius:1px; border:1px solid silver;" placeholder="to">
                    <button id="eraser_replace" name="eraser_replace" class="btn btn-outline-success btn-sm"  ><i class="fa fa-eraser bigfonts" aria-hidden="true"></i></button>
                    <button id="copy_style_button" name="copy_style_button"  onclick="copyStyleFunction()"><i class="fa fa-copy bigfonts" aria-hidden="true"></i></button> 
                    <input class="input" style="margin-top: 0.22em;display :none" type="color" value="#000000" id="colorPicker_text" >
                    <input class="input" style="margin-top: 0.22em;display :none" type="color" value="#ffffff" id="colorPicker_backgraound"> 
                    <button id="bold_button" name="bold_button" style=";display :none" onclick="boldFunction()" ><i class="fa fa-bold bigfonts" aria-hidden="true" ></i></button>
                    <button id="italic_button" name="italic_button" style=";display :none" onclick="italicFunction()"><i class="fa fa-italic bigfonts" aria-hidden="true" ></i></button>
                    <button id="underLine_button" name="underLine_button" style=";display :none" onclick="underLineFunction()" ><i class="fa fa-underline bigfonts" aria-hidden="true"></i></button>
                    <button id="borderStyle_button" name="borderStyle_button" style=";display :none" onclick="borderStyleFunction()" ><i class="fa fa-square-o bigfonts" aria-hidden="true"></i></button>
                    <button id="up_size" name="up_size" style=";display :none" class="btn btn-outline-success btn-sm" ><i class="fa fa-sort-up bigfonts" aria-hidden="true"></i></button>
                    <button id="down_size" name="down_size" style=";display :none" class="btn btn-outline-success btn-sm" ><i class="fa fa-sort-desc bigfonts" aria-hidden="true"></i></button>  
                </div>

    </div> 
<!-------------------------------------->
     <div  >
            <!--        1           -->
            <div class="col-md-24 mb-0 col-sm-0">
                <!-- Tree  -->
                <hr class="fixedpar" style="float:left;border-style: inset; border-width: 0.8px;margin-top: 0.0em;margin-bottom: 0.0em; width:1425px;padding-bottom: 0.0px">
                <div  id="container"  style="margin-left:15px;display:block;overflow:auto;height:425px;width:1000px;">
                </div>
                <div >
                    <hr style="float:left;border-style: inset; border-width: 2px;margin-right: 10px; margin-top: 0.0em;margin-bottom:0.0em; width:925px;padding-bottom: 0.0px;">
                    <div style="display:block;float:left;overflow:auto;height:195px;width:1000px;text-align: left;margin-left:15px; ">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered" style="width:1000%;">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</body>
<!-----------------------------------------> 
<script type="text/javascript">
    var id;
    var parent_code ;
    var parent_id ;
    var compare = 1;// 1 :edit , 2 : add
    var result_search;
    var first = true;
    var save_auto_choice = false;
    var cut_node_id ;
    var color_text="#000000";
    var color_background = "ffffff";
    var bold = "normal !important";
    var italic = "normal";
    var under_line = "none";
    var copy_style = false;
    var border_style = "none";
    var ar_size=18; 
    var en_size=14;
    var type ;
    var code_width;
    var en_width;
    var ar_width;
    var selected_node;
    var all_parents_code = "";
    var get_data = 0;




    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){ 
            tree =$('#container').jstree({
        'core' : {
            "check_callback": true,
            'data' : {
                "url" : "{{route('dif_dia.en_tree')}}",
                "plugins" : [ "checkbox","state"],
                "dataType" : "json" // needed only if you do not supply JSON headers
            },
            "themes": {
            "theme": "default",
            "dots": false,
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
        'plugins': [ "state","themes", "json_data", "ui", "Select", "types", "crrm","html_data", "search", "massload","dnd","changed"]
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

            /*for open all child node when click on node*/
            selected_node = [data.selected[0]];       
            /**/

            if(id != null && save_auto_choice == true){
                var my_id = document.getElementById('term_id').value;
                var code = document.getElementById('code').value;
                var parent_code = document.getElementById('parent_code').value;
                var en_term = CKEDITOR.instances['en_term'].getData();
                var ar_term = CKEDITOR.instances['ar_term'].getData();
                var myInput = CKEDITOR.instances['en_note'].getData();
                if(myInput)
                    en_note = CKEDITOR.instances['en_note'].getData();
                else
                    en_note = " ";

                var ar_note;
                var myInput = CKEDITOR.instances['ar_note'].getData();
                if(myInput)
                    ar_note = CKEDITOR.instances['ar_note'].getData();
                else
                    ar_note = " ";
                save_auto(my_id,compare,code,parent_code,en_term,ar_term,en_note,ar_note,bold,italic,color_text,color_background,under_line,ar_size,en_size,copy_style);
            }
            id = data.selected[0];
            if(id != null )
            {
                fill_field(compare , id);
                if(copy_style == true)
                {
                    
                    autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size,border_style);
                }
            }
        });
        //delete
        $('#DeleteButton').click(function(){
            if (confirm('Are you sure want to remove this Differential Diagnoses?')) {
                $.ajax({
                    type :'GET',
                    url:"{{route('dif_dia_node.delete')}}",
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
            fill_field(compare , id);
        });
        //ADD
        $('#AddButton').click(function(){
            compare = 2;
            fill_field(compare , id);
        });
        //save  
        $('#save_create').click(function(){

            saveFunction();
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
                url : "{{route('update_parent_dif_dia')}}",
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
            autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size,border_style);
        }, false);

       let colorPicker_backgraound = document.getElementById("colorPicker_backgraound");
        colorPicker_backgraound.addEventListener("input", function(event) {
            color_background = colorPicker_backgraound.value;
            autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size,border_style);
        }, false);

        colorPicker_backgraound.addEventListener("change", function(event) {
            color_background = colorPicker_backgraound.value;
            autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size,border_style);
        }, false);

        document.getElementById("parent__code").style.display = "none";
        document.getElementById("term_id").style.display = "none";
        


        // Initialize select2
        $('.select2').select2();
        //get parents code
        if(get_data == 0){
            $.ajax({
                type :"GET",
                url:"{{route('get_parent_codes')}}",
                success:function(res){
                    result_view =  JSON.parse(res);        
                    $.each(result_view,function(key,value){
                        all_parents_code = all_parents_code.concat('<option value="'+key+'">'+value+'</option>');
                    });
                    all_parents_code = all_parents_code.concat('<option value="null">'+'null'+'</option>'); 
                    get_data=1;       
                }
            });
        }  


          
    //End Document ready
    });           

            $('#eraser_search').click(function(){
                document.getElementById("plugins4_q").value = "";
                $("#example").empty();
            });

            $('#next_node').click(function(){
                next_open_node();
            });

            
            $('#previous_node').click(function(){
                previous_open_node()
            });

            $('#next_node2').click(function(){
                next_open_node();
            });

            
            $('#previous_node2').click(function(){
                previous_open_node()
            });

            $('#sdf_next_node').click(function(){
                search_deep_first_next_node();
            });

            
            $('#sdf_previous_node').click(function(){
                search_deep_first_previous_node()
            });

            $('#sdf_next_node2').click(function(){
                search_deep_first_next_node();
            });

            
            $('#sdf_previous_node2').click(function(){
                search_deep_first_previous_node()
            });

            $('#replace_term').click(function(){
                replace_word_in_ar_en_term();
            });

            $('#eraser_replace').click(function(){
                document.getElementById("from_term").value = "";
                document.getElementById("to_term").value = "";
            });



    function selectedRow(){
               //change color node you selected 
               console.log("color");
                var index;
                    table = document.getElementById("example");
            
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                         // remove the background from the previous selected row
                        if(typeof index !== "undefined"){
                           table.rows[index].classList.toggle("selected");
                        }
                        // get the selected row index
                        index = this.rowIndex;
                        // add class selected to the row
                        this.classList.toggle("selected");

                     };
                } 
                
                
            }



            function clickOnRow(id) {
                //open all parent of node
                draw_path_node(id);
                
                //deselected all
                $('#container').jstree(true).deselect_all();
                //$('#container').jstree(true).select_node("'"+id+"'");
                if(compare == 1)
                {
                    //edit
                    $.ajax({
                        type :'GET',
                        url:"{{route('dif_dia_node.view')}}",
                        data:{
                            id : id,
                            parents_code : 1
                        },
                        success:function(res){
                            result_view =  JSON.parse(res);
                            var node =result_view.node;
                            document.getElementById('term_id').value = node.id;
                            document.getElementById('code').value = node.code;
                            document.getElementById("parent__code").style.display = "none";
                            document.getElementById("div_parent").style.display = "block";
                            $('#parent_code').empty();
                            $('#parent_code').append('<option value="'+node.parent_code+'">'+node.parent_code+'</option>');
                            $.each(result_view.parent_code,function(key,value){
                                $('#parent_code').append('<option value="'+key+'">'+value+'</option>');
                            });  
                            //initialize summernote
                            CKEDITOR.instances['en_term'].setData(node.en_term);
                            CKEDITOR.instances['ar_term'].setData(node.ar_term);
                            
                            CKEDITOR.instances['en_note'].setData(node.en_note);
                            CKEDITOR.instances['ar_note'].setData(node.ar_note);
                            
                            var searchResult = $("#container").jstree('search', id);
                            $(searchResult).find('.jstree-search').focus();


                            setTimeout(function() { $("#container").jstree(true).get_node(id, true).children('.jstree-anchor').focus(); }, 2500);
                           
                            //$("#container").jstree(true)._open_to(nodeId).focus();
                        }
                    });
                }
                else
                {
                    $.ajax({
                        type :'GET',
                        url:"{{route('dif_dia_node.view')}}",
                        data:{
                            id : id,
                            parents_code : 0
                        },
                        success:function(res){
                            //add
                            result_view =  JSON.parse(res);
                            var node =result_view.node;
                            document.getElementById("div_parent").style.display = "none";
                            document.getElementById("parent__code").style.display = "block";
                            document.getElementById("parent__code").value = node.code;
                            document.getElementById("code").value = ""; 
                            //initialize summernote
                            CKEDITOR.instances['en_term'].setData("");
                            CKEDITOR.instances['ar_term'].setData("");
                            CKEDITOR.instances['en_note'].setData("");
                            CKEDITOR.instances['ar_note'].setData("");
                        }
                    });
                }
            }

          




        function fill_field(compare , id){
        if(id != null){
            if(compare == 1)
            {
                $.ajax({
                    type :"GET",
                    url:"{{route('dif_dia_node.view')}}",
                    data:{
                        id : id,
                        parents_code : 1
                    },
                    success:function(res){
                                result_view =  JSON.parse(res);
                                var node =result_view.node;
                                document.getElementById('term_id').value = node.id;
                                document.getElementById('code').value = node.code;
                                document.getElementById("parent__code").style.display = "none";
                                document.getElementById("div_parent").style.display = "block";
                                $('#parent_code').empty();
                                $('#parent_code').append('<option value="'+node.parent_code+'">'+node.parent_code+'</option>');
                                $('#parent_code').append(all_parents_code);
                                //initialize summernote
                                CKEDITOR.instances['en_term'].setData(node.en_term);
                                CKEDITOR.instances['ar_term'].setData(node.ar_term);
                                CKEDITOR.instances['en_note'].setData(node.en_note);
                                CKEDITOR.instances['ar_note'].setData(node.ar_note);                    
                    }
                });
            }
            else
            {
                $.ajax({
                    type :'GET',
                    url:"{{route('dif_dia_node.view')}}",
                    data:{
                        id : id,
                        parents_code : 0
                    },
                    success:function(res){
                        result_view =  JSON.parse(res);
                        var node =result_view.node;
                        document.getElementById("div_parent").style.display = "none";
                        document.getElementById("parent__code").style.display = "block";
                        document.getElementById("parent__code").value = node.code;
                        document.getElementById('code').value = "";
                        document.getElementById("parent_code").readOnly = true;
                        //initialize summernote
                            CKEDITOR.instances['en_term'].setData("");
                            CKEDITOR.instances['ar_term'].setData("");
                            CKEDITOR.instances['en_note'].setData("");
                            CKEDITOR.instances['ar_note'].setData("");
                    }
                });
            }
        }}


        function search(){
            $.ajax({
                type :'GET',
                url:"{{route('dif_dia_node.search')}}",
                data:{
                    condition : $("#plugins4_q").val()
                },
                success:function(res){
                    var counter = 1;
                    $("#example").empty();
                    if(res){
                        result_search =  JSON.parse(res);
                        $("#example").append("<thead><tr style='font-weight:bold'><td>No </td><td>id </td><td>ParentCode/Code</td><td>English Term("+result_search[0].count+")</td><td>Arabic Term</td></tr></thead><tbody>")
                        
                        result_search[0].tree.forEach(function(item){
                            $("#example").append("<tr onclick='clickOnRow("+item.id+");selectedRow();' style='background-color:"+item.background_color+";color:"+item.text_color+";text-decoration:"+item.under_line+";font-weight: "+item.bold+";font-style: "+item.italic+"'><td>"+counter+"/"+result_search[0].count+"</td><td>"+item.id+"</td><td>"+item.parent_code+" / "+item.code+"</td><td dir='ltr' >"+item.en_term+"</td><td dir='rtl' style='text-align:right'>"+item.ar_term+"</td></tr>");
                            counter++;
                        });
                        $("#example").append("</tbody>");
                    } 
                }
            });
        }

        function save_auto(my_id,compare,code,parent_code,en_term,ar_term,en_note,ar_note,text_bold,text_italic,text_color,background_color,under_line,ar_size,en_size,copy_style) {
            if(compare == 2){
                parent_id = my_id;
                my_id = null;
            }
            //ar_term=super_script(ar_term);
            //en_term=super_script(en_term);
            /*ar_term = ar_term.replace('&ndash;', '"');
            ar_term = ar_term.replace('&lsquo;', '"');
            ar_term = ar_term.replace('&rsquo;', '"');
            */
            en_term = en_term.replace('<br />', '');
            ar_term = ar_term.replace('<br />', '');
            console.log(ar_term);
            console.log(en_term);
            $.ajax({
                type :"POST",
                url:"{{route('dif_dia_node.save')}}",
                data:{
                    id : my_id,
                    parent_id : parent_id,
                    parent_code : parent_code, 
                    code : code,
                    en_term : en_term,
                    ar_term : ar_term,
                    en_note : en_note,
                    ar_note : ar_note,
                    bold : text_bold,
                    italic : text_italic,
                    color_text : text_color,
                    color_background : background_color,
                    under_line : under_line,
                    ar_size :ar_size,
                    en_size :en_size,
                    copy_style : copy_style,
                    _token: CSRF_TOKEN,
                },
                success:function(res){
                    //edit
                    console.log(res);
                    var diminsion = JSON.parse(res);
                    var code_width = diminsion[0].code_width;
                    var en_width = diminsion[0].en_width;
                    var ar_width = diminsion[0].ar_width;
                    var type = diminsion[0].type;
                    var new_id = diminsion[0].id;
                    var parent_id = diminsion[0].parent_id;
                    var new_code = code.replace(/!!/g, "");
                    var new_en_term = diminsion[0].en_term;
                    var new_ar_term = diminsion[0].ar_term;
                    var new_en_note = diminsion[0].en_note;
                    var new_ar_note = diminsion[0].ar_note;

                    if(compare == 1)
                    {
                        text_bold = diminsion[0].bold;
                        text_italic = diminsion[0].italic;
                        background_color = diminsion[0].background_color;
                        text_color = diminsion[0].text_color;
                        under_line = diminsion[0].under_line;
                        en_size = diminsion[0].en_size;
                        ar_size = diminsion[0].ar_size;
                        var text_ ="<div ><label  style='font-weight: "+text_bold+";font-style: "+text_italic+"; background-color:"+background_color+";color:"+text_color+";word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";width:"+en_width+"px;font-size:"+en_size+"px;float:left;text-align:left;padding: 0.0ex ;margint-buttom:0.01ex;'>"+new_en_term+"</label><label style='float:left; width:35px; '></label><label dir='rtl' style='font-weight: "+text_bold+";font-style: "+text_italic+"; background-color:"+background_color+";color:"+text_color+";word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";float:right; width:"+ar_width+"px;direction:rtl;text-align:right;font-size:"+ar_size+"px;padding: 0.0ex ;margint-buttom:0.01ex;' >"+new_ar_term+"</label></div>";
                         
                        if(parent_id == null)
                        {
                            console.log("parent_id");
                            var node_tree = $('#container').jstree(true).get_node(new_id);
                            node_tree.text = text_ ;
                            $('#container').jstree(true).redraw_node(node_tree, false, false, false);
                        }
                        else
                        {
                            var node = $('#container').jstree(true).get_node(my_id);
                            cut_node_id = node.id;
                            $('#container').jstree(true).cut(node);
                            var parent = $('#container').jstree(true).get_node(parent_id);
                            parent_id =  parent.id;
                            $('#container').jstree(true).paste(parent,"first");
                        }
                    }
                    //create
                    else
                    {
                        var text_ ="<div ><label  style='font-weight: "+text_bold+";font-style: "+text_italic+"; background-color:"+background_color+";color:"+text_color+";word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";width:"+en_width+"px;font-size:"+en_size+"px;float:left;text-align:left;padding: 0.0ex ;margint-buttom:0.01ex;'>"+new_en_term+"</label><label style='float:left; width:35px; '></label><label dir='rtl' style='font-weight: "+text_bold+";font-style: "+text_italic+"; background-color:"+background_color+";color:"+text_color+";word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";float:right; width:"+ar_width+"px;direction:rtl;text-align:right;font-size:"+ar_size+"px;padding: 0.0ex ;margint-buttom:0.01ex;' >"+new_ar_term+"</label></div>";
                          $('#container').jstree().create_node(parent_id ,  { "id" : new_id, "text" : text_ }, "first", false);              
                    }
                }              
            });
            // in case the node after update do not contain text this i want search it so i will search agian
            if(document.getElementById("plugins4_q").value.length != 0)
            {
                search();
            }
        }

        function next_open_node(){
            var tree = $ ('#container').jstree (true)
            curr = tree.get_selected (false);
            tree.deselect_all ();
            //tree.open_all ();
            var n = tree.get_next_dom (curr);
            tree.select_node(n);
            //foucs
            $("#container").jstree(true).get_node(n[0].id, true).children('.jstree-anchor').focus();
        }

        function search_deep_first_next_node(){
            var tree = $ ('#container').jstree (true)
            curr = tree.get_selected (false);
            tree.deselect_all ();
            var n = tree.get_next_dom (curr);
            tree.open_all(n);
            tree.select_node(n);
            //foucs
            $("#container").jstree(true).get_node(n[0].id, true).children('.jstree-anchor').focus();
        }

        function previous_open_node(){
            var tree = $ ('#container'). jstree (true)
            curr = tree.get_selected (false);
            tree.deselect_all ();
            var n = tree.get_prev_dom (curr);
            tree.select_node (n);
            //foucs
            $("#container").jstree(true).get_node(n[0].id, true).children('.jstree-anchor').focus();     
        }

        function search_deep_first_previous_node(){
            var tree = $ ('#container'). jstree (true)
            curr = tree.get_selected (false);
            tree.deselect_all ();
            var n = tree.get_prev_dom (curr);
            tree.open_all(n);
            tree.select_node (n);
            //foucs
            $("#container").jstree(true).get_node(n[0].id, true).children('.jstree-anchor').focus();     
        }

        function replace_word_in_ar_en_term(from , to){
            $.ajax({
                type :'GET',
                url:"{{route('dif_dia_term.replace')}}",
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
            autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size,border_style);      
        });
        $('#underLine_button').click(function() {
            $(this).toggleClass('activated');
            if($(this).hasClass('activated') == true)
                under_line = "underline";
            else
                under_line = "none";
            autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size,border_style);
        });


        $('#borderStyle_button').click(function() {
            $(this).toggleClass('activated');
            if($(this).hasClass('activated') == true)
                border_style = "solid";
            else
                border_style = "none";
            autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size,border_style);
        });
        $('#up_size').click(function() {   
            ar_size = 2 + parseInt(ar_size);
            en_size = 2 + parseInt(en_size);
            autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size,border_style);
        });

        $('#down_size').click(function() {
            ar_size = ar_size - 2;
            en_size = en_size - 2;
            autoChangeFontStyle(bold,italic,color_text,color_background,under_line,ar_size,en_size,border_style);
        });

        $('#copy_style_button').click(function() {
            $(this).toggleClass('activated');
            if($(this).hasClass('activated') == true)
            {
                copy_style = true;
                document.getElementById("bold_button").style.display = "block";
                document.getElementById("italic_button").style.display = "block";
                document.getElementById("underLine_button").style.display = "block";
                document.getElementById("borderStyle_button").style.display = "block";
                document.getElementById("colorPicker_text").style.display = "block";
                document.getElementById("colorPicker_backgraound").style.display = "block";
                document.getElementById("up_size").style.display = "block";
                document.getElementById("down_size").style.display = "block";
            }
            else
            {
                copy_style = false;
                document.getElementById("bold_button").style.display = "none";
                document.getElementById("italic_button").style.display = "none";
                document.getElementById("underLine_button").style.display = "none";
                document.getElementById("borderStyle_button").style.display = "none";
                document.getElementById("colorPicker_text").style.display = "none";
                document.getElementById("colorPicker_backgraound").style.display = "none";
                document.getElementById("up_size").style.display = "none";
                document.getElementById("down_size").style.display = "none";
            }
        });

        function saveAotuFunction() {
            var element = document.getElementById("save_auto__");
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

        function borderStyleFunction(){
            var element = document.getElementById("borderStyle_button");
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
                url:"{{route('dif_dia_node.view')}}",
                data:{
                    id : id,
                    parents_code : 0
                },
                success:function(res){
                    result_view =  JSON.parse(res);
                    console.log(result_view);
                    var node =result_view.node;
                    bold = node.bold;
                    italic = node.italic;
                    color_background = node.background_color;
                    colorPicker_backgraound.value = node.background_color;
                    colorPicker_text.value = node.text_color; 
                    color_text = node.text_color;
                    under_line = node.under_line;
                    en_size = node.en_size;
                    ar_size = node.ar_size;
                    bold = node.bold;
                    italic = node.italic;
                    color_background = node.background_color;
                    color_text = node.text_color;
                    under_line = node.under_line;
                    en_size = node.en_size;
                    ar_size = node.ar_size;
                }
            }); 
        }

        function autoChangeFontStyle(text_bold,text_italic,text_color,background_color,under_line,ar_size,en_size,border_style){

            $.ajax({
                type :'GET',
                url:"{{route('dif_dia_node.view')}}",
                data:{
                    id : id ,
                    parents_code : 0
                },
                success:function(res){
                    result_view =  JSON.parse(res);
                    var node =result_view.node;
                    var code_width = result_view.code_width;
                    var ar_width = result_view.ar_width;
                    var en_width = result_view.en_width;
                    var type = result_view.type;
                    var new_code = node.code.replace(/!!/g, "");
                    var text_ ="<div><label class="+border_style+"> <label   style=' font-weight: "+text_bold+";font-style: "+text_italic+"; background-color:"+background_color+";color:"+text_color+";word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";width:"+en_width+"px;float:left;text-align:left;font-size:"+en_size+"px;padding: 0.0ex ;margint:0.0ex;'>"+node.en_term+"</label><label style='float:left; width:35px; '></label><label dir='rtl' style='font-weight: "+text_bold+";font-style: "+text_italic+"; background-color:"+background_color+";color:"+text_color+";float:right;text-align:right;word-wrap: break-word;text-decoration:"+under_line+";font-weight: "+text_bold+";width:"+ar_width+"px;font-size:"+ar_size+"px;padding: 0.0ex ;margint:0.0ex;' >"+node.ar_term+"</label></label></div>";
                    var node_tree = $('#container').jstree(true).get_node(node.id);    
                    node_tree.text = text_ ;
                    $('#container').jstree(true).redraw_node(node_tree, false, false, false);
                }
            });
        }

        function open_all_child(){
            if(selected_node != null)
                $("#container").jstree(true).open_all(selected_node);
        }

        function draw_path_node(id){
            $.ajax({
                    type :'GET',
                    url:"{{route('get_all_parents_for_node')}}",
                    data:{
                        id : id,
                    },
                    success:function(array_parents_id){
                            console.log(array_parents_id);

                            $('#container').jstree(true).load_node(array_parents_id, function () {
                                this.select_node(id);
                            });
                    }
                });
        }

        function focus_node(id){
            console.log("focus");
            $("#container").jstree(true).get_node(id, true).children('.jstree-anchor').focus();
        }

        $.ajaxSetup(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    /***********************************************************
            Saving Function

    ***********************************************************/
    function saveFunction(){
                                
                            var my_id = document.getElementById('term_id').value;
                            var code = document.getElementById('code').value;
                            var parent_code = document.getElementById('parent_code').value;
                            var en_term = CKEDITOR.instances['en_term'].getData();
                            var ar_term = CKEDITOR.instances['ar_term'].getData();
                            var en_note;
                            var myInput = CKEDITOR.instances['en_note'].getData();
                            if(myInput)
                                en_note = CKEDITOR.instances['en_note'].getData();
                            else
                                en_note=" ";
                            var ar_note;
                            var myInput = CKEDITOR.instances['ar_note'].getData();
                            if(myInput)
                                ar_note = CKEDITOR.instances['ar_note'].getData();
                            else
                                ar_note = " ";
                            save_auto(my_id,compare,code,parent_code,en_term,ar_term,en_note,ar_note,bold,italic,color_text,color_background,under_line,ar_size,en_size,copy_style);
                            return false;
                        
    }
    /***********************************************************/
    
    
    
    
    
    
    
 CKEDITOR.config.uiColor = '#cae8ca';   
          CKEDITOR.replace('ar_term', {
                  height: 165,
                  contentsLangDirection : 'rtl',
                  on: {
                            save: function(evt)
                            {
                                saveFunction();
                            }
           }
          });
        CKEDITOR.replace('en_term', {
              height: 165,
              on: {
                        save: function(evt)
                        {
                            saveFunction();
                        }
       }
      });
        CKEDITOR.replace('ar_note', {
              height: 150,
              contentsLangDirection : 'rtl',
              on: {
                        save: function(evt)
                        {
                            saveFunction();
                        }
       }
      });
        CKEDITOR.replace('en_note', {
              height: 150,
              on: {
                        save: function(evt)
                        {
                            saveFunction();
                        }
       }
      }); 

    
</script>
</html>