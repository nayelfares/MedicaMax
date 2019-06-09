@extends('drugAdministration.forms.base')
@section('action-content')
<div class="card mb-3"> 

  <div class="card-header">
    <i class="fa fa-braille bigfonts" aria-hidden="true"></i> All form ({{$count}})
    <span class="pull-right">
      <a  class="btn btn-outline-info btn-sm" href="{{ route('form.index') }}"><i class="fa fa-refresh bigfonts" aria-hidden="true"></i> </a>
      <a class="btn btn-primary btn-sm" href="{{route('form.export')}}" ><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Export</a>
      <a class="btn btn-primary btn-sm" href="{{route('form.import_interface')}}" target="_blank"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import</a>
      <a class="btn btn-primary btn-sm" href="{{  route('form.create')  }}" target="_blank"><i class="fa fa-plus bigfonts" aria-hidden="true"></i> Add new form</a>
    </span>               
  </div>    

  <div class="card-body">
    <div class="row" style="margin-bottom: 0.0em;">
            <div class="col-md-2 mb-2">  
                    <label for="en_name">English Form Name<span class="text-danger">*</span></label>
                    <input type="text" name="en_name" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="en_name"  >
            </div>
            <div class="col-md-2 mb-2" >
                    <label for="ar_name">Arabic Form Name</label>
                    <input type="text" name="ar_name" data-parsley-trigger="change"  placeholder="Enter Arabic form name" class="form-control" id="ar_name" >
                       
                    </select>
            </div>
            <div class="col-md-2 mb-2"> 
                    <label  for="parent_id">Parent Form</label>
                    <select class="form-control select2" name="parent_id">
                       <option value="">  </option>
                     </select>
            </div>
            <div class="col-md-2 mb-2"> 
                    <label for="ar_name">Form Unit</label>
                    <input type="text" name="form_unit" data-parsley-trigger="change"  placeholder="Enter unit" class="form-control" id="form_unit" >
            </div>
            <div class="col-md-2 mb-1"> 

                    <label for="ar_name">Amount</label>
                    <input type="text" name="amount" data-parsley-trigger="change"  placeholder="Enter Amount" class="form-control" id="amount" >
            </div>
            <div class="col-md-1 mb-1"> 
                    <label  for="status">Status</label>
                    <select class="form-control" name="status_id">
                        <option></option>
                    </select>       
            </div>
            <div class="col-md-1 mb-1">                     
                        <button id="EditButton" type="button" class="btn btn-outline-success btn-lg" > submit </button>      
            </div>
      </div>



  <hr style="border-style: inset; border-width: 5px;margin-top: 0.0em;">





    <div class="table-responsive">
      <table id="example" class="table table-bordered table-hover display" style="width:100%">
        <thead>
          <tr>
            <th>English Name</th>
            <th>Arabic Name</th>
            <th>Parent Name</th>
            <th>unit</th>
            <th>amount</th>
            <th>Status</th>
            <td>Actions</td>
          </tr>
        </thead>

        <tbody>
          @foreach ($forms as $form)
          <tr role="row" class="odd">
            <td>{{ $form->en_name }}</td>
            <td>{{ $form->ar_name }}</td>
            <td>{{ $form->parent_en_name }}</td>
            <td>{{ $form->form_unit}}</td>
            <td>{{ $form->amount }}</td>
            <td>{{ $form->status_en_name}}</td>
            <td>
              <form  method="POST" action="{{ route('form.destroy', ['id' => $form->id]) }}" onsubmit = "return confirm('Are you sure?')">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <a href="{{ route('form.edit', ['id' => $form->id]) }}" class="btn btn-primary btn-sm"  target="_blank"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
<script src={{ asset("js/alaa/jquery-3.3.1.js")}}></script>
<script src={{ asset("js/alaa/jquery.dataTables.min.js")}}></script>
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
  @endsection

