<!DOCTYPE html>
<html lang="en">
<head>
<style>
.jstree-anchor { height:auto !important; white-space:normal !important; }
div.sticky {
  position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 0;
  padding: 5px;
  background-color: #cae8ca;
  border: 2px solid #4CAF50;
  z-index: 2; 
}

.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 30px; padding: 0.0px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
</style>


        <!-- Switchery css -->
        <link href="{{ asset('/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet" />
        <!-- Bootstrap CSS -->
        <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Font Awesome CSS -->
        <link href="{{ asset('/assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Custom CSS -->
        <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

        

    <script src="{{ asset('/assets/tree/jquery.min.js') }}" ></script>
    <link rel="stylesheet" href="{{ asset('/assets/tree/style.min.css') }}" />
    <script src="{{ asset('/assets/tree/jstree.min.js') }}"></script>

    <!--NOTE-->
    <link href="{{ asset('/assets/tree/bootstrap.css') }}" rel="stylesheet">
  <script src="{{ asset('/assets/tree/bootstrap.js') }}"></script>   
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
  <!-- choice -->
  <script src="{{ asset('/assets/tree/bootstrap-toggle.min.js') }}"></script>
  <link href="{{ asset('/assets/tree/bootstrap-toggle.min.css') }}" rel="stylesheet">
 


</head>

<body>
    <div class="row sticky"  >
            <!--        2           -->
        <div class="col-md-11 mb-0 col-sm-0" style="overflow:auto;height:175px;" >
                <div class="row " >
                    <div class="col-md-1 mb-0 col-sm-0">
                        <label >Code<span class="text-danger">*</span></label>
                        <input type="text" name="code" data-parsley-trigger="change" class="form-control" id="code"  >
                    </div>
                    <div class="col-md-1 mb-0 col-sm-0">
                        <label >Parent ID</label>
                        <input type="text" name="parent_id" data-parsley-trigger="change"  class="form-control" id="parent_id" readOnly>
                    </div> 
                    <div class="col-md-5 mb-0 col-sm-0">
                        <label >Classification English Term<span class="text-danger">*</span></label>
                        <textarea rows="2" cols="78" type="text" name="en_term" data-parsley-trigger="change" class="form-control" id="en_term" style="font-size:18px;height:40px;font-weight:bold;"   ></textarea>
                    </div>
                    <div class="col-md-5 mb-0 col-sm-0">
                        <label>Classification Arabic Term</label>
                        <textarea rows="2" cols="78" type="text" name="ar_term" data-parsley-trigger="change"   class="form-control" id="ar_term"
                        dir="rtl" style="font-size:18px;height:40px;font-weight:bold;"></textarea>
                    </div>
                </div>

                <div class="row">
                {{ csrf_field() }}
                    <div class="col-md-12 mb-0 col-sm-0">
                        <textarea id="note" name="note" class="summernote">Note : </textarea>
                    </div>
                </div>
        </div>
