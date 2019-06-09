@extends('drugAdministration.classifications.base')

@section('action-content')

   

<div class="card mb-3"> 

  <div class="card-header">
    <i class="fa fa-braille bigfonts" aria-hidden="true"></i> All Classification ({{$count}})
    <span class="pull-right">
      <a  class="btn btn-outline-info btn-sm" href="{{ route('classification.index') }}"><i class="fa fa-refresh bigfonts" aria-hidden="true"></i> </a>
 <!--     <a class="btn btn-primary btn-sm" href="{{route('classification.draw')}}" target="_blank"><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Draw</a>-->
      
      <a class="btn btn-primary btn-sm" href="{{route('classification.draw_tree3')}}" target="_blank"><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Draw</a>
      <a class="btn btn-primary btn-sm" href="{{route('classification.export')}}"><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Export</a>
      <a class="btn btn-primary btn-sm" href="{{route('classification.import_interface')}}" target="_blank"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import</a>
      <a class="btn btn-primary btn-sm" href="{{route('classification.create') }}" target="_blank"><i class="fa fa-plus bigfonts" aria-hidden="true"></i> Add new Classification</a>
    </span>               
  </div>   

 
</div>

<!-- BEGIN Java Script for this page -->
<script src={{ asset("js/alaa/jquery-3.3.1.js")}}></script>
<script src={{ asset("js/alaa/jquery.dataTables.min.js")}}></script>
<link  href="{{ asset('/js/alaa/jquery.dataTables.min.css')}}" type="text/css" />

<script>
  // START CODE FOR BASIC DATA TABLE 
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