@extends('drugAdministration.leaflets.base')

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
<div class="card mb-3">
    <div class="card-body">
        <div class="alert alert-success" role="alert">
        </div>


        <form class="form-horizontal" role="form" method="POST" action="{{ route('leaflet.update', ['id' => $leaflet->id]) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">Leaflet Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" data-parsley-trigger="change" required="" placeholder="Enter Name" class="form-control" id="name"  value="{{$leaflet->name}}" >
                    <div class="invalid-feedback">
                        Please enter a english name.
                    </div>
                </div>
            </div>

            <div class="row">
               <div class="col-md-6 mb-3">
                    <label for="note" >leaflet English</label>
                    <div>
                        <textarea type="text" id="en_leaflet"  name="en_leaflet" placeholder="Enter Leaflet English " class="form-control">{{$leaflet->en_leaflet}}</textarea>
                    </div>
                </div>

            <div class="col-md-6 mb-3">
                    <label for="note" >leaflet Arabic</label>
                    <div>
                        <textarea type="text" id="ar_leaflet"  name="ar_leaflet" placeholder="Enter Leaflet Arabic" class="form-control">{{$leaflet->ar_leaflet}}</textarea>
                    </div>
                </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label" for="company">Company</label>
                <div class="col-md-6">
                                <select class="form-control select2" name="company_id">
                                     <option ></option>
                                    @foreach ($companies as $company)
                                        <option value="{{$company->id}}" {{$company->id == $leaflet->company_id ? 'selected' : ''}}>{{$company->en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
            </div>    
            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label" for="status">Status</label>
                <select class="form-control" name="status_id">
                                    @foreach ($status as $stat)
                                        <option value="{{$stat->id}}" {{$stat->id == $leaflet->status_id ? 'selected' : ''}}>{{$stat->en_name}}</option>
                                    @endforeach
                                </select>
            </div>
        </div>

          <div class="form-group text-right m-b-0">
            <button class="btn btn-primary" type="submit">
                update
            </button>
            <a class="btn btn-secondary m-l-5" href ="{{route('leaflet.index')}}">
                Cancel
            </a>
        </div>

    </form>

</div>                                                      
<!-- end card-->                  
</div>

<!-- BEGIN Java Script for this page -->
<script src="{{asset('/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<script>
    $('#form').parsley();
</script>
<!-- script to repeter anter daily dose -->
<script type="text/javascript">

    $(document).ready(function() {

       $('.select2').select2();
  });
</script>

@endsection