<!--        3           -->
            <div class="colum col-md-1 mb-0 col-sm-0">  
                     
                    <div class="checkbox" style="margin: 0.0px;padding: 0.0px;">
                        <input type="checkbox"  data-toggle="toggle" data-width="85" data-height="1" name="save_auto__" id="save_auto__"  data-on="AouSave" data-off="ManSave" data-onstyle="success" data-offstyle="danger" data-style="ios">
                    </div>





                    <div>
                        <input  type="button" value="" id="save" class="btn btn-outline-success btn-sm" style="display: none;"/>
                    </div>
                    <div>
                        <button type="Addbutton" id="AddButton" class="btn btn-outline-primary btn-sm" href="{{route('node.view')}}" style="margin: 0.0px;padding: 0.0px;"><i class="fa fa-plus bigfonts"></i> Add </button>
                    </div>
                    <div>
                        <button id="EditButton" type="button" class="btn btn-outline-success btn-sm" style="margin: 0.0px;padding: 0.0px;"><i class="fa fa-pencil"></i> Edit </button>
                    </div>
                    <div>
                        <button id="DeleteButton" type="button" class="btn btn-outline-danger btn-sm" style="margin: 0.0px;padding: 0.0px;"><i class="fa fa-trash-o"></i> Delete </button>
                    </div>
            </div>
    </div> 
    <!-------------------------------------->
    <div class="row" style = "margin-left:25px;">
        <!--        1           -->
        <div class="col-md-12 mb-0 col-sm-0">
                    <div class="row">

         
                    <form id="s">
                        <div class="row">
                            <input  type="search" id="plugins4_q" value="" class="input" style="margin-left:35px;display:block;  border-radius:1px; border:1px solid silver;">
                            <button type="submit" class="btn btn-outline-success btn-sm" ><i class="fa fa-search bigfonts" aria-hidden="true"></i></button>
                        </div>
                    </form>

                    <a style="margin-left: 1.0em;" class="btn btn-outline-success btn-sm" href="{{route('classification.draw_tree3_ar') }}" padding="4px" ><i class="fa fa-language bigfonts" aria-hidden="true"></i></a>
                    <a class="btn btn-outline-success btn-sm"   onclick="$('#container').jstree('close_all');">ColAll</a>
                    <a class="btn btn-outline-success btn-sm"  onclick="$('#container').jstree('open_all');"> EXpAll</a>           
                </div>
                   <hr style="float:left;border-style: inset; border-width: 0.8px;margin-top: 0.0em;margin-bottom: 0.0em; width:1100px;padding-bottom: 0.0px">
                    <div id="container"  style="display:block;overflow:auto;height:400px;width:1100px;"  >
                    </div>
        </div>
    </div>

    <div class="row">
            <div class="row">
                <hr style="float:left;border-style: inset; border-width: 2px;margin-top: 0.0em;margin-bottom:0.0em;width:1100px;padding-bottom: 0.0px;margin-left: 4.7em;">
            </div>

            <div  class="row" style="float:left;display:block;overflow:auto;height:203px;width:1100px;text-align: right;margin-right:35px margin-top: 0.0em;margin-left:3.6em; ">
                    <div class="table-responsive" >
                        <table id="example" class="table table-bordered table-hover display" style="width:100%">
                        </table>
                    </div>
            </div>
        </div>


</body>

<!-----------------------------------------> 
<script type="text/javascript">
var tree;
var id;
var old_id;
var parent_id ;
var compare = 1;
var result_search;
var first = true;
var save_auto_choice = false;
    $(document).ready(function(){ 
    //fill data to tree  with AJAX call
    tree = $('#container').jstree({
        'core' : {
            check_callback: true,
            'data' : {
                "url" : "{{route('classification.build_tree')}}",
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
                'show_only_matches' : true,
            },
       /*  'checkbox': {
            three_state: false,
            whole_node : false,
            cascade: 'undetermined'
        },
       'sort' : function(a, b) {
            a1 = this.get_node(a);
            b1 = this.get_node(b);
            if (a1.icon == b1.icon){
                return (a1.text > b1.text) ? 1 : -1;
            } else {
                return (a1.icon > b1.icon) ? 1 : -1;
            }
        },
        "state" : { "key" : "demo2" }, 
       "types": {
            "types": {
                "AM": {
                    "hover_node": false,
                    "select_node": false
                },
                "AF": {
                    "hover_node": false,
                    "select_node": false
                },
                "Role": {
// i dont know if possible to be done here? add class?
             //   this.css("color", "red")
                    //{ font-weight:bold}
                }
            }
        },*/
         "ui": {
            "select_limit": 1,
            "select_multiple_modifier": "none",

        },

        'plugins': [ "sort","state","themes", "json_data", "ui", "Select", "types", "crrm","html_data", "search", "massload","wholerow"]
    });


////////////////////////////////////////////////////////////////////////////////////////    
    //auto search
    var to = false;
    $('#plugins4_q').keyup(function () {
    if(to) { clearTimeout(to); }
    to = setTimeout(function () {
            var v = $('#plugins4_q').val();
            $('#container').jstree(true).search(v);
            }, 250);
    });
    //manul search
    $("#s").submit(function(e) {
        e.preventDefault();
/*      //show the result of search and parents     
        $("#container").jstree(true).search($("#plugins4_q").val());
*/


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
                            console.log(item.id);
                            $("#example").append("<tr onclick='clickOnRow("+item.id+")'><td>"+item.id+"</td><td>"+item.code+"</td><td>"+ item.en_term+"</td><td>"+item.ar_term+"</td></tr>");
                        });
                        $("#example").append("</tbody>");
                    } 
                }
            });
    });


