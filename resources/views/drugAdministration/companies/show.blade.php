@extends('drugAdministration.companies.base')

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
body {font-family: Arial, Helvetica, sans-serif;}

#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
} 

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
* {
    box-sizing: border-box;
}

.column {
    float: left;
    width: 33.3%;
    padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
    content: "";
    clear: both;
    display: table;
}

.containerButtonInImg {
    position: relative;
    width: 100%;
    max-width: 400px;
}

.containerButtonInImg img {
    width: 100%;
    height: auto;
}

.containerButtonInImg .btn {
   position: absolute;
   top: 92%;
   left: 88%;
   transform: translate(-50%, -50%);
   -ms-transform: translate(-50%, -50%);
   background-color: white;
   color: red;
   font-size: 16px;
   padding: 8px 15px;
   border: none;
   cursor: pointer;
   border-radius: 8px;
   text-align: center;
}

.containerButtonInImg .btn:hover {
    background-color: black;
}
</style>
<!-- END CSS for this page -->
<div class="card mb-3">
    <div class="card-body">
        <div class="alert alert-success" role="alert">
        </div>

        <form  enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="en_name">Company English Name<span class="text-danger">*</span></label>
                    <input type="text" name="en_name" data-parsley-trigger="change" required="" placeholder="Enter English Name" class="form-control" id="en_name"  value="{{ $company->en_name }}"  readonly="" >
                    <div class="invalid-feedback">
                        Please enter a english name.
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="col-md-4 control-label" for="status">Company Arabic Name</label>
                    <input type="text" name="ar_name" data-parsley-trigger="change" placeholder="Enter Arabic Name" class="form-control" id="ar_name" value="{{ $company->ar_name }}"      readonly="">
                    <div class="invalid-feedback">
                        Please enter a english name.
                    </div>
                </div>
            </div>

            <div class="row">
             <div class="col-md-6 mb-3">
                <label for="note" >Company English Article</label>
                <div>
                    <textarea type="text" id="en_article"  name="en_article" placeholder="Enter Company English Article" class="form-control" readonly="">{{$company->en_article}}</textarea>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="note" >Company Arabic Article</label>
                <div>
                    <textarea type="text" id="ar_article"  name="ar_article" placeholder="Enter Company Arabic Article" class="form-control" readonly="">{{$company->ar_article}}</textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label" for="status">Company Location</label>
                <input type="text" name="location" data-parsley-trigger="change" placeholder="Enter Company Location" class="form-control" id="location"  value="{{$company->location}}" readonly="">
                <div class="invalid-feedback">
                    Please enter a english name.
                </div>
            </div>    
            <div class="col-md-6 mb-3">
                <label class="col-md-4 control-label" for="status">Status</label>
                <input type="text" name="status" data-parsley-trigger="change" placeholder="Enter Company Location" class="form-control" id="status"  value="{{$company->status_en_name}}" readonly="">         
            </div>
        </div>

        <!--logo -->
        <div class="form-group">
            <label for="upload" class="col-md-4 control-label" >company logo</label>
            <div class="col-md-6">
                @if(!empty($company->company_logo))
                <img src="../../../images/company_logo/{{$company->company_logo}}" width="150px" height="150px"/>
                @endif
            </div>
        </div>


        <!--image-->
        <label for="upload" class="col-md-4 control-label" >Company Pictures</label>
        <div class="row">
            @foreach($pictures as $picture)
            <div class="column">
                <div class="containerButtonInImg">
                    <img id="{{$picture->title}}" src="../../../images/company/{{$picture->title}}" alt="Snow" style="width:100%">

                    </div>
                </div>
                @endforeach
            </div>

            
            





            <div class="form-group text-right m-b-0">
                </button>
                <a class="btn btn-secondary m-l-5" href ="{{route('company.index')}}">
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


