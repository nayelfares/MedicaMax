@extends('drugAdministration.drugs.base')
  @section('action-content') 

        <!-- BEGIN CSS for this page -->
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

          /* Ensure that the demo table scrolls */
        
        div.dataTables_wrapper {
          
          margin: 0 auto;
        }

    
    </style>


  <div class="card mb-3" > 

    <div class="card-header">
      <i class="fa fa-braille bigfonts" aria-hidden="true"></i> All drug ({{$count}})
      <span class="pull-right">
        <a  class="btn btn-outline-info btn-sm" href="{{ route('drug.index') }}"><i class="fa fa-refresh bigfonts" aria-hidden="true"></i> </a>
        <a class="btn btn-primary btn-sm" href="{{route('chemical_Composition.import_interface')}}" target="_blank"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import Chemical Composition</a>
        <a class="btn btn-primary btn-sm" href="{{route('drug.import_interface')}}" target="_blank"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import Drugs</a>
      <!--  <a id="add_drug" class="btn btn-primary btn-sm" href="{{ route('drug.create') }}" target="_blank"><i class="fa fa-plus bigfonts" aria-hidden="true"></i> Add new drug</a>-->
      <button id="SubmitButton" type="button" class="btn btn-outline-success btn-primary btn-sm" > submit </button>
      <button id="add_drug" name="add_drug" class="btn btn-primary btn-sm" ><i class="fa fa-plus bigfonts" aria-hidden="true"></i>Add Drug </button>
      </span>
    </div>   
 

    <div class="card-body" style="margin-top: 0.0em;margin-bottom: 0.0em;">
      <div class="row" >
                <div class="col-md-2 mb-0 col-sm-0"> 
                      
                      <!--  <label for="en_name">Drug English Name<span class="text-danger">*</span></label>-->
                        <input type="text" name="en_name" data-parsley-trigger="change" required="" placeholder=" English Name" class="form-control form-control-sm" id="en_name">
                        
                        
                      <!--  <label for="ar_name">Drug Arabic Name</label> -->
                        <input type="text" name="ar_name" data-parsley-trigger="change" placeholder="  Arabic Name" class="form-control form-control-sm" id="ar_name"   >
                        
                        <!--<label for="classification">Classification</label>-->
                        <select class="form-control form-control-sm select2" name="classification_id" id="classification_id">
                        </select>

                        
                </div>
            <div class="col-md-2 mb-0 col-sm-0 ">
                  <!--<label for="form">Form</label>-->
                        <select class="form-control form-control-sm select2" name="form_id" id="form_id"  onchange="getFormUnitAjax(this.value)">               
                        </select>

                  <!--  <label for="amount_of_form">Amount Of Form</label>-->
                    <input type="text" name="amount_of_form" data-parsley-trigger="change" placeholder=" Amount Of Form" class="form-control form-control-sm" id="amount_of_form"   >

                    <!--<label for="country">Country</label>-->
                    <select class="form-control form-control-sm select2" name="country_id">
                        <option ></option>
                        
                    </select>  

            </div>
            <div class="col-md-2 mb-0 col-sm-0 " > 

                    <!--<label for="company">Company</label>-->
                    <select class="form-control form-control-sm select2" name="company_id" id="company_id" onchange="getleafletsAjax(this.value)">                   
                    </select>

                    <!--<label for="barcodes">Barcodes</label>-->
                    <input type="text" name="barcodes" data-parsley-trigger="change"  placeholder=" Barcodes" class="form-control form-control-sm" id="barcodes">
                    <!--<label  for="leaflet">Leaflet</label>-->
                    <select class="form-control form-control-sm select2" name="leaflet_id" id="leaflet_id">
                    </select>

                    
                             
            </div>
            <div class="col-md-2 mb-0 col-sm-0 " >

                    <!--<label for="pharma_price">Pharma Price</label>-->
                    <input type="text" name="pharma_price" data-parsley-trigger="change" placeholder=" Pharma Price" class="form-control form-control-sm" id="pharma_price">

                    <!--<label for="lay_price">Lay Price</label>-->
                    <input type="text" name="lay_price" data-parsley-trigger="change" placeholder=" Lay Price" class="form-control form-control-sm" id="lay_price">

                    
                
                    <!--<label for="status">Status</label>-->
                    <select class="form-control form-control-sm" name="status_id" id="status_id">
                    </select>
            </div>
            <div class="col-md-2 mb-0 col-sm-0 ">
                    <!--<label >Chemical Composition</label>-->
                    <div class="row" >    
                        <div class="col-md-2 mb-0">
                            <label >InEvery:</label>
                        </div>
                        <div class="col-md-6 mb-0" >
                           <input name="form_unit" id="form_unit" type="string" class="form-control form-control-sm"    readonly > 
                        </div>       
                    </div>
                    <!--<label  >Composition / Quantity</label>--> 
                      <div class="row " style="display:block;overflow:auto;height:80px;">  
                                  <table calss="table table-bordered" id="dynamic_field">  
                                    <tr class="col-md-4 mb-0">  
                                        <td class="col-md-4 mb-0" >
                                            <!--<table>-->
                                              
                                                    <select type='text' class="form-control form-control-sm select2" name="compositions[0]" id="composition_id"  onchange="getQuantitiesAjax(this.value , 0 )">
                                                    </select>
                                                
                                                    <select class="form-control form-control-sm" name="quantity_id[0]" id="quantity_id" onchange="getIdsQuantities(this.value , 0)">

                                                    </select>
                                                
                                            <!--</table>-->
                                        </td>  
                                        <td class="col-md-1 mb-0">
                                            <button type="button" name="add_ch" id="add_ch" class="btn btn-success btn-sm">
                                                Add
                                            </button>
                                        </td>  
                                    </tr>  
                                </table>
                    </div>
            </div>
      
           <div class="col-md-2 mb-0" >
                <!--<label class="control-label">Pictures</label>-->
                <div style="display:block;overflow:auto;height:105px">
                    <div class="input-group control-group increment2">
                      <form id="upload_image_form" method="post" enctype="multipart/form-data">
                          <input id="image_input" accept="image/*" type="file" name="image_input" class="form-control form-control-sm">
                        </form>
                        <div class="input-group-btn" > 
                            <button id="upload_image" name="upload_image" class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Upload</button>
                        </div>
                    </div>
                    <div id="drug_images">
                         <div class='image_holder' style="display: none">
                            <i class="fa fa-fw fa-remove"></i>
                            <div class='image_cnt' style="display: inline;"></div>
                         </div>
                    </div>
                </div>
            </div>  
      
        </div>
