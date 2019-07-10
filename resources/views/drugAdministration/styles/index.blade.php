@extends('drugAdministration.styles.base')
@section('action-content')
 <meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" type="text/css" href="{{asset('/assets/font-awesome/fonts/New Fonts.css')}}">
<script src="{{asset('/js/alaa/jquery.js')}}"></script>
<style>
        .parsley-error {
            border-color: #ff5d48 !important;
        }
        .parsley-errors-list.filled {
            display: block;
        }
        .parsley-errors-list {
            display: none;
            margin: 0;
            padding: 0;
        }
        .parsley-errors-list > li {
            font-size: 12px;
            list-style: none;
            color: #ff5d48;
            margin-top: 5px;
        }
        .form-section {
            padding-left: 15px;
            border-left: 2px solid #FF851B;
            display: none;
        }
        .form-section.current {
            display: inherit;
        }
</style>

<div class="card mb-3"> 

  <div class="card-header">
    <i class="fa fa-tint bigfonts" aria-hidden="true"></i> All styles ({{$count}})  
    <span class="pull-right">
      <a  class="btn btn-outline-info btn-sm" href="{{ route('style.index') }}"><i class="fa fa-refresh bigfonts" aria-hidden="true"></i> </a>
    <!--  <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Export</a>
      <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import</a>-->
      <button class="btn btn-primary btn-sm"  id="create"><i class="fa fa-plus bigfonts" aria-hidden="true"></i> Add new style</button>
    </span>              
  </div>   
<!-- ADD     EDIT ------->

      <div id="container" class="row " style="padding-left: 20px;padding-bottom: 0.0px;" hidden="true">
        <input type="integer" name="style_id" id="style_id" hidden="true">
          <div class="form-group col-md-2 control-label">
              <label for="style_name">Style Name<span class="text-danger">*</span></label>
              <input type="text" name="style_name" data-parsley-trigger="change" required placeholder="Enter Style Name" class="form-control" id="style_name">
          </div>
          <div class="form-group col-md-1 control-label">
              <label for="ar_name">Font Size</label>
              <select class="form-control" name="style_font_size" id="style_font_size">
                  <option selected="selected"></option>
                  
                  
                  <option style="font-size: 10px;" value="10">10</option>
                  <option style="font-size: 12px;" value="12">12</option>
                  <option style="font-size: 14px;" value="14">14</option>
                  <option style="font-size: 16px;" value="16">16</option>
                  <option style="font-size: 18px;" value="18">18</option>
                  <option style="font-size: 20px;" value="20">20</option>
                  <option style="font-size: 24px;" value="24">24</option>
                  <option style="font-size: 30px;" value="30">30</option>
                  <option style="font-size: 36px;" value="36">36</option>
                  
              </select>
          </div>
          <div class="form-group col-md-2 control-label">
              <label  for="font_family">Font Family</label>
              <select class="form-control" name="style_font_family" id="style_font_family">
                  <option selected="selected"></option>

                  <option value="Air" style="font-family: Air;font-size:18px">Air</option>
                  <option value="AlHurra" style="font-family: AlHurra;font-size:18px">Al Hurra</option>

                  <option value="ArefRuqaa-Regular" style="font-family: ArefRuqaa-Regular;font-size:18px">ArefRuqaa</option>
                  <option value="arial" style="font-family: arial;font-size:18px">Arial</option>
                  <option value="Cairo-Regular" style="font-family: Cairo-Regular;font-size:18px">Cairo</option>
                  <option value="Changa-Regular" style="font-family: Changa-Regular;font-size:18px">Changa</option>
                  <option value="CrimsonText-Regular" style="font-family: CrimsonText-Regular;font-size:18px">CrimsonText</option>
                  <option value="EBGaramond-Regular" style="font-family: EBGaramond-Regular;font-size:18px">EBGaramond</option>
                  <option value="Tajawal-Regular" style="font-family: Tajawal-Regular;font-size:18px">Tajawal</option>
                  <option value="timesnewroman" style="font-family: timesnewroman;font-size:18px">Times New Roman</option>
                  
              </select>
          </div>

          <div class="form-group col-md-1 control-label" style="text-align: center;" >
              <label  id="text_color_val">Text Color</label>
              <div>
                  <input type="color" name="style_text_color" id="style_text_color"   >
              </div>
          </div>
          <div class="form-group col-md-1 control-label" style="text-align: center;">
              <label id="background_color_value">Background Color</label>
              <div>    
                <input type="color" name="style_background_color"  id="style_background_color" value="#ffffff">
              </div>
          </div> 


          <div class="form-group col-sm-0 control-label" style="padding-top: 30px;padding-right: 20px">
              <label for="bold">Bold</label>
              <input type="checkbox"   name="style_bold" id ="style_bold" >
          </div>
          <div class="form-group col-sm-0 control-label" style="padding-top: 30px;padding-right: 20px">
              <label for="italic">Italic</label>
              <input type="checkbox"  name="style_italic" id="style_italic">                        
          </div>
          <div  class="form-group col-sm-0 control-label" style="padding-top: 30px;padding-right: 20px">
              <label for="under_line">Under line</label>
                  <input type="checkbox"  name="style_under_line" id="style_under_line" >
          </div>
          <div class="form-group col-sm-0 control-label" style="padding-top: 30px;padding-right: 20px">
              <label for="border">Border</label>
                  <input type="checkbox"  name="style_border" id="style_border" >
          </div>
          <button class="btn btn-primary btn-lg"  id="save" name="save" style="margin-top: 20px;margin-left: 40px;  height: 50px;text-align: center;"> Save</button>
          <button class="btn btn-danger btn-lg"  id="cancel" name="cancel" style="margin-top: 20px;margin-left: 40px;  height: 50px;text-align: center;"> Cancel</button>                     
      </div>

      <hr class="fixedpar" style="float:left;border-style: inset; border-width: 0.8px;margin-top: 0.0em;margin-bottom: 0.0em; width:100%;padding-bottom: 0.0px">
      
      <div class="card-body" style="padding-top:0.0px ">
        <div class="table-responsive">
          <table id="example" class="table table-bordered table-hover display" style="width:100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Font-Family</th>
                <th>Font-size</th>
                <td>Action</td>
              </tr>
            </thead>

            <tbody>
              @foreach ($styles as $style)
              <tr role="row" class="odd" onclick='selectStyleToEdit({{$style->id}});'>
                <td>{{ $style->style_name }}</td>
                <td>{{ $style->style_font_family }}</td>
                <td>{{ $style->style_font_size }}</td>
                <td>
                 <form  method="POST" action="{{ route('style.destroy', ['id' => $style->id]) }}" onsubmit = "return confirm('Are you sure?')">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>
                    
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          </table>
        </div>
      </div>
