@extends('drugAdministration.forms.base')
 
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

            <form method="POST"  action="{{ route('form.store') }}" data-parsley-validate novalidate>
                {{  csrf_field() }}


                <div class="form-group">
                    <label for="en_name">English Form Name<span class="text-danger">*</span></label>
                    <input type="text" name="en_name" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="en_name"  >
                </div>

                <div class="form-group">
                    <label for="ar_name">Arabic Form Name</label>
                    <input type="text" name="ar_name" data-parsley-trigger="change"  placeholder="Enter Arabic form name" class="form-control" id="ar_name" >
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="parent_id">Parent Form</label>
                    <select class="form-control select2" name="parent_id">
                       <option value="">  </option>
                       @foreach ($forms as $form)
                       <option value="{{$form->id}}">{{$form->en_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="ar_name">Form Unit</label>
                    <input type="text" name="form_unit" data-parsley-trigger="change"  placeholder="Enter Arabic form name" class="form-control" id="form_unit" >
                </div>

                <div class="form-group">
                    <label for="ar_name">Amount</label>
                    <input type="text" name="amount" data-parsley-trigger="change"  placeholder="Enter Arabic form name" class="form-control" id="amount" >
                </div>



                <div class="form-group">
                    <label class="col-md-4 control-label" for="status">Status</label>
                    <select class="form-control" name="status_id">
                        <option></option>
                        @foreach ($status as $stat)
                        <option value="{{$stat->id}}" >{{$stat->en_name}}</option>
                        @endforeach
                    </select>
                </div>



                <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary" type="submit">
                        Submit
                    </button>
                    <a class="btn btn-secondary m-l-5" href ="{{route('form.index')}}">
                        Cancel
                    </a>
                </div>

            </form>

        </div>                                                      
        <!-- end card-->                  
    </div>

    <!-- BEGIN Java Script for this page -->
   <!-- BEGIN Java Script for this page -->
<script src="{{asset('/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<script>
    $('#form').parsley();

      $(document).ready(function() {


       $('.select2').select2();
  });
</script>
  @endsection
