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
var lazy_id = '';
    $(document).ready(function(){ 
    //fill data to tree  with AJAX call
    $(function () {
        $.support.cors = true;
        $('#container').jstree({
            "plugins": ["themes", "json_data", "dnd", "wholerow"],
                'core': {
                'data': {
                    'url': function (node) {
                        if(node.id === '#') {
                            return "{{route('disease.ar_tree',['id' => 0])}}";
                           // return "http://localhost:8000/tree_ar/0";
                        }
                        else {
                            console.log(node.id);
                            //return "{{route('disease.ar_tree',['id' => "+node.id+"])}}";
                            return "http://localhost:8000/tree_ar/" + node.id;
                        }
                    },
                    'dataType': "json"
                }
            }
        });
    });

});
</script>

</html>
