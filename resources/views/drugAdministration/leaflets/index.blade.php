@extends('drugAdministration.leaflets.base')
@section('action-content')
<script src="{{ asset('/assets/js/jquery.min.js') }}" type="text/javascript"></script>
 <!--NOTE
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
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
    <i class="fa fa-tint bigfonts" aria-hidden="true"></i> All leaflets ({{$count}})  
    <span class="pull-right">
      <a  class="btn btn-outline-info btn-sm" href="{{ route('leaflet.index') }}"><i class="fa fa-refresh bigfonts" aria-hidden="true"></i> </a>
     <!-- <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Export</a>
      <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import</a>-->
      <a class="btn btn-primary btn-sm" href="{{ route('leaflet.create') }}" target="_blank"><i class="fa fa-plus bigfonts" aria-hidden="true"></i> Add new leaflet</a>
    </span>              
  </div>   

  <div class="card-body">
      <div class="row" style="margin-bottom: 0.0em;">
            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 col-xl-2"> 
                    <label for="name">Leaflet Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" data-parsley-trigger="change" required="" placeholder="Enter Name" class="form-control" id="name"   >
                    <div class="invalid-feedback">
                        Please enter a english name.
                    </div>

                    <label  for="company">Company</label>
                    <select class="form-control select2" name="company_id">
                      <option ></option>
                    </select>

                    <label  for="status">Status</label>
                    <select class="form-control" name="status_id">
                      <option></option>
                    </select> 
            </div>
            <div class="col-xs-10 col-sm-10 col-md-8 col-lg-8 col-xl-8">
                    <label for="note" >leaflet English</label>
                    <div style="display:block;overflow:auto;height:115px;width:100%;">
                      {{ csrf_field() }}
                        <textarea type="text" id="en_leaflet"  name="en_leaflet" placeholder="Enter Leaflet English " class="form-control summernote"></textarea>
                    </div>

                    <label for="note" >leaflet Arabic</label>
                    <div style="display:block;overflow:auto;height:115px;width:100%;">
                      {{ csrf_field() }}
                        <textarea type="text" id="ar_leaflet"  name="ar_leaflet" placeholder="Enter Leaflet Arabic" class="form-control summernote"></textarea>
                    </div>
            </div>
            <div class="col-md-2 mb-2">                      

                        <button id="EditButton" type="button" class="btn btn-outline-success btn-lg" > submit </button>      
            </div>
      </div>



  <hr style="border-style: inset; border-width: 5px;margin-top: 0.0em;">



    <div class="table-responsive">
      <table id="example" class="table table-bordered table-hover display" style="width:100%">
        <thead>
          <tr>
            <th>English Name</th>
            <th>Company Name</th>
            <th>Status</th>
            <td>Action</td>
          </tr>
        </thead>

        <tbody>
          @foreach ($leaflets as $leaflet)
          <tr role="row" class="odd">
            <td>{{ $leaflet->name }}</td>
            <td>{{ $leaflet->company_en_name }}</td>
            <td>{{ $leaflet->status_en_name}}</td>
            <td>
              <form  method="POST" action="{{ route('leaflet.destroy', ['id' => $leaflet->id]) }}" onsubmit = "return confirm('Are you sure?')">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a role="button" href="{{ route('leaflet.show', ['id' => $leaflet->id]) }}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-eye bigfonts"></i></a>
                <a href="{{ route('leaflet.edit', ['id' => $leaflet->id]) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>
                </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>




<!-- BEGIN Java Script for this page -->
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
</script>
<!--NOTE-->
<script>
    $(document).ready(function() {
        $('#ar_leaflet').summernote();
        $('#en_leaflet').summernote();
    });
</script>
@endsection