//

//after choise Event
    $('#container').on("changed.jstree", function (e, data) {


        
        if(first == false && save_auto_choice == true){
            var code = document.getElementById('code').value;
            var en_term = document.getElementById('en_term').value;
            var ar_term = document.getElementById('ar_term').value;
            var note;
            var myInput = document.getElementById('note').value;
            if(myInput)
                note = document.getElementById('note').value ;
            else
                note =  "Note :" ;
            save_auto(old_id,compare,code,en_term,ar_term,note);
        }


        id = data.selected[0];
        old_id=id;
        //parent_id = data.node.parent;
        /*for open all child node when click on node*/
        $("#container").jstree(true).open_all([data.selected[0]]);
        /**/
        if(compare == 1)
        {
            document.getElementById("save").value= "save";
            document.getElementById("save").style.display = "block";
            $.ajax({
                type :'GET',
                url:"{{route('node.view')}}",
                data:{
                    id : id
                },
                success:function(res){
                    document.getElementById('code').value = res.code;
                //    document.getElementById("code").readOnly = false; 
                    document.getElementById('en_term').value = res.en_term;
                    document.getElementById('ar_term').value = res.ar_term;
                    //initialize summernote
                    $('.summernote').summernote();
                    $('.summernote').summernote('code', res.note);
                }
            });
        }
        else
        {
            document.getElementById("save").value= "create";
            document.getElementById("save").style.display = "block";
            document.getElementById("parent_id").value = id;
            document.getElementById("code").value = ""; 
            document.getElementById("en_term").value = "";
            document.getElementById("ar_term").value = "";
            //initialize summernote
            $('.summernote').summernote();
            $('.summernote').summernote('code', "");
        } 
//save auto for first time
        if(first == true && save_auto_choice == true){
            var code = document.getElementById('code').value;
            var en_term = document.getElementById('en_term').value;
            var ar_term = document.getElementById('ar_term').value;
            var note;
            var myInput = document.getElementById('note').value;
            if(myInput)
                note = document.getElementById('note').value ;
            else
                note =  "Note :" ;
            save_auto(old_id,compare,code,en_term,ar_term,note);
            
        }
        first = false;


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
                    if(res == "yes")
                        $('#container').jstree(true).refresh();
                    else
                        window.alert("you can't remove it ,becuse it has child!!");
                }
            });
        }
    });
    //Edit
    $('#EditButton').click(function(){
        compare = 1;
        document.getElementById("save").value= "save";
        document.getElementById("save").style.display = "block";
            $.ajax({
                type :'GET',
                url:"{{route('node.view')}}",
                data:{
                    id : id
                },
                success:function(res){
                    document.getElementById('code').value = res.code;
                //    document.getElementById("code").readOnly = false; 
                    document.getElementById('en_term').value = res.en_term;
                    document.getElementById('ar_term').value = res.ar_term;
                    //initialize summernote
                    $('.summernote').summernote();
                    $('.summernote').summernote('code', res.note); 
                }
            });
    });
    //ADD
    $('#AddButton').click(function(){
        compare = 2;
        
        document.getElementById("save").value= "create";
        document.getElementById("save").style.display = "block";
        //$('#parent_id').val = id;
        document.getElementById("parent_id").value = id;
        document.getElementById("code").value = ""; 
        document.getElementById("en_term").value = "";
        document.getElementById("ar_term").value = "";
        //initialize summernote
        $('.summernote').summernote();
                    $('.summernote').summernote('code', "");
    });
    //save  
    $('#save').click(function(){
        if(compare == 2){
            parent_id = id;
            id = null;
        }
        var code = document.getElementById('code').value;
        var en_term = document.getElementById('en_term').value;
        var ar_term = document.getElementById('ar_term').value;
        var note;
        var myInput = document.getElementById('note').value;
        
        if(myInput)
            note = document.getElementById('note').value ;
        else
            note =  "Note :" ;
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
                },
                success:function(res){ 
                    if(compare == 1){
                        var node = $('#container').jstree(true).get_node(id);
                        var diminsion =  JSON.parse(res);
                        node.text = "<label><label style=' float:left;width:"+diminsion[0].code_width+"px;font-size:16px;padding: 0.0ex ;color:Tomato;'>"+code+"</label><label  style='width:500px;font-size:16px;padding: 0.0ex ;margint-buttom:0.01ex;color:DodgerBlue;'>"+en_term+"</label><label style='float:right;width:"+diminsion[0].en_width+"px;direction:rtl;text-align:right;font-size:18px;padding: 0.0ex ;margint-buttom:0.01ex;color:MediumSeaGreen;'>"+ar_term+"</label>";
                        $('#container').jstree(true).redraw_node(node, false, false, false);
                    }
                    else
                        $('#container').jstree(true).refresh();

                }
            });
    });

