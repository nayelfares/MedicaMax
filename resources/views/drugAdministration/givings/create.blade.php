 @extends('drugAdministration.givings.base')

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
            <!--Header-->
            <div class="alert alert-success" role="alert">
            </div>
            <!-- Body -->
            <form  method="POST"  action="{{ route('giving.store') }}" data-parsley-validate novalidate>
                {{ csrf_field() }}


                <div class="form-group">
                    <label for="en_name">English giving Name<span class="text-danger">*</span></label>
                    <input type="text" name="en_name" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="en_name">
                </div>
                <div class="form-group">
                    <label for="ar_name">Arabic giving Name</label>
                    <input type="text" name="ar_name" data-parsley-trigger="change"  placeholder="Enter Arabic giving name" class="form-control" id="ar_name"  >
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="status">Status</label>
                    <select class="form-control" name="status_id">
                        <option></option>
                        @foreach ($status as $stat)
                        <option value="{{$stat->id}}">{{$stat->en_name}}</option>
                        @endforeach
                    </select>
                </div>



                <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary" type="submit">
                        Create
                    </button>
                    <a class="btn btn-secondary m-l-5" href ="{{route('giving.index')}}">
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