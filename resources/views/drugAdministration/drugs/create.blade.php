@extends('drugAdministration.drugs.base')

@section('action-content')
<link href="{{asset('/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<script <script src={{asset("/js/alaa/jquery.js")}}></script>
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
</style>
<!-- END CSS for this page -->
<div class="card mb-3">
    <div class="card-body">
        <div class="alert alert-success" role="alert">
        </div>

        <form method="POST"  action="{{ route('drug.store') }}" data-parsley-validate novalidate>
            {{  csrf_field() }}
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="en_name">Drug English Name<span class="text-danger">*</span></label>
                    <input type="text" name="en_name" data-parsley-trigger="change" required="" placeholder="Enter Drug English Name" class="form-control" id="en_name">
                    <div class="invalid-feedback">
                        Please enter a drug English Name.
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="ar_name">Drug Arabic Name</label>
                    <input type="text" name="ar_name" data-parsley-trigger="change" placeholder="Enter Drug English Name" class="form-control" id="ar_name"   >
                </div>
           </div>

           <div class="row">
            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label" for="classification">Classification</label>
                <select class="form-control select2" name="classification_id" id="classification_id"  >
                        <option ></option>
                        @foreach ($classifications as $classification)
                            <option value="{{$classification->id}}">{{$classification->en_term}}</option>
                        @endforeach
                </select>
            </div>    
            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label" for="form">Form</label>
                <select class="form-control select2" name="form_id" id="form_id"  onchange="getFormUnitAjax(this.value)">
                    <option ></option>
                    @foreach ($forms as $form)
                        <option value="{{$form->id}}">{{$form->en_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="country">Country</label>
                    <select class="form-control" name="country_id">
                        <option ></option>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->en_name}}</option> 
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="amount_of_form">Amount Of Form</label>
                    <input type="text" name="amount_of_form" data-parsley-trigger="change" placeholder="Enter Amount Of Form" class="form-control" id="amount_of_form"   >
                </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label" for="company">Company</label>
                <select class="form-control select2" name="company_id" onchange="getleafletsAjax(this.value)">
                    <option ></option>
                    @foreach ($companies as $company)
                        <option value="{{$company->id}}">{{$company->en_name}}</option>
                    @endforeach
                </select>
            </div>    
            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label" for="leaflet">Leaflet</label>
                <select class="form-control select2" name="leaflet_id" id="leaflet_id" onchange="getArEnleafletsAjax(this.value)">
                </select>
            </div>
        </div>


        <div class="row">
               <div class="col-md-6 mb-3">
                    <label for="en_leaflet">english leaflet</label>
                        <textarea type="text" id="en_leaflet"  name="en_leaflet" class="form-control" readonly></textarea>
                </div>

            <div class="col-md-6 mb-3">
                    <label for="ar_leaflet">arabic leaflet</label>
                        <textarea type="text" id="ar_leaflet"  name="ar_leaflet" class="form-control" readonly> 
                        </textarea>
                </div>
        </div>

        <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="pharma_price">Pharma Price</label>
                    <input type="text" name="pharma_price" data-parsley-trigger="change" placeholder="Enter Pharma Price" class="form-control" id="pharma_price">
                    
                </div>

                <div class="col-md-6 mb-3">
                    <label for="lay_price">Lay Price</label>
                    <input type="text" name="lay_price" data-parsley-trigger="change" placeholder="Enter Lay Price" class="form-control" id="lay_price">
                </div>
        </div>

        <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="barcodes">Barcodes</label>
                    <input type="text" name="barcodes" data-parsley-trigger="change"  placeholder="Enter Barcodes" class="form-control" id="barcodes">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status">Status</label>
                    <select class="form-control" name="status_id">
                        <option></option>
                        @foreach ($status as $stat)
                            <option value="{{$stat->id}}">{{$stat->en_name}}</option>
                        @endforeach
                    </select>
                </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label >Chemical Composition</label>
                <div class="col-md-6 mb-3">
                <label >In Every</label>
                <input name="form_unit" id="form_unit" type="string" class="form-control" " value="{{ old('form_unit') }}"   readonly >    
                </div>
            
                <label  class="col-md-4 control-label">Composition / Quantity</label> 
                    <div class="table-responsive">  
                                <table class="table table-bordered" id="dynamic_field">  
                                    <tr>  
                                        <td>
                                            <table>
                                                <tr>
                                                    <select class="form-control select2" name="compositions[0]" onchange="getQuantitiesAjax(this.value)">
                                                        <option></option>
                                                        @foreach ($compositions as $composition)
                                                        <option value="{{$composition->id}}">{{$composition->en_name}} </option>
                                                        @endforeach
                                                    </select>
                                                </tr>
                                                <tr>
                                                    <select class="form-control name_list" name="quantity_id[0]" id="quantity_id" >
                                                        <option value=""></option>
                                                    </select>
                                                </tr>
                                            </table>
                                        </td>  
                                        <td>
                                            <button type="button" name="add" id="add" class="btn btn-success">
                                                Add More
                                            </button>
                                        </td>  
                                    </tr>  
                                </table>  
                    </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label">Pictures</label>
                    <div class="input-group control-group increment2" >
                        <input type="file" name="pictures[]" class="form-control">
                        <div class="input-group-btn" > 
                            <button class="btn btn-success2" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                        </div>
                    </div>
                    <div class="clone2 hide">
                        <label class="col-md-4 control-label"></label>
                        <div class="control-group input-group" >
                            <input type="file" name="pictures[]" class="form-control">
                            <div class="input-group-btn"> 
                                <button class="btn btn-danger2" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
         <div class="form-group text-right m-b-0">
            <button class="btn btn-primary" type="submit">
                Submit
            </button>
            <a class="btn btn-secondary m-l-5" href ="{{route('drug.index')}}">
                Cancel
            </a>
        </div>

    </form>

