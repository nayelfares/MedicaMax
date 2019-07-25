@extends('drugAdministration.dictionaries.base')
@section('action-content')
 <meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" type="text/css" href="{{asset('/assets/font-awesome/fonts/New Fonts.css')}}">
<script src="{{asset('/js/alaa/jquery.js')}}"></script>
 <!--NOTE--> 
   <script src="{{asset('/assets/js/ckeditor/ckeditor.js')}}"></script>

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
            margin-top: 0px;
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
    <i class="fa fa-tint bigfonts" aria-hidden="true"></i> All Words ({{$count}})  
    <span class="pull-right">
      <a  class="btn btn-outline-info btn-sm" href="{{ route('dictionary.index') }}"><i class="fa fa-refresh bigfonts" aria-hidden="true"></i> </a>
      <a class="btn btn-primary btn-sm" href="{{route('dictionary.export')}}"><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Export</a>
      <a class="btn btn-primary btn-sm" href="{{route('dictionary.import_interface')}}"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import</a>
      <button class="btn btn-primary btn-sm"  id="create"><i class="fa fa-plus bigfonts" aria-hidden="true"></i> Add new word</button>
    </span>              
  </div>   
<!-- ADD     EDIT ------->

      <div id="container" class="row " style="padding-left: 20px;padding-bottom: 0.0px;" hidden="true">
        <input type="integer" name="word_id" id="word_id" hidden="true">

          <div class="form-group col-md-11 control-label row">
            <div id="top"> </div>    
              <div class="col-md-6 mb-0 col-sm-0" style="margin: 0.0px;padding: 0.0px;">
                <textarea rows="2"  type="text" name="englishText" data-parsley-trigger="change" class="form-control" id="englishText" style="font-size:15px;height:100px;resize:none;margin: 0.0px;padding: 0.0px;"></textarea>   
              </div>
              <div class="col-md-6 mb-0 col-sm-0" style="margin: 0.0px;padding: 0.0px;">
                <textarea rows="2"  type="text" name="arabicText" data-parsley-trigger="change"class="form-control" id="arabicText" dir="rtl" style=" font-size:18px;height:100px;resize:none;margin: 0.0px;padding: 0.0px;"></textarea>
              </div>
            <div id="botton"></div>
          </div>
              <div class="form-group col-md-1 control-label" style="margin: 0.0px;padding:0.0px;width:100%">
            
                    <select class="form-control" name="dictionary_id" id="dictionary_id" style="height: 15%">
                        <option  value="" disabled="disabled">Dictionary</option>
                        <option  value="English" >English</option>
                        <option value="Medical" selected="selected">Medical</option>
                        <option value="Legal">Legal</option>
                    </select>

                  
                    <select class="form-control" name="status" id="status" style="height: 15%">
                        <option  value="" disabled="disabled">Status</option>
                        <option value="Draft">Draft</option>
                        <option value="Published" selected="selected">Published</option>
                    </select>

                  <div class="form-group col-md-0 control-label row" style="margin: 0.0px;padding:0.0px">
                    <button class="btn btn-primary btn-sm"  id="save" name="save" style="margin-top: 0px;margin-bottom: 0px; text-align: center;width:50%;height: 15%"> Save</button>
                    <button class="btn btn-danger btn-sm"  id="cancel" name="cancel" style="margin-top: 0px;margin-bottom: 0px; text-align: center;width:50%;height: 15%"> Cancel</button>
                  </div>
                    
                    <select class="form-control" name="search_type" id="search_type" style="height: 15%">
                        <option value="" disabled="disabled">Search Type</option>
                        <option value="All" selected="selected">All</option>
                        <option value="Beginning">Beginning</option>
                        <option value="Last">Last</option>
                    </select>

                    <input type="text" name="search_word" data-parsley-trigger="change" required placeholder="Search Word" class="form-control" id="search_word" style="height: 15%">

                    <button class="btn btn-primary btn-lg"  id="search" name="search" style="margin-top: 0px;margin-bottom: 0px; text-align: center;height: 18%;width: 100%"> Search</button>
              </div>               
      </div>

      <hr class="fixedpar" style="float:left;border-style: inset; border-width: 0.8px;margin-top: 0.0em;margin-bottom: 0.0em; width:100%;padding-bottom: 0.0px">
      
      <div class="card-body" style="padding-top:0.0px ">
        <div class="table-responsive">
          <table id="example" class="table table-bordered table-hover display" style="width:100%">
            <thead>
              <tr>
                <th>Arabic Text</th>
                <th>English Text</th>
                <td>Action</td>
              </tr>
            </thead>

            <tbody>
              @foreach ($dictionaries as $dic)
              <tr role="row" class="odd" onclick='selectDicToEdit({{$dic->id}});'>
                <td>{{ $dic->arabicText }}</td>
                <td>{{ $dic->englishText }}</td>
                <td>
                 <form  method="POST" action="{{ route('dictionary.destroy', ['id' => $dic->id]) }}" onsubmit = "return confirm('Are you sure?')">
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
<script src="{{asset('js/alaa/jquery-3.3.1.js')}}"></script>
<script src='{{asset("js/alaa/jquery.dataTables.min.js")}}'></script>
<link  href="{{ asset('/js/alaa/jquery.dataTables.min.css')}}" type="text/css" />