<!----------------------------------------->      
   <hr style="border-style: inset; border-width: 2px;margin-top: 0.1em;margin-bottom: 0.2em;">
<!----------------------------------------->
      <div class="table-responsive" style="display:block;overflow:auto;height:550px;margin-top: 0.0em;margin-bottom: 0.0em; ">
        <table id="example" class="table table-bordered table-hover display " style="width:100%">
          <thead>
            <tr >
              <th></th>
              <th>English Name</th>
              <th>Arabic Name</th>
              <th>Company</th>
              <th>Form</th>
              <th>Classification</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            @foreach ($drugs as $drug)
            <tr >
              <td>
                <button class="btn btn-primary btn-sm" id="edit_drug" name="edit_drug" onclick="edit_drug('{{$drug->id }}')" ><i class="fa fa-pencil" aria-hidden="true"></i></button>
              </td>
              <td >{{ $drug->en_name }}</td>
              <td >{{ $drug->ar_name }}</td>
              <td >{{ $drug->company_en_name }}</td>
              <td >{{ $drug->form_en_name }}</td>
              <td >{{ $drug->classifications_en_term }}</td>
              <td >{{ $drug->status_en_name}}</td>
              <td >
              <!--  <form  method="POST" action="{{ route('drug.destroy', ['id' => $drug->id]) }}" onsubmit = "return confirm('Are you sure?')">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a role="button" href="{{ route('drug.show', ['id' => $drug->id]) }}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-eye bigfonts"></i></a>
                <a href="{{ route('drug.edit', ['id' => $drug->id]) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>
                </button>
              </form>-->
              <button class="btn btn-danger btn-sm" id="delete_drug" name="delete_drug" onclick="delete_drug('{{$drug->id }}')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <!-- BEGIN Java Script for this page -->
<script src="{{ asset('js/alaa/jquery-3.3.1.js')}}"></script> 
<link href="{{asset('/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<script src="{{asset('/assets/plugins/select2/js/select2.min.js')}}"></script>

<link rel="stylesheet" href="{{ asset('/js/alaa/jquery.dataTables.min.css')}}" />



