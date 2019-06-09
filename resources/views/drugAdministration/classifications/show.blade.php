  @extends('drugAdministration.classifications.base')
  @section('action-content')
 <script <script src={{asset("/js/alaa/jquery.js")}}></script>
  <!--Switchery css -->
<!--  <link href={{asset("assets/plugins/switchery/switchery.min.css")}} rel="stylesheet" /> 
     <script src={{asset("assets/js/modernizr.min.js")}}></script> 
    <script src={{asset("assets/js/jquery.min.js")}}></script>
    <script src={{asset("assets/js/moment.min.js")}}></script> -->
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
			
			<div class="row">

				<div class="col-md-6 mb-3">
					<label for="en_name">Classification Code<span class="text-danger">*</span></label>
					<input type="text" name="code" data-parsley-trigger="change" required=""  class="form-control" id="code"  value="{{ $classification->code  }}"  readonly="" >
				</div>

				<div class="col-md-6 mb-3">
					<label class="col-md-4 control-label" for="status">Parent Classification</label>
					<input type="text" name="code" data-parsley-trigger="change" required=""  class="form-control" id="code"  value="{{ $classification->parent_en_term  }}"  readonly="" >

					
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="en_term">Classification English Term<span class="text-danger">*</span></label>
					<input type="text" name="en_term" data-parsley-trigger="change" class="form-control" id="en_term" value="{{ $classification->en_term }}"  readonly="">
				</div>

				<div class="col-md-6 mb-3">
					<label for="ar_term">Classification Arabic Term</label>
					<input type="text" name="ar_term" data-parsley-trigger="change"   class="form-control" id="ar_term" value="{{ $classification->ar_term }}" readonly="">
				</div>
			</div>



			<div class="form-group">
				<label > Daily Doses</label>
				@foreach($daily_doses as $daily_dose)
				<div class="clone hide">
					<div class="control-group">
						<div class="row">
							<div class="col-md-6 mb-3">
								<label >giving</label>
								<input type="text" class="form-control"   name="giving[]" id="giving" type="string" value="{{$daily_dose->giving_en_name}}" readonly="">
							</div>

							<div class="col-md-6 mb-3">
								<label for="amount">Amount</label>
								<input type="text" class="form-control"   name="amount[]" id="amount" type="string" value="{{$daily_dose->amount}}" readonly="">
							</div>
						</div>
					</div>
				</div>
				@endforeach



			</div>

			<div class="form-group">
				<label for="note" >Classification Note</label>
				<div>
					<textarea type="text" id="note"  name="note"  class="form-control" readonly="">{{$classification->note}}</textarea>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 mb-3">
					<label class="col-md-4 control-label" for="classification_level">Classification Level</label>
					<input type="text" name="level" data-parsley-trigger="change"  class="form-control" id="level" value="{{ $classification->classification_level }}" readonly="">
				</div>                                 




				<div class="col-md-6 mb-3">
					<label class="col-md-4 control-label" for="status">Status</label>
					<input type="text" name="status" data-parsley-trigger="change"  class="form-control" id="status" value="{{ $classification->status_en_name }}" readonly="">
				</div>
			</div>



			<div class="form-group text-right m-b-0">
				
				<a class="btn btn-secondary m-l-5" href ="{{route('classification.index')}}">
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


@endsection





