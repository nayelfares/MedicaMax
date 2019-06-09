@extends('drugAdministration.companies.base')

@section('action-content') 
 
<div class="card mb-3"> 

  <div class="card-header">
    <i class="fa fa-university bigfonts" aria-hidden="true"></i> All Companies ({{$count}})  
    <span class="pull-right">
      <a  class="btn btn-outline-info btn-sm" href="{{ route('company.index') }}"><i class="fa fa-refresh bigfonts" aria-hidden="true"></i> </a>
      <a class="btn btn-primary btn-sm" href="{{route('company.export')}}"><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Export</a>
      <a class="btn btn-primary btn-sm" href="{{route('company.import_interface')}}" target="_blank"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import</a>
      <a class="btn btn-primary btn-sm" href="{{ route('company.create') }}" target="_blank"><i class="fa fa-plus bigfonts" aria-hidden="true"></i> Add new company</a>
    </span>               
  </div>   

  <div class="card-body">
    <div class="table-responsive">
      <table id="example" class="table table-bordered table-hover display" style="width:100%">
        <thead>
          <tr>
            <th>English Name</th>
            <th>Arabic Name</th>
            <th>Location</th>
            <th>Status</th>
            <td>Action</td>
          </tr>
        </thead>

        <tbody>
          @foreach ($companies as $company)
          <tr role="row" class="odd">
            <td>{{ $company->en_name }}</td>
            <td>{{ $company->ar_name }}</td>
            <td>{{ $company->location }}</td>
            <td>{{ $company->status_en_name}}</td>
            <td>
              <form  method="POST" action="{{ route('company.destroy', ['id' => $company->id]) }}" onsubmit = "return confirm('Are you sure?')">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a role="button" href="{{ route('company.show', ['id' => $company->id]) }}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-eye bigfonts"></i></a>
                <a href="{{ route('company.edit', ['id' => $company->id]) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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


</script>
@endsection




