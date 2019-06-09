@extends('drugAdministration.compositions.base')

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

        <form  data-parsley-validate novalidate>


            <div class="form-group">
                <label for="en_name">Composition English Name<span class="text-danger">*</span></label>
                <input type="text" name="en_name" data-parsley-trigger="change" required placeholder="Enter english term" class="form-control" id="en_name" value="{{ $composition->en_name }}" readonly="" 
                 >
            </div>

            <div class="form-group">
                <label for="ar_name">Composition Arabic Name</label>
                <input type="text" name="ar_name" data-parsley-trigger="change"  placeholder="Enter Arabic term" class="form-control" id="ar_name" value="{{ $composition->ar_name }}" readonly="">
            </div>

             <div class="form-group">
                <label >Composition Quantity</label>
                @foreach($quantities as $quantity)
                <div class="clone hide">
                    <div class="control-group">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="quantity">Quantity</label>
                                <input name="new_quantities[]"  value="{{$quantity->quantity}}" type="string" class="form-control"   readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="old_quantities[]" value="{{$quantity->quantity}}"/>
            @endforeach       
            </div>


            <div class="form-group">
                <label class="col-md-4 control-label" for="status">Status</label>
                <input name="status"  value="{{$composition->status_en_name}}" type="string" class="form-control"   readonly>  
            </div>


            <div class="form-group text-right m-b-0">
                <a class="btn btn-secondary m-l-5" href ="{{route('composition.index')}}">
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



