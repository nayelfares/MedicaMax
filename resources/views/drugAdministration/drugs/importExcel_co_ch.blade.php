@extends('drugAdministration.drugs.base')

@section('action-content')
<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">                       
                <div class="card mb-3">
                    <div class="card-header">
                        <h3><i class="fa fa-file"></i> Import Chemical Compositions</h3>
                    </div> 
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('chemical_Composition.import') }}" files="true" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <!--excel file-->
                        <div class="form-group">
                            <label  class="col-md-4 control-label" >Excel file</label>
                            <div class="col-md-6">
                                <input type="file" id="file" name="file" required >
                            </div>
                        </div>
                        <!-- -->
                        <div class="form-group">
                            <div class="form-group text-right m-b-0">
                                <button type="submit" class="btn btn-primary">
                                    Import
                                </button>
                                <a class="btn btn-secondary m-l-5" href ="{{ route('chemical_Composition.import') }}">
                                Cancel
                            </a>
                            </div>
                        </div>
                    </form>                                                     
                </div><!-- end card-->                  
            </div>
        </div>
    </div>
</div>


<!-- App js -->
<script src={{asset("assets/js/pikeadmin.js")}}></script>
<script src={{asset("assets/plugins/jquery.filer/js/jquery.filer.min.js")}}></script>
<script type="text/javascript">
$(document).ready(function(){

    'use-strict';

    //Example 2
    $('#file').filer({
        limit: 1,
        maxSize: 20,
        extensions: ['xls', 'xsls'],
        changeInput: true,
        showThumbs: true,
        addMore: true
    });
});
</script>
@endsection