<script id="upload_image_script">
  var uploadImageUrl = "{{route('picture.upload')}}";
  var upload_ids = [];
  var upload_compositions = [] ;
  var upload_quantities = [] ;
  var form_unit ;
  $(document).ready(function(){
    //intilization
    $("#classification_id").append('<option value="" disabled selected>Classification</option>');
    $("#form_id").append('<option value="" disabled selected>Form</option>');
    $("#company_id").append('<option value="" disabled selected>Company</option>');
    $("#leaflet_id").append('<option value="" disabled selected>Leaflet</option>');
    $("#status_id").append('<option value="" disabled selected>Status</option>');
    $("#composition_id").append('<option value="" disabled selected>Composition</option>');
    $("#quantity_id").append('<option value="" disabled selected>Quantity</option>');
    //initilization DataTable
    
     $('#example').DataTable( {
      //"dom": 'lrtip', //(to his search box)
      "dom": '<"wrapper"flipt>',
        scrollY:        false,
        scrollX:        false,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            heightMatch: 'none'
        },
        "columnDefs": [
          { "width": "1%", "targets": 7 },
          { "width": "1%", "targets": 0 }

          ],
        initComplete: function () {
          this.api().columns([3,4,5,6]).every( function () {
            var column = this;
            var select = $('<select><option value="" ></option></select>')
            .appendTo( $(column.header())  )
            .on( 'change', function () {
              var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
                );
              column
              .search( val ? '^'+val+'$' : '', true, false )
              .draw();
            } );
            column.data().unique().sort().each( function ( d, j ) {
              select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
          } );
        }
      } );

    // UPLOAD Image--------------------------------------------------------------
    $('#upload_image').click(function(event){
      $('#upload_image_form').submit();
    });

    $('#upload_image_form').on('submit', function(e){
      e.preventDefault();
      var data = new FormData(this);
      if($('#image_input').val()){
        $.ajax({
          type: 'POST',
          data: data,
          url:  uploadImageUrl,
          contentType: false,
              cache: false,
            processData:false
        }).done(function(_data){
          var data =  JSON.parse(_data);
          var $image = $('<img></img>').attr('src', data['path']).attr('height', 100).attr('data-id', data['id']);
          $clone = $('.image_holder').clone();
          $clone.show();
          $clone.css('display', 'inline').css('margin', '10px');
          $clone.removeClass('image_holder');
          $clone.find('.image_cnt').append($image);
          $('#drug_images').append($clone);
          $('#image_input').val('');
          upload_ids.push(data['id']);
        });
      }else{
        alert('no image');
      }
    });
// DELETE --------------------------------------------------------------
  /*      function myFunction(value) {
        if (confirm('Are you sure want to remove profile picture?')) {
            var x = document.getElementById(value);
            if (x.style.visibility === 'visible') {
                x.style.visibility = 'visible';
                
            } else {
                x.style.visibility = 'hidden';
            }
            console.log("555");
            $.ajax({
                type :'GET',
                url:"{{route('picture.delete')}}",
                data:{
                    title : value
                },
                success:function(res){
                    console.log('ok');
                }
            });
        }
    }*/


  });


</script>
<!--------CRUD-->