<script>
  // END CODE FOR BASIC DATA TABLE
  var route_insert_tag_js = "{{route('tag.get_tags')}}";//use in js file
  var mm=[];
  var my_obj = {}; 
  $(document).ready(function() {

    $('#example thead th').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    // DataTable
/*   var table = $('#example').DataTable();

    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
          $( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
            table
            .column( colIdx )
            .search( this.value )
            .draw();
          } );
    } );
*/
    //Style for CkEditor    
    $.ajax({
      type:"GET",
      url:"{{route('style.get_styles')}}",
      success:function(res){
          styles =  JSON.parse(res);
         
          styles.forEach(function(item){
              
             my_obj=
             { name: item.style_name, element:'span',styles: { 'color': ''+item.style_text_color+'' ,'font-size': ''+item.style_font_size+'','font-family': ''+item.style_font_family+'', 'font-weight': ''+item.style_bold+'' ,'background-color': ''+item.style_background_color+'','font-style':''+item.style_italic+'','border': ''+item.style_border+' '+item.style_border_color+'','text-decoration': ''+item.style_under_line+'','border-radius':''+item.style_border_radius+'px','padding':'5px',}};
             mm.push(my_obj);
          });
      }
    });
    CKEDITOR.stylesSet.add('default', mm); 
    CKEDITOR.config.uiColor = '#cae8ca';   
    CKEDITOR.replace('arabicText', {
            height: 90,
            contentsLangDirection : 'rtl',
            on: {
                      save: function(evt)
                      {
                          saveFunction();
                      }
                }
    });
    CKEDITOR.replace('englishText', {
          height: 90,
          on: {
                    save: function(evt)
                    {
                        saveFunction();
                    }
              }
    });   











  } );


  $('#create').click(function(){
    document.getElementById('container').hidden = false;
    initailize_feild_to_add();
  })
//cancel Edit Or Cancel Create
  $('#cancel').click(function(){
        document.getElementById('container').hidden = true;
        initailize_feild_to_add();
  })
//Select dictionary To Edit
  function selectDicToEdit(id){
    document.getElementById('container').hidden = false;
    $.ajax({
        type :'GET',
        url:"{{route('dictionary.get_details')}}",
        data:{
            id : id
        },
        success:function(res){
            dic =  JSON.parse(res);
            document.getElementById('word_id').value = dic.id;

          }
    })
  }
//save tag to update or create 
  $('#save').click(function(){
    var id = document.getElementById('word_id').value;
    //get text without format
    var dom=document.createElement("DIV");

    var ar_html=CKEDITOR.instances['arabicText'].getSnapshot();
    dom.innerHTML = ar_html;
    var arabicText_pure=(dom.textContent || dom.innerText);
    
    var en_html=CKEDITOR.instances['englishText'].getSnapshot();
    dom.innerHTML = en_html;
    var englishText_pure=(dom.textContent || dom.innerText);

    $.ajax({
        type :"post",
        url:"{{route('dictionary.save_dictionary')}}",
        data:{
            id : document.getElementById('word_id').value,
            arabicText : CKEDITOR.instances['arabicText'].getData(),
            englishText : CKEDITOR.instances['englishText'].getData(),
            arabicTextRaw : arabicText_pure,
            englishTextRaw : englishText_pure,
            status : document.getElementById('status').value,
            dictionary_id : document.getElementById('dictionary_id').value,
        },
        success:function(res){
          console.log('res : ');
          console.log(res);
          document.getElementById('container').hidden = true;
          initailize_feild_to_add();
          //alert(res['success']);
          /*if(id == "")
            location.reload();*/
        }
      });
  });

  function initailize_feild_to_add()
  {
    document.getElementById('word_id').value = "";
    document.getElementById('arabicText').value = "";
    document.getElementById('englishText').value = "";
    /*$('#tag_font_family option').prop('selected', function() {
        return this.defaultSelected;
    });*/
    document.getElementById('status').value = "";
    document.getElementById('dictionary_id').value = "";
  }
//search
  $('#search').click(function(){
    $.ajax({
        type :"get",
        url:"{{route('dictionary.search')}}",
        data:{
            search_type : document.getElementById('search_type').value,
            search_word : document.getElementById('search_word').value,
        },
        success:function(res){
          console.log('res : ');
        }
      });
  });

  $.ajaxSetup(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>


@endsection
