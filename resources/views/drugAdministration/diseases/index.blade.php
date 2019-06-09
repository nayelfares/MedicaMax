@extends('drugAdministration.diseases.base')

@section('action-content')

   

<div class="card mb-3"> 

  <div class="card-header">
    <i class="fa fa-braille bigfonts" aria-hidden="true"></i> All Disease ({{$count}})
    <span class="pull-right">
      <a  class="btn btn-outline-info btn-sm" href="{{ route('disease.index') }}"><i class="fa fa-refresh bigfonts" aria-hidden="true"></i> </a>
      
      <a class="btn btn-primary btn-sm" href="{{route('disease.draw_tree_ar')}}" target="_blank"><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Draw</a>
      <a class="btn btn-primary btn-sm" href="{{route('disease.export')}}"><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Export</a>
      <a class="btn btn-primary btn-sm" href="{{route('disease.import_interface')}}" target="_blank"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import</a>
    </span>               
  </div>   


</div>

<!-- BEGIN Java Script for this page -->

  @endsection