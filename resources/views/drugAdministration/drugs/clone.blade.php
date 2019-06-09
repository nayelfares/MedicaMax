@extends('drugAdministration.drugs.base')

@section('action-content')
<style>
* {
    box-sizing: border-box;
}

.column {
    float: left;
    width: 33.3%;
    padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
    content: "";
    clear: both;
    display: table;
} 
</style>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"> 
            <div class="panel panel-default">
                <div class="panel-heading">Create Drug</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('drug.store_clone') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <!--english name-->
                        <div class="form-group{{ $errors->has('en_name') ? ' has-error' : '' }}">
                            <label for="en_name" class="col-md-4 control-label">drug English Name</label>

                            <div class="col-md-6">
                                <input id="en_name" type="text" class="form-control" name="en_name" value="{{$drug->en_name}}"  required autofocus >

                                @if ($errors->has('en_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('en_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <!--arabic name-->
                        <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                            <label for="ar_name" class="col-md-4 control-label">drug Arabic Name</label>

                            <div class="col-md-6">
                                <input id="ar_name" type="text" class="form-control" name="ar_name" value="{{$drug->ar_name}}"   >

                                @if ($errors->has('ar_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ar_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!--classification -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">classification</label>
                            <div class="col-md-6">
                                <select class="form-control" name="classification_id">
                                    <option></option>
                                    @foreach ($classifications as $classification)
                                    <option value="{{$classification->id}}"  {{$classification->id == $drug->classification_id ? 'selecggted' : ''}}">{{$classification->en_term}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <!--form -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Form</label>
                            <div class="col-md-6">
                                <select class="form-control" name="form_id" id="form_id"  onchange="getFormUnitAjax(this.value)">
                                    <option ></option>
                                    @foreach ($forms as $form)
                                    <option value="{{$form->id}}" {{$form->id == $drug->form_id ? 'selected' : ''}}> {{$form->en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- amount of form -->
                        <div class="form-group">
                            <label for="amount_of_form" class="col-md-4 control-label">amount of form</label>

                            <div class="col-md-6">
                                <input id="amount_of_form" type="float" class="form-control" name="amount_of_form" value="{{ $drug->amount_of_form }}"   >
                            </div>
                        </div>
                        <!--country -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">country</label>
                            <div class="col-md-6">
                                <select class="form-control" name="country_id">
                                    <option></option>
                                    @foreach ($countries as $country)
                                    <option value="{{$country->id}}"  {{$country->id == $drug->country_id ? 'selecggted' : ''}}">{{$country->en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--company -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Company</label>
                            <div class="col-md-6">
                                <select class="form-control" name="company_id" onchange="getleafletsAjax(this.value)">
                                    <option></option>
                                    @foreach ($companies as $company)
                                    <option value="{{$company->id}}" {{$company->id == $drug->company_id ? 'selected' : ''}} >{{$company->en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--Leaflets -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Leaflet</label>
                            <div class="col-md-6">
                                <select class="form-control" name="leaflet_id" id="leaflet_id" onchange="getArEnleafletsAjax(this.value)">
                                    <option></option>
                                    @foreach ($leaflets as $leaflet)
                                    <option value="{{$leaflet->id}}" {{$leaflet->id == $drug->leaflet_id ? 'selected' : ''}} >{{$leaflet->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--english leaflet-->
                        <div class="form-group">
                            <label for="en_leaflet" class="col-md-4 control-label">english leaflet</label>
                            <div class="col-md-6">
                                <textarea box-sizing="border-box" id="en_leaflet" type="text"  name="en_leaflet" rows="5" cols="46"  readonly> 
                                </textarea>
                            </div>
                        </div>
                        <!--arabic leaflet-->
                        <div class="form-group">
                            <label for="ar_leaflet" class="col-md-4 control-label">arabic leaflet</label>
                            <div class="col-md-6">
                                <textarea box-sizing="border-box" id="ar_leaflet" type="text" name="ar_leaflet" rows="5" cols="46"  readonly> 
                                </textarea>
                            </div>
                        </div>
                        <!-- pharma_price -->
                        <div class="form-group">
                            <label for="pharma_price" class="col-md-4 control-label">pharma price</label>
                            <div class="col-md-6">
                                <input id="pharma_price" type="float" class="form-control" name="pharma_price" value="{{ $drug->pharma_price}}"   >
                            </div>
                        </div>
                        <!-- lay_price -->
                        <div class="form-group">
                            <label for="lay_price" class="col-md-4 control-label">lay price</label>

                            <div class="col-md-6">
                                <input id="lay_price" type="float" class="form-control" name="lay_price" value="{{ $drug->lay_price }}"   >
                            </div>
                        </div>
                        <!-- barcodes -->
                        <div class="form-group">
                            <label for="lay_price" class="col-md-4 control-label">barcodes</label>
                            <div class="col-md-6">
                                <input id="barcodes" type="text" class="form-control" name="barcodes" value="{{ old('barcodes') }}"   >
                            </div>
                        </div>
                        <!--status -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status_id">
                                    @foreach ($status as $stat)
                                    <option value="{{$stat->id}}" {{$stat->id == $drug->status_id ? 'selected' : ''}}>{{$stat->en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-------------------------------------------------------------------------------------------------------------------->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Chemical Composition</label>

                            <div class="input-group control-group" >
                                <div class="form-group">
                                    <label  class="col-md-4 control-label">In Every</label>
                                    <div class="col-md-6">

                                        <input name="form_unit" id="form_unit" type="string" class="form-control" " value="{{ $drug->form_unit}}"   readonly >

                                    </div>
                                </div>

                                <div class="form-group">
                                @foreach($ch_compositions as $ch_composition)
                                <label  class="col-md-2 control-label"></label>
                                <div class="input-group control-group1" >
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Composition:  </label>
                                        <div class="col-md-6">
                                            <input type="hidden" id="old_compositions[]" name="old_compositions[]" value="{{$ch_composition->composition_id}}">
                                            <input name="compositions" id="compositions" type="string" class="form-control" " value="{{$ch_composition->composition_en_name}}"   readonly >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Quantity:  </label>
                                        <div class="col-md-6">
                                            <input type="hidden" id="old_quantity_id[]" name="old_quantity_id[]" value="{{$ch_composition->composition_quantity_id}}">
                                            <input name="quantity" id="quantity" type="string" class="form-control" " value="{{$ch_composition->composition_quantity}}"   readonly >
                                        </div>
                                        
                                    </div>

                                    <div class="input-group-btn"> 
                                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            

                            <div class="form-group"> 
                                <label  class="col-md-4 control-label">Composition / Quantity</label> 
                                <div class="table-responsive">  
                                    <table class="table table-bordered" id="dynamic_field">  
                                        <tr>  
                                           <td>
                                            <table>
                                                <tr>
                                                    <select class="form-control" name="compositions[0]" onchange="getQuantitiesAjax(this.value)">
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

                        </div>
                    </div>
                    <!-------------------------------------------------------------------------------------------------------------------->
                    <!-- ADD Multiple Images Upload -->
                    <div >
                        <label class="col-md-4 control-label">Pictures</label>
                        <div class="input-group control-group increment1" >
                            <input type="file" name="pictures[]" class="form-control">
                            <div class="input-group-btn" > 
                                <button class="btn btn-success1" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                            </div>
                        </div>
                        <div class="clone1 hide">
                            <label class="col-md-4 control-label"></label>
                            <div class="control-group input-group" >
                                <input type="file" name="pictures[]" class="form-control">
                                <div class="input-group-btn"> 
                                    <button class="btn btn-danger1" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                </div>
                            </div>
                        </div>
                    </div> 



                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4" role="form" method="POST" action="{{ route('drug.store') }}">
                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<!-- script to repeter anter image-->
<script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success1").click(function(){ 
          var html = $(".clone1").html();
          $(".increment1").after(html);
      });

      $("body").on("click",".btn-danger1",function(){ 
          $(this).parents(".control-group").remove();
      });
  });
</script> 

<!-- script to repeter anter chemical -->
<script type="text/javascript">

    $(document).ready(function() {
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group1").remove();
      });
  });
</script>

<script >
    function myFunction(value) {
        var x = document.getElementById(value);
        if (x.style.visibility === 'visible') {
            x.style.visibility = 'hidden';
        } else {
            x.style.visibility = 'hidden';
        }
    }
</script>
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
                    $("#leaflet_id").empty();
                    $("#leaflet_id").append('<option>Select Leaflet</option>');
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
        $.ajax({
            type :"GET",
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
      $('#submit').click(function(){            
         $.ajax({  
            url:"name.php",  
            method:"POST",  
            data:$('#add_name').serialize(),  
            success:function(data)  
            {  
               alert(data);  
               $('#add_name')[0].reset();  
           }  
       });  
     });  
  });  
</script>
@endsection