</div>




<!-- BEGIN Java Script for this page -->
<script src={{asset("js/alaa/jquery-3.3.1.js")}}></script>
<script src={{asset("js/alaa/jquery.dataTables.min.js")}}></script>
<link  href="{{ asset('/js/alaa/jquery.dataTables.min.css')}}" type="text/css" />

<script>
  // END CODE FOR BASIC DATA TABLE 
  $(document).ready(function() {

    $('#example thead th').each( function () {
      var title = $('#example thead th').eq( $(this).index() ).text();
      $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#example').DataTable();

    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
      $( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
        table
        .column( colIdx )
        .search( this.value )
        .draw();
      } );
    } );
  } );


//delete Style
  function delete_record(id)
  {
    if (confirm('Confirm delete')) {
    }
  }

  $('#create').click(function(){
    document.getElementById('container').hidden = false;
    initailize_feild_to_add();
  })
//cancel Edit Or Cancel Create
  $('#cancel').click(function(){
        document.getElementById('container').hidden = true;
        initailize_feild_to_add();
  })
//Select Style To Edit
  function selectStyleToEdit(id){
    document.getElementById('container').hidden = false;
    $.ajax({
        type :'GET',
        url:"{{route('style.get_details')}}",
        data:{
            id : id
        },
        success:function(res){
            style =  JSON.parse(res);
            document.getElementById('style_id').value = style.id;
            document.getElementById('style_name').value = style.style_name;

            document.getElementById('style_bold').checked = style.style_bold == "bold" ?  true : false;
            document.getElementById('style_border').checked = style.style_border == "solid" ?  true : false;
            document.getElementById('style_italic').checked = style.style_italic == "italic" ?  true : false;
            document.getElementById('style_under_line').checked = style.style_under_line == "underline" ?  true : false;

            document.getElementById('style_text_color').value = style.style_text_color;
            document.getElementById('style_background_color').value = style.style_background_color;
            document.getElementById('style_font_size').value = style.style_font_size;
            document.getElementById('style_font_family').value = style.style_font_family;
            
            console.log(style);
            
          }
    })
  }
//save style to update or create
  $('#save').click(function(){
    var id = document.getElementById('style_id').value;
    $.ajax({
        type :"GET",
        url:"{{route('style.save_style')}}",
        data:{
            id : document.getElementById('style_id').value,
            style_name : document.getElementById('style_name').value,
            style_font_size : document.getElementById('style_font_size').value,
            style_font_family : document.getElementById('style_font_family').value,
            style_bold : document.getElementById('style_bold').checked == true ? "bold" : " normal",
            style_border : document.getElementById('style_border').checked == true ? "solid":"none",
            style_italic : document.getElementById('style_italic').checked == true?"italic":" normal",
            style_under_line : document.getElementById('style_under_line').checked == true?"underline":"none",
            style_text_color : document.getElementById('style_text_color').value,
            style_background_color : document.getElementById('style_background_color').value,
        },
        success:function(res){
          console.log('res : ');
          console.log(res);
          document.getElementById('container').hidden = true;
          initailize_feild_to_add();
          //alert(res['success']);
          if(id == "")
            location.reload();
        }
      });
  });

  function initailize_feild_to_add()
  {
    document.getElementById('style_id').value = "";
    document.getElementById('style_name').value = "";
    $('#style_font_family option').prop('selected', function() {
        return this.defaultSelected;
    });
    $('#style_font_size option').prop('selected', function() {
        return this.defaultSelected;
    });

    document.getElementById('style_background_color').value = "#ffffff";
    document.getElementById('style_text_color').value = "#000000";

    document.getElementById('style_bold').checked = false;
    document.getElementById('style_border').checked = false;
    document.getElementById('style_italic').checked = false;
    document.getElementById('style_under_line').checked = false;
  }


  $.ajaxSetup(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>


@endsection