<script>
//----ADD  
  var compare ;
  var drug_id = 0;
  var indexclassifiction = "{{route('drug.getClassification')}}";
  var indexForm = "{{route('drug.getForm')}}";
  var indexCompany = "{{route('drug.getCompanies')}}";
  var indexStatus = "{{route('drug.getStatuses')}}";
  var indexComposition = "{{route('drug.getCompositions')}}";
  var indexImages = "{{route('drug.getImages')}}";
  $('#add_drug').click(function(){
    compare = 1;
    document.getElementById("en_name").value = ""; 
    document.getElementById("ar_name").value = ""; 
    document.getElementById("amount_of_form").value = ""; 
    document.getElementById("pharma_price").value = ""; 
    document.getElementById("lay_price").value = ""; 
    document.getElementById("barcodes").value = ""; 
    document.getElementById("form_unit").value = ""; 
//get classification
    $.ajax({
            type : 'GET',
            url : indexclassifiction,
            success:function(res){  
                if(res){
                    $("#classification_id").empty();
                    $("#classification_id").append('<option value="" disabled selected>Classification</option>');
                    $.each(res,function(key,value){
                        $("#classification_id").append('<option value="'+key+'">'+value+'</option>');
                    });
                }else{
                    $("#classification_id").empty();
                }
            }    
        });
//get Forms
    $.ajax({
      type : "GET",
      url : indexForm,
      success:function(res){
        if(res){
          $("#form_id").empty();
          $("#form_id").append('<option value="" disabled selected>Form</option>');
          $.each(res,function(key,value){
            $("#form_id").append('<option value="'+key+'">'+value+'</option>');
          });
        }
        else{
          $("#form_id").empty();
        }
      }
    });
//get Companies 
    $.ajax({
      type : "GET",
      url : indexCompany,
      data : {id : ""},
      success:function(res){
        if(res){
          $("#company_id").empty();
          $("#company_id").append('<option value="" disabled selected>Company</option>');
          $.each(res,function(key,value){
            $("#company_id").append('<option value="'+key+'">'+value+'</option>');
          });
        }
        else{
          $("#company_id").empty();
        }
      }
    });   
//get status
    $.ajax({
      type : "GET",
      url : indexStatus,
      data : {id : ""},
      success:function(res){
        if(res){
          $("#status_id").empty();
          $("#status_id").append('<option value="" disabled selected>Status</option>');
          $.each(res,function(key,value){
            $("#status_id").append('<option value="'+key+'">'+value+'</option>');
          });
        }
        else{
          $("#status_id").empty();
        }
      }
    });   
//For search in list
    $('.select2').select2(); 
// script to repeter  image 
      $("#add_img").click(function(){ 
          var html = $(".clone2").html();
          $(".increment2").after(html);
      });
      $("body").on("click","#danger_img",function(){ 
          $(this).parents(".control-group").remove();
      });
// script to repeter chimical composition 
      var i=0;  
      $('#add_ch').click(function(){  
         i++;  
         $('#dynamic_field').append('<tr id="'+i+'" ><td class="col-md-4 mb-0"><select class="form-control form-control-sm select2"  name="compositions['+i+']" id="composition_id'+i+'"  onchange="getQuantitiesAjax2(this.value,'+i+')"><option value="" disabled selected>Composition</option></select><select class="form-control form-control-sm" name="quantity_id['+i+']" id="quantity_id'+i+'" onchange="getIdsQuantities(this.value ,'+i+')"><option value="" disabled selected>Quantity</option></select></td><td class="col-md-1 mb-0"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>'); 
         $('.select2').select2();
         $.ajax({
            type : "GET",
            url : indexComposition,
            data : {id : ""},
            success:function(res){
              if(res){
                  $("#composition_id"+i).append('<option></option>');
                  $.each(res,function(key,value){
                    $("#composition_id"+i).append('<option value="'+key+'">'+value+'</option>');
                  });
              }
              else{
                $("#composition_id"+i).empty();
              }
            }
          });
      }); 
// script to delete of repeter chimical composition       
      $(document).on('click', '.btn_remove', function(){  
         var button_id = $(this).attr("id");   
         $('#'+button_id+'').remove();  
      });
//composition_id
    $.ajax({
      type : "GET",
      url : indexComposition,
      data : {id : ""},
      success:function(res){
        if(res){
          $("#composition_id").append('<option></option>');
          $.each(res,function(key,value){
            $("#composition_id").append('<option value="'+key+'">'+value+'</option>');
          });
        }
        else{
          $("#composition_id").empty();
        }
      }
    });
  });
