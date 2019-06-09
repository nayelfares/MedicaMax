@extends('drugAdministration.compositions.base')
@section('action-content')

  
<script src="{{ asset('/assets/js/jquery.min.js') }}" type="text/javascript"></script>
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
<div class="card mb-3"> 
 
  <div class="card-header">
    <i class="fa fa-braille bigfonts" aria-hidden="true"></i> All composition ({{$count}})
    <span class="pull-right">
      <a  class="btn btn-outline-info btn-sm" href="{{ route('composition.index') }}"><i class="fa fa-refresh bigfonts" aria-hidden="true"></i> </a>
      <a class="btn btn-primary btn-sm" href="{{route('composition.import_interface')}}" target="_blank"><i class="fa fa-download bigfonts" aria-hidden="true" ></i> Import Compositions</a>
      <a class="btn btn-primary btn-sm" href="{{route('CompositionQuantity.import_interface')}}" target="_blank"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import Compositions Quantities</a>
    <!--  <a class="btn btn-primary btn-sm" href="{{ route('composition.create') }}" target="_blank"><i class="fa fa-plus bigfonts" aria-hidden="true"></i> Add new composition</a>-->
    <button id="add_composition" name="add_composition" class="btn btn-primary btn-sm" ><i class="fa fa-plus bigfonts" aria-hidden="true"></i>Add Composition </button>
    

    </span>               
  </div>   

  <div class="card-body"> 
      <div class="row" style="margin-bottom: 0.0em;">
            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 col-xl-2"> 
                      <label for="en_name"> English Name<span class="text-danger">*</span></label>
                      <input type="text" name="en_name" data-parsley-trigger="change" required="" placeholder=" english Name" class="form-control" id="en_name"  > 
            </div>
            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 col-xl-2">
                      <label for="ar_name"> Arabic Name</label>
                      <input type="text" name="ar_name" data-parsley-trigger="change"  placeholder=" Arabic Name" class="form-control" id="ar_name" >  
            </div>
            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 col-xl-2"> 
                <div class="row">
                        <label for="status">Status</label>
                        <select class="form-control" name="status_id">
                            <option></option>
                                
                        </select>
                </div>  
            </div>
            <div class="col-md-3 mb-2">
                Chimical Composition
                <div id="container"  style="display:block;overflow:auto;height:115px;">
                  <div class="control-group increment " >
                    <div class="row">
                        <div class="col-md-4 mb-1">
                            <label for="quantity">Quantity</label>
                            <input type="text" class="form-control"  placeholder="quantity" name="quantity[]" id="quantity" type="string">
                        </div>
                        <div class="col-md-3 mb-1">
                            <label >More </label>
                            <button class="btn form-control btn-success" type="button">Add</button>
                        </div>
                    </div>
                  </div>
                  <div class="clone hide" style="display:none;visibility: hidden;">
                    <div class="control-group">
                        <div class="row">
                            <div class="col-md-4 mb-1">
                                <input type="text" class="form-control"  placeholder="quantity" name="quantity[]" id="quantity" type="string">
                            </div>

                            <div class="col-md-4 mb-1">
                                <button class="btn form-control btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i>Remove</button>
                            </div>
                        </div>
                    </div>
                  </div> 
                </div> 
            </div> 
            <div class="col-md-2 mb-2">                      
                        <p></p>
                        <p></p>
                        <p></p>
                        <button id="EditButton" type="button" class="btn btn-outline-success btn-lg" > submit </button>      
            </div>
      </div>
  </div>
  <hr style="border-style: inset; border-width: 5px;margin-top: 0.0em;">
  <div class="row" style="margin-top: 0.0em;">
    <div class="table-responsive">
      <table id="example" class="table table-bordered table-hover display" style="width:100%">
        <thead>
          <tr>
            <th>English Name</th>
            <th>Arabic Name</th>
            <th>Status</th>
            <td>Actions</td>
          </tr>
        </thead>

        <tbody>
          @foreach ($compositions as $composition)
          <tr role="row" class="odd">
                  <td>{{ $composition->en_name }}</td>
                  <td>{{ $composition->ar_name }}</td>
                  <td>{{ $composition->status_en_name }}</td>
            <td>
              <form  method="POST" action="{{ route('composition.destroy', ['id' => $composition->id]) }}" onsubmit = "return confirm('Are you sure?')">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a role="button" href="{{ route('composition.show', ['id' => $composition->id]) }}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-eye bigfonts"></i></a>
                <a href="{{ route('composition.edit', ['id' => $composition->id]) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
<script src="{{ asset('js/alaa/jquery-3.3.1.js')}}"></script>
<script src="{{ asset('js/alaa/jquery.dataTables.min.js')}}"></script>
<link  href="{{ asset('/js/alaa/jquery.dataTables.min.css')}}" type="text/css" />

<script>
  // START CODE FOR BASIC DATA TABLE 
  $(document).ready(function() {
    $('#example').DataTable();
  } );
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

  function delete_record(id)
  {
    if (confirm('Confirm delete')) {
    }
  }
    // START CODE Individual column searching (text inputs) DATA TABLE    

    // END CODE Individual column searching (text inputs) DATA TABLE    
  </script>
  <!-- script to repeter anter daily dose -->
<script type="text/javascript">
  var indexStatus = "{{route('drug.getStatuses')}}";
  $('#add_composition').click(function(){
    compare = 2;
    document.getElementById("en_name").value = ""; 
    document.getElementById("ar_name").value = "";
  });






$(document).ready(function() {

  $(".btn-success").click(function(){ 
      var html = $(".clone").html();
      $(".increment").after(html);
  });

  $("body").on("click",".btn-danger",function(){ 
      $(this).parents(".control-group").remove();
  });
});
</script>
  @endsection




