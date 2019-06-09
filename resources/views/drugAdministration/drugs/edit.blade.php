@extends('drugAdministration.drugs.base')

@section('action-content')
<link href="{{asset('/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<script <script src={{asset("/js/alaa/jquery.js")}}></script>
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

.containerButtonInImg {
    position: relative;
    width: 100%;
    max-width: 400px;
}

.containerButtonInImg img {
    width: 100%;
    height: auto;
}

.containerButtonInImg .btn {
 position: absolute;
 top: 92%;
 left: 88%;
 transform: translate(-50%, -50%);
 -ms-transform: translate(-50%, -50%);
 background-color: white;
 color: red;
 font-size: 16px;
 padding: 8px 15px;
 border: none;
 cursor: pointer;
 border-radius: 8px;
 text-align: center;
}

.containerButtonInImg .btn:hover {
    background-color: black;
}

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
    <div class="card-body">
        <div class="alert alert-success" role="alert">
        </div>

        <form class="form-horizontal" role="form" method="POST" action="{{ route('drug.update', ['id' => $drug->id]) }}" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="en_name">Drug English Name<span class="text-danger">*</span></label>
                    <input type="text" name="en_name" data-parsley-trigger="change" required="" placeholder="Enter Drug English Name" class="form-control" id="en_name" 
                    value="{{$drug->en_name}}">
                    <div class="invalid-feedback">
                        Please enter a drug English Name.
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="ar_name">Drug Arabic Name</label>
                    <input type="text" name="ar_name" data-parsley-trigger="change" placeholder="Enter Drug English Name" class="form-control" id="ar_name" value="{{$drug->ar_name}}"  >
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="col-md-4 control-label" for="classification">Classification</label>
                    <select class="form-control select2" name="classification_id">
                        <option></option>
                        @foreach ($classifications as $classification)
                        <option value="{{$classification->id}}"  {{$classification->id == $drug->classification_id ? 'selecggted' : ''}}">{{$classification->en_term}}</option>
                        @endforeach
                    </select>
                </div>    
                <div class="col-md-6 mb-3">
                    <label class="col-md-4 control-label" for="form">Form</label>
                    <select class="form-control select2" name="form_id" id="form_id"  onchange="getFormUnitAjax(this.value)">
                        <option ></option>
                        @foreach ($forms as $form)
                        <option value="{{$form->id}}" {{$form->id == $drug->form_id ? 'selected' : ''}}> {{$form->en_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="country">Country</label>
                    <select class="form-control select2" name="country_id">
                        <option></option>
                        @foreach ($countries as $country)
                        <option value="{{$country->id}}"  {{$country->id == $drug->country_id ? 'selecggted' : ''}}">{{$country->en_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="amount_of_form">Amount Of Form</label>
                    <input type="text" name="amount_of_form" data-parsley-trigger="change" placeholder="Enter Amount Of Form" class="form-control" id="amount_of_form"  value="{{ $drug->amount_of_form }}" >
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="col-md-4 control-label" for="company">Company</label>
                    <select class="form-control select2" name="company_id" onchange="getArEnleafletsAjax(this.value)">
                        <option></option>
                        @foreach ($companies as $company)
                        <option value="{{$company->id}}" {{$company->id == $drug->company_id ? 'selected' : ''}} >{{$company->en_name}}</option>
                        @endforeach
                    </select>
                </div>    
                <div class="col-md-6 mb-3">
                    <label class="col-md-4 control-label" for="leaflet">Leaflet</label>
                    <select class="form-control select2" name="leaflet_id" id="leaflet_id" onchange="getArEnleafletsAjax(this.value)">
                     <option></option>
                     @foreach ($leaflets as $leaflet)
                     <option value="{{$leaflet->id}}" {{$leaflet->id == $drug->leaflet_id ? 'selected' : ''}} >{{$leaflet->name}}</option>
                     @endforeach
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
                <input type="text" name="pharma_price" data-parsley-trigger="change" placeholder="Enter Pharma Price" class="form-control" id="pharma_price" value="{{ $drug->pharma_price}}" >

            </div>

            <div class="col-md-6 mb-3">
                <label for="lay_price">Lay Price</label>
                <input type="text" name="lay_price" data-parsley-trigger="change" placeholder="Enter Lay Price" class="form-control" id="lay_price" value="{{ $drug->lay_price}}" >
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="barcodes">Barcodes</label>
                <input type="text" name="barcodes" data-parsley-trigger="change"  placeholder="Enter Barcodes" class="form-control" id="barcodes" value="{{ $drug->barcodes}}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="status">Status</label>
                <select class="form-control" name="status_id">
                    @foreach ($status as $stat)
                    <option value="{{$stat->id}}" {{$stat->id == $drug->status_id ? 'selected' : ''}}>{{$stat->en_name}}</option>
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
<!--------------------------->
                <div class="form-group">
                                    @foreach($ch_compositions as $ch_composition)
                                    <input type="hidden" id="old_ch_compositions[]" name="old_ch_compositions[]" value="{{$ch_composition->id}}">
                                    <label ></label>
                                    <div class="input-group control-group1" >
                                        <input type="hidden" id="new_ch_compositions[]" name="new_ch_compositions[]" value="{{$ch_composition->id}}">
                                        <div class="form-group">
                                            <label>Composition:  </label>
                                            <div class="col-md-6">
                                                <input type="hidden" id="old_compositions[]" name="old_compositions[]" value="{{$ch_composition->composition_id}}">
                                                <input name="compositions" id="compositions" type="string" class="form-control" " value="{{$ch_composition->composition_en_name}}"   readonly >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Quantity:  </label>
                                            <div class="col-md-6">
                                                <input type="hidden" id="old_quantity_id[]" name="old_quantity_id[]" value="{{$ch_composition->composition_quantity_id}}">
                                                <input name="quantity" id="quantity" type="string" class="form-control" " value="{{$ch_composition->composition_quantity}}"   readonly >
                                            </div>

                                        </div>

                                        <div class="input-group-btn"> 
                                            <label>delete</label>
                                            <div class="col-md-6">
                                            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>





<!--------------------------->
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

                <div class="row">
                        @foreach($images as $picture)
                        <div class="column">
                            <div class="containerButtonInImg">
                                <img id="{{$picture->title}}" src="../../../images/drug/{{$picture->title}}" alt="Snow" style="width:100%">
                                <a onclick="myFunction('{{$picture->title }}')" style="color: red;text-decoration: none;">
                                    <i class="glyphicon glyphicon-trash"></i> delete</a>

                                </div>
                            </div>
                            @endforeach
                        </div> 


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
<script src="{{asset('/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<script>
    $('#form').parsley();
</script>
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

<!-- script to repeter anter image -->
<script type="text/javascript">

    $(document).ready(function() {


      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group1").remove();
      });
  });
</script>
<!--Delete Image-->
<script >
    function myFunction(value) {
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
$('.select2').select2();  
});  
</script>
@endsection
