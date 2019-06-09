@extends('drugAdministration.companies.base')

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
<!-- END CSS for this page -->
<div class="card mb-3">
    <div class="card-body">
        <div class="alert alert-success" role="alert">
        </div>

        <form method="POST"  action="{{ route('company.store') }}" data-parsley-validate novalidate>
            {{  csrf_field() }}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="en_name">Company English Name<span class="text-danger">*</span></label>
                    <input type="text" name="en_name" data-parsley-trigger="change" required="" placeholder="Enter English Name" class="form-control" id="en_name"   >
                    <div class="invalid-feedback">
                        Please enter a english name.
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="col-md-4 control-label" for="status">Company Arabic Name</label>
                    <input type="text" name="ar_name" data-parsley-trigger="change" placeholder="Enter Arabic Name" class="form-control" id="ar_name"   >
                    <div class="invalid-feedback">
                        Please enter a english name.
                    </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6 mb-3">
                    <label for="note" >Company English Article</label>
                    <div>
                        <textarea type="text" id="en_article"  name="en_article" placeholder="Enter Company English Article" class="form-control"></textarea>
                    </div>
                </div>

            <div class="col-md-6 mb-3">
                    <label for="note" >Company Arabic Article</label>
                    <div>
                        <textarea type="text" id="ar_article"  name="ar_article" placeholder="Enter Company Arabic Article" class="form-control"></textarea>
                    </div>
                </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                    <label class="col-md-4 control-label" for="status">Company Location</label>
                    <input type="text" name="location" data-parsley-trigger="change" placeholder="Enter Company Location" class="form-control" id="location"   >
                    <div class="invalid-feedback">
                        Please enter a english name.
                    </div>
               </div>    
            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label" for="status">Status</label>
                <select class="form-control" name="status_id">
                    <option></option>
                    @foreach ($status as $stat)
                    <option value="{{$stat->id}}" >{{$stat->en_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!--logo -->
                        <div class="form-group">
                            <label for="avatar" class="col-md-4 control-label" >company logo</label>
                            <div class="col-md-6">
                                <input type="file" id="company_logo" name="company_logo"  >
                            </div>
                        </div>
                        <!--image-->
                         <div >
                        <label class="col-md-4 control-label">Pictures</label>
                            
                                <div class="control-group increment" >
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="file" name="pictures[]" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <button class="btn btn-success " type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                        </div>
                                    </div>
                                </div>

                            
                                <div class="clone" >
                                    <div  class="row control-group">
                                        <div class="col-md-6 mb-3">
                                            <input type="file" name="pictures[]" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                    </div>
                                </div>

                    </div> 





        <div class="form-group text-right m-b-0">
            <button class="btn btn-primary" type="submit">
                Submit
            </button>
            <a class="btn btn-secondary m-l-5" href ="{{route('company.index')}}">
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
<!-- script to repeter anter daily dose -->
<script type="text/javascript">

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




