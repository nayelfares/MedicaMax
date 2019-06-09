@extends('drugAdministration.units.base')

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



            <form method="POST"  action="{{ route('unit.update', ['id' => $unit->id]) }}" data-parsley-validate novalidate>

                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="en_name">English Unit Name<span class="text-danger">*</span></label>
                    <input type="text" name="en_name" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="en_name" value="{{ $unit->en_name }}" >
                </div>
                <div class="form-group">
                    <label for="ar_name">Arabic Unit Name</label>
                    <input type="text" name="ar_name" data-parsley-trigger="change"  placeholder="Enter Arabic unit name" class="form-control" id="ar_name" value="{{ $unit->ar_name }}" >
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="status">Status</label>
                    <select class="form-control" name="status_id">
                        <option></option>
                        @foreach ($status as $stat)
                        <option value="{{$stat->id}}" {{$stat->id == $unit->status_id ? 'selected' : ''}}>{{$stat->en_name}}</option>
                        @endforeach
                    </select>
                </div>



                <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary" type="submit">
                        Submit
                    </button>
                    <a class="btn btn-secondary m-l-5" href ="{{route('unit.index')}}">
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