//-----EDIT
     
    function edit_drug(id){
      compare = 2;
      drug_id = id;
    var en_name;
    var ar_name;
    var classification_id;
    var classification_en_term;
    var form_id;
    var form_en_name;
    var amount_of_form;
    var country_id;
    var company_id;
    var company_en_name;
    var barcodes;
    var leaflet_id;
    var leaflet_name;
    var pharma_price;
    var lay_price;
    var status_id;
    var status_en_name;
    var form_unit;
    var compositions = [];
    var quantities = [];
    var images_id = []; 
      $.ajax({
        type:'GET',
        url : "{{route('drug.get_drug_detailes')}}",
        data : {
          id : id
        },
        success:function(_data){
            var data =  JSON.parse(_data);
            en_name = data['en_name'];
            ar_name = data['ar_name'];
            classification_id = data['classification_id'] ;
            classification_en_term = data['classification_en_term'];
            form_id = data['form_id'];
            form_en_name = data['form_en_name'];
            amount_of_form = data['amount_of_form'];
            country_id = data['country_id'];
            company_id = data['company_id'];
            company_en_name = data['company_en_name'];
            barcodes = data['barcodes'];
            leaflet_id = data['leaflet_id'];
            leaflet_name = data['leaflet_name'];
            pharma_price = data['pharma_price'];
            lay_price = data['lay_price'];
            status_id = data['status_id'];
            status_en_name = data['status_en_name'];
            form_unit = data['form_unit'];
            document.getElementById('en_name').value = en_name;
            document.getElementById('ar_name').value = ar_name;
            document.getElementById('amount_of_form').value = amount_of_form;
            document.getElementById('barcodes').value = barcodes;
            document.getElementById('pharma_price').value = pharma_price;
            document.getElementById('lay_price').value = lay_price;
            document.getElementById('form_unit').value = form_unit; 
   //get classification
            $.ajax({
                  type : 'GET',
                  url : indexclassifiction,
                  success:function(res){  
                      if(res){
                          $("#classification_id").empty();
                          $("#classification_id").append('<option value="'+classification_id+'">'+classification_en_term+'</option>');
                          $.each(res,function(key,value){
                              $("#classification_id").append('<option value="'+key+'">'+value+'</option>');
                          });
                      }else{
                      $("#classification_id").empty();
                      }
                  }    
            });
            //get Forms
            $.ajax({
              type : "GET",
              url : indexForm,
              success:function(res){
                if(res){
                  $("#form_id").empty();
                  $("#form_id").append('<option value="'+form_id+'" >'+form_en_name+'</option>');
                  $.each(res,function(key,value){
                      $("#form_id").append('<option value="'+key+'">'+value+'</option>');
                  });
                }
                else{
                  $("#form_id").empty();
                }
              }
            });

//get Companies 
            $.ajax({
                  type : "GET",
                  url : indexCompany,
                  data : {id : ""},
                  success:function(res){
                          if(res){
                                  $("#company_id").empty();
                                  $("#company_id").append('<option value="'+company_id+'">'+company_en_name+'</option>');
                                  $.each(res,function(key,value){
                                          $("#company_id").append('<option value="'+key+'">'+value+'</option>');
                                  });
                          }
                          else{
                                  $("#company_id").empty();
                          }
                    }
            }); 
//current Leaflet
            $.ajax({
                  type : 'GET',
                  url : "{{route('drug.getLeafletsByDrug')}}",
                  data : {
                            drug_id :id
                  },
                  success:function(res){    
                        if(res){
                                $("#leaflet_id").empty();
                                $("#leaflet_id").append('<option value="'+leaflet_id+'">'+leaflet_name+'</option>');
                                $.each(res,function(key,value){
                                    $("#leaflet_id").append('<option value="'+key+'">'+value+'</option>');
                                });
                        }else{
                                $("#leaflet_id").empty();
                        }
                  }    
            });      
//get status
            $.ajax({
                  type : "GET",
                  url : indexStatus,
                  success:function(res){
                          if(res){
                                  $("#status_id").empty();
                                  $("#status_id").append('<option value="'+status_id+'">'+status_en_name+'</option>');
                                  $.each(res,function(key,value){
                                        $("#status_id").append('<option value="'+key+'">'+value+'</option>');
                                  });
                          }
                          else{
                                  $("#status_id").empty();
                          }
                  }
            });   
//For search in list
            $('.select2').select2(); 
//get image
        /*    $.ajax({
                  type : 'GET',
                  url : indeximage,
                  success:function(res){  
                      if(res){
                          $("#classification_id").empty();
                          $("#classification_id").append('<option value="'+classification_id+'">'+classification_en_term+'</option>');
                          $.each(res,function(key,value){
                              $("#classification_id").append('<option value="'+key+'">'+value+'</option>');
                          });
                      }else{
                      $("#classification_id").empty();
                      }
                  }    
            });*/

///////////////////////////////////   
        }
      });
   }
    
        








    
//-----DELETE
    function delete_drug(value) {
        if (confirm('Are you sure want to delete this drug?')) {
            $.ajax({
                type :'GET',
                url:"{{ route('drug.delete_drug')}}",
                data:{
                    id : value
                },
                success:function(res){
                    location.reload(true);
                }
            });
        }
    }














