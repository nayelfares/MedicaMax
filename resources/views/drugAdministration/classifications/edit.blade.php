@extends('drugAdministration.classifications.base')
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
<!-- END CSS for this page -->
<div class="card mb-3">
    <div class="card-body">
        <div class="alert alert-success" role="alert">
        </div>

        <form  method="POST" action="{{ route('classification.update', ['id' => $classification->id]) }}" data-parsley-validate novalidate>
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="en_name">Classification Code<span class="text-danger">*</span></label>
                    <input type="text" name="code" data-parsley-trigger="change" required="" placeholder="Enter Code" class="form-control" id="code"  value="{{ $classification->code  }}"  autofocus >
                    <div class="invalid-feedback">
                        Please enter a classification code.
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="col-md-4 control-label" for="status">Parent Classification</label>

                    <select class="form-control select2" name="parent_id">
                        <option >  </option>
                        @foreach ($classifications as $cls)
                            <option value="{{$cls->id}}" {{$cls->id == $classification->parent_id ? 'selected' : ''}}>{{$cls->en_term}}
                        </option>
                        @endforeach
                    </select>
               </div>
           </div>

           <div class="row">
               <div class="col-md-6 mb-3">
                <label for="en_term">Classification English Term<span class="text-danger">*</span></label>
                <input type="text" name="en_term" data-parsley-trigger="change" placeholder="Enter english term" class="form-control" id="en_term" value="{{ $classification->en_term }}"  required autofocus >
            </div>

            <div class="col-md-6 mb-3">
                <label for="ar_term">Classification Arabic Term</label>
                <input type="text" name="ar_term" data-parsley-trigger="change"  placeholder="Enter Arabic term" class="form-control" id="ar_term" value="{{ $classification->ar_term }}">
            </div>
        </div>



        <div class="form-group">
            <label > Daily Doses</label>
            <div class="control-group increment " >
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label >giving</label>
                        <select class="form-control select2" name="giving[]" id="giving">
                            <option ></option>
                            @foreach ($givings as $giving)
                            <option value="{{$giving->id}}">{{$giving->en_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control"  placeholder="amount" name="amount[]" id="amount" type="string">
                    </div>

                    <div class="col-md-1 mb-3">
                        <label >More </label>
                        <button class="btn form-control btn-success" type="button">Add</button>
                    </div>
                </div>
            </div>

            @foreach($daily_doses as $daily_dose)
            <div class="clone hide">
                <div class="control-group">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label >giving</label>
                            <select class="form-control select2" name="giving[]" id="giving">
                                <option >  </option>
                                @foreach ($givings as $giving)
                                <option value="{{$giving->id}}" {{$giving->id == $daily_dose->giving_id ? 'selected' : ''}} >{{$giving->en_name}}</option>
                                        @endforeach
                            </select>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control"  placeholder="amount" name="amount[]" id="amount" type="string" value="{{$daily_dose->amount}}">
                        </div>

                        <div class="col-md-1 mb-3">
                            <label >less </label>
                            <button class="btn form-control btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i>Remove</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach



        </div>

        <div class="form-group">
            <label for="note" >Classification Note</label>
            <div>
                <textarea type="text" id="note"  name="note" placeholder="Enter Notes" class="form-control" >{{$classification->note}}</textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label" for="classification_level">Classification Level</label>
                <select class="form-control" name="classification_level">
                    <option value="{{ $classification->classification_level }}">{{ $classification->classification_level }}</option>
                    <option></option>
                    <option value="1" >1</option>
                    <option value="2" >2</option>
                    <option value="3" >3</option>
                    <option value="4" >4</option>
                    <option value="5" >5</option>

                </select>
            </div>                                 




            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label" for="status">Status</label>
                <select class="form-control" name="status_id">
                    @foreach ($status as $stat)
                        <option value="{{$stat->id}}" {{$stat->id == $classification->status_id ? 'selected' : ''}}>{{$stat->en_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>



        <div class="form-group text-right m-b-0">
            <button class="btn btn-primary" type="submit">
                Submit
            </button>
            <a class="btn btn-secondary m-l-5" href ="{{route('classification.index')}}">
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

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

       $('.select2').select2();
  });
</script>

@endsection