//note
         $('#note').summernote();

//checkbox


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
});
//////////////////////////End  $(document).ready(function()


    function clickOnRow(x) {
        id = x;

        if(compare == 1)
        {
            document.getElementById("save").value= "save";
            document.getElementById("save").style.display = "block";
            $.ajax({
                type :'GET',
                url:"{{route('node.view')}}",
                data:{
                    id : id
                },
                success:function(res){
                    document.getElementById('code').value = res.code;
                    document.getElementById('en_term').value = res.en_term;
                    document.getElementById('ar_term').value = res.ar_term;
                    //initialize summernote
                    $('.summernote').summernote();
                    $('.summernote').summernote('code', res.note);
                }
            });
        }
        else
        {
            document.getElementById("save").value= "create";
            document.getElementById("save").style.display = "block";
            document.getElementById("parent_id").value = id;
            document.getElementById("code").value = ""; 
            document.getElementById("en_term").value = "";
            document.getElementById("ar_term").value = "";
            //initialize summernote
            $('.summernote').summernote();
            $('.summernote').summernote('code', "");
        }  
    }

     function save_auto(id,compare,code,en_term,ar_term,note) {
        //console.log(id+"--"+compare+"--"+code+"--"+en_term+"--"+ar_term+"--"+note);
        if(compare == 2){
            parent_id = id;
            id = null;
        }
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
                },
                success:function(res){ 
                    if(compare == 1){
                        var node = $('#container').jstree(true).get_node(id);
                        var diminsion =  JSON.parse(res);
                        node.text = "<label><label style=' float:left;width:"+diminsion[0].code_width+"px;font-size:16px;padding: 0.0ex ;color:Tomato;'>"+code+"</label><label  style='width:500px;font-size:16px;padding: 0.0ex ;margint-buttom:0.01ex;color:DodgerBlue;'>"+en_term+"</label><label style='float:right;width:"+diminsion[0].en_width+"px;direction:rtl;text-align:right;font-size:18px;padding: 0.0ex ;margint-buttom:0.01ex;color:MediumSeaGreen;'>"+ar_term+"</label>";
                        $('#container').jstree(true).redraw_node(node, false, false, false);
                    }
                    else
                        $('#container').jstree(true).refresh();
                }
            });
    }


</script>


</html>
