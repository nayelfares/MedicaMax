@extends('drugAdministration.givings.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update giving</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('dailyDose.update', ['id' => $dailyDose->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <!--amount-->
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">daily dose amount</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control" name="amount" value="{{ $dailyDose->amount}}" required autofocus>

                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!--giving -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Giving</label>
                            <div class="col-md-6">
                                <select class="form-control" name="giving_id">
                                    @foreach ($giving as $g)
                                        <option value="{{$g->id}}" {{$g->id == $dailyDose->giving_id ? 'selected' : ''}}>{{$g->en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--arabic name-->
                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="note" class="col-md-4 control-label">daily dose note</label>

                            <div class="col-md-6">
                                <input id="note" type="text" class="form-control" name="note" value="{{ $dailyDose->note}}" required autofocus>

                                @if ($errors->has('note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <!--status -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status_id">
                                    @foreach ($status as $stat)
                                        <option value="{{$stat->id}}" {{$stat->id == $dailyDose->status_id ? 'selected' : ''}}>{{$stat->en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- -->
                        

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
