@extends('drugAdministration.leaflets.base')

@section('action-content')

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


        <form class="form-horizontal" role="form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">Leaflet Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" data-parsley-trigger="change" required="" placeholder="Enter Name" class="form-control" id="name"  value="{{$leaflet->name}}"  readonly="">
                </div>
            </div>

            <div class="row">
               <div class="col-md-6 mb-3">
                    <label for="note" >leaflet English</label>
                    <div>
                        <textarea type="text" id="en_leaflet"  name="en_leaflet" placeholder="Enter Leaflet English " class="form-control" readonly="" >{{$leaflet->en_leaflet}}</textarea>
                    </div>
                </div>

            <div class="col-md-6 mb-3">
                    <label for="note" >leaflet Arabic</label>
                    <div>
                        <textarea type="text" id="ar_leaflet"  name="ar_leaflet" placeholder="Enter Leaflet Arabic" class="form-control" readonly="">{{$leaflet->ar_leaflet}}</textarea>
                    </div>
                </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label" for="company">Company</label>
                
                    <input type="text" name="company" data-parsley-trigger="change"  placeholder="Enter company" class="form-control" id="company"  value="{{$leaflet->company_en_name}}"  readonly="">
                
            </div>    
            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label" for="status">Status</label>
                
                    <input type="text" name="status" data-parsley-trigger="change"  placeholder="Enter status" class="form-control" id="status"  value="{{$leaflet->status_en_name}}"  readonly="">
                
            </div>
        </div>

          <div class="form-group text-right m-b-0">
            <a class="btn btn-secondary m-l-5" href ="{{route('leaflet.index')}}">
                Cancel
            </a>
        </div>

    </form>

</div>                                                      
<!-- end card-->                  
</div>

<!-- BEGIN Java Script for this page -->
<script src={{asset("assets/plugins/parsleyjs/parsley.min.js")}}></script>
<script>
    $('#form').parsley();
</script>

@endsection

