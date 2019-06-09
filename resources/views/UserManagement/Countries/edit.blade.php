@extends('UserManagement.Countries.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update country</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('country.update', ['id' => $country->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="form-group{{ $errors->has('en_name') ? ' has-error' : '' }}">
                            <label for="en_name" class="col-md-4 control-label">country English Name</label>

                            <div class="col-md-6">
                                <input id="en_name" type="text" class="form-control" name="en_name" value="{{ $country->en_name }}" required autofocus>

                                @if ($errors->has('en_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('en_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                            <label for="ar_name" class="col-md-4 control-label">country Arabic Name</label>

                            <div class="col-md-6">
                                <input id="ar_name" type="text" class="form-control" name="ar_name" value="{{ $country->ar_name }}" >

                                @if ($errors->has('ar_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ar_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status_id">
                                    @foreach ($status as $stat)
                                        <option value="{{$stat->id}}" {{$stat->id == $country->status_id ? 'selected' : ''}}>{{$stat->en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