/////////////////////////////////////////////////////////////////////////////
// get all leaflets belogto this company 
    var indexLeafleats="{{route('drug.getLeaflets')}}";
    function getleafletsAjax(company_id){
      
      document.getElementById("leaflet_id").value = ""; 
        $.ajax({
            type : 'GET',
            url : indexLeafleats,
            data : {
                company_id :company_id
            },
            success:function(res){      
                if(res){
                    $("#leaflet_id").empty();
                    $("#leaflet_id").append('<option value="" disabled selected>Leaflet</option>');
                    $.each(res,function(key,value){
                        $("#leaflet_id").append('<option value="'+key+'">'+value+'</option>');
                    });
                }else{
                    $("#leaflet_id").empty();
                }
            }    
        });
    }    
// GET Form Unit
    var index = "{{route('drug.getFormUnit')}}";
    function getFormUnitAjax(form_id){
        $.ajax({
          type:'GET',
          url:index,
          data:{
            id : form_id 
          },
          success:function(res){ 
            var value = res[0].form_unit;
            form_unit = value;
            document.getElementById('form_unit').value =  value; 
            var elemnts= document.getElementsByName('form_unit');
            for (var index=0; index<elemnts.length; index++){
              elemnts[index].value = value;
            } 
          }
        });     
    }
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':'{!!csrf_token()!!}'
        }
    });
// get all Quantities belogto this composition      
//1 Quantity for first row   
    var indexCompositionQuantity = "{{route('composition.getQuantities')}}";
    function getQuantitiesAjax(composition_id){
      upload_compositions[0] = composition_id;
        $.ajax({
            type :'GET',
            url : indexCompositionQuantity,
            data : {
                id : composition_id
            },
            success:function(res){       
                if(res){
                    $("#quantity_id").empty();
                    $("#quantity_id").append('<option value="" disabled selected>Quantity</option>');
                    $.each(res,function(key,value){
                        $("#quantity_id").append('<option value="'+key+'">'+value+'</option>');
                    });
                }else{
                    $("#quantity_id").empty();
                }
            }   
        });
    } 
//2 Quantity for other row
    function getQuantitiesAjax2(composition_id,i){
      upload_compositions[i] = composition_id;
        $.ajax({
            type :'GET',
            url : indexCompositionQuantity,
            data : {
                id : composition_id
            },
            success:function(res){     
                if(res){
                    $("#quantity_id"+i).empty();
                    $("#quantity_id"+i).append('<option value="" disabled selected>Quantity</option>');
                    $.each(res,function(key,value){
                        $("#quantity_id"+i).append('<option value="'+key+'">'+value+'</option>');
                    });
                }else{
                    $("#quantity_id"+i).empty();
                }
            }   
        });
    } 
// GET IDS OF QUANTITIES
function getIdsQuantities(quantity_id,i){
 // consloe.log("ddd");
      upload_quantities[i]=quantity_id
}           
</script>
<script type="text/javascript">
    //save 
    $('#SubmitButton').click(function(){
        var id_ = 0;
        if(compare == 2){
          id_ = drug_id;
        }
        var en_name = document.getElementById('en_name').value;
        var ar_name = document.getElementById('ar_name').value;
        var classification_id = document.getElementById('classification_id').value;
        var form_id = document.getElementById('classification_id').value;
        var amount_of_form = document.getElementById('amount_of_form').value;
     //   var country_id = document.getElementById('country_id').value;
        var company_id = document.getElementById('company_id').value;
        var leaflet_id = document.getElementById('leaflet_id').value;
        var pharma_price = document.getElementById('pharma_price').value;
        var lay_price = document.getElementById('lay_price').value;
        var barcodes = document.getElementById('barcodes').value;
        var status_id = document.getElementById('status_id').value;
        console.log(id_);
        $.ajax({
                type :'GET',
                url:"{{ route('drug.submit_drug') }}",
                data:{
                   id : id_,
                   en_name :en_name,
                   ar_name:ar_name,
                   classification_id:classification_id,
                   form_id:form_id,
                   amount_of_form : amount_of_form,
                   company_id : company_id,
                   leaflet_id : leaflet_id,
                   pharma_price : pharma_price,
                   lay_price :lay_price,
                   barcodes : barcodes,
                   status_id : status_id,
                   form_unit : form_unit,
                   upload_imags : upload_ids,
                   compositions : upload_compositions,
                   quantities :upload_quantities
                },
                success:function(res){ 
                  location.reload(true);
                }
            });
    });
</script>






@endsection








