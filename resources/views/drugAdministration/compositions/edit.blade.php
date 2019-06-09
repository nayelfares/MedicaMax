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

        <form  method="POST" action="{{ route('composition.update', ['id' => $composition->id]) }}" data-parsley-validate novalidate>
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">


            <div class="form-group">
                <label for="en_name">Composition English Name<span class="text-danger">*</span></label>
                <input type="text" name="en_name" data-parsley-trigger="change" required placeholder="Enter english term" class="form-control" id="en_name" value="{{ $composition->en_name }}" >
            </div>

            <div class="form-group">
                <label for="ar_name">Composition Arabic Name</label>
                <input type="text" name="ar_name" data-parsley-trigger="change"  placeholder="Enter Arabic term" class="form-control" id="ar_name" value="{{ $composition->ar_name }}">
            </div>

             <div class="form-group">
                <label >Old Composition Quantity</label>
                @foreach($quantities as $quantity)
                <div class="clone hide">
                    <div class="control-group">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="quantity">Quantity</label>
                                <input name="new_quantities[]"  value="{{$quantity->quantity}}" type="string" class="form-control"   readonly>
                            </div>

                            <div class="col-md-1 mb-3">
                                <label >less </label>
                                <button class="btn form-control btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i>Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="old_quantities[]" value="{{$quantity->quantity}}"/>
            @endforeach       
            </div>

            <div class="form-group">
                <label >New Composition Quantity</label>
                <div class="control-group increment " >
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="quantity">Quantity</label>
                            <input type="text" class="form-control"  placeholder="quantity" name="new_quantities[]" id="new_quantities" type="string">
                        </div>
                        <div class="col-md-1 mb-3">
                            <label >More </label>
                            <button class="btn form-control btn-success" type="button">Add</button>
                        </div>
                    </div>
                </div>

                <div class="clone hide">
                    <div class="control-group">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="quantity">Quantity</label>
                                <input type="text" class="form-control"  placeholder="quantity" name="new_quantities[]" id="new_quantities" type="string">
                            </div>

                            <div class="col-md-1 mb-3">
                                <label >less </label>
                                <button class="btn form-control btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i>Remove</button>
                            </div>
                        </div>
                    </div>
                </div>       
            </div> 









            <div class="form-group">
                <label class="col-md-4 control-label" for="status">Status</label>
                    <select class="form-control" name="status_id">
                        @foreach ($status as $stat)
                            <option value="{{$stat->id}}" {{$stat->id == $composition->status_id ? 'selected' : ''}}>{{$stat->en_name}}</option>
                        @endforeach
                    </select>
            </div>


            <div class="form-group text-right m-b-0">
                <button class="btn btn-primary" type="submit">
                    Submit
                </button>
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