</div>                                                      
<!-- end card-->                  
</div>

<!---------------------------------------------------------------------------------------------------->
<!-- BEGIN Java Script for this page -->
<script src="{{asset('/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<script>
    $('#form').parsley();
</script>
<!-- script to repeter anter image -->
<script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success2").click(function(){ 
          var html = $(".clone2").html();
          $(".increment2").after(html);
      });

      $("body").on("click",".btn-danger2",function(){ 
          $(this).parents(".control-group").remove();
      });
  });
</script>

<!-- script to repeter anter Chemical Composition -->

<!--get form unit-->
<script type="text/javascript">
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
    })
</script>

<!-- get all leaflets belogto this company -->
<script type="text/javascript">
    var indexLeafleats="{{route('drug.getLeaflets')}}";
    function getleafletsAjax(company_id){
        $.ajax({
            type : 'GET',
            url : indexLeafleats,
            data : {
                company_id :company_id
            },
            success:function(res){       
                if(res){
                    $("#leaflet_id").append('<option></option>');
                    $.each(res,function(key,value){
                        $("#leaflet_id").append('<option value="'+key+'">'+value+'</option>');
                    });
                }else{
                    $("#leaflet_id").empty();
                }
            }    
        });
    }
    var indexArEnLeaflet = "{{route('drug.getDetailsLeaflet')}}";
    function getArEnleafletsAjax(leaflet_id){
        console.log(leaflet_id);
        $.ajax({
            type :'GET',
            url : indexArEnLeaflet,
            data : {
                id : leaflet_id
            },
            success:function(res){
                console.log(res);
                document.getElementById('ar_leaflet').value =  res.ar_leaflet;
                document.getElementById('en_leaflet').value =  res.en_leaflet;  
            }
        });
    }
</script> 
<!-- Quantity for first row   -->
<script type="text/javascript">
    var indexCompositionQuantity = "{{route('composition.getQuantities')}}";
    function getQuantitiesAjax(composition_id){
        console.log(composition_id)
        $.ajax({
            type :'GET',
            url : indexCompositionQuantity,
            data : {
                id : composition_id
            },
            success:function(res){ 
                console.log(res);      
                if(res){
                    $("#quantity_id").empty();
                    $.each(res,function(key,value){
                        $("#quantity_id").append('<option value="'+key+'">'+value+'</option>');
                    });
                }else{
                    $("#quantity_id").empty();
                }
            }   
        });
    }

    function getQuantitiesAjax2(composition_id,i){
        console.log(composition_id)
        $.ajax({
            type :'GET',
            url : indexCompositionQuantity,
            data : {
                id : composition_id
            },
            success:function(res){ 
                console.log(res);      
                if(res){
                    $("#quantity_id"+i).empty();
                    $.each(res,function(key,value){
                        $("#quantity_id"+i).append('<option value="'+key+'">'+value+'</option>');
                    });
                }else{
                    $("#quantity_id"+i).empty();
                }
            }   
        });
    }
</script>



<script type="text/javascript">
   $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
         i++;  
         $('#dynamic_field').append('<tr id="'+i+'"><td><table><tr><select class="form-control" name="compositions['+i+']" placeholder="Enter your Name"  onchange="getQuantitiesAjax2(this.value,'+i+')"><option></option>@foreach ($compositions as $composition)<option value="{{$composition->id}}">{{$composition->en_name}} </option>@endforeach</select></tr><tr><select class="form-control name_list" name="quantity_id['+i+']" id="quantity_id'+i+'" ><option value=""></option></select></tr></table></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
     });  
      $(document).on('click', '.btn_remove', function(){  
         var button_id = $(this).attr("id");   
         $('#'+button_id+'').remove();  
     });  
      

      $('.select2').select2(); 
  });  
</script>




@endsection

