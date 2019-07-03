@extends('drugAdministration.styles.base')

@section('action-content')
<script src="{{asset('/js/alaa/jquery.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('/assets/font-awesome/fonts/New Fonts.css')}}">
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

        /* Create a custom checkbox */
            /* The container */
            .container {
              display: block;
              position: relative;
              padding-left: 35px;
              margin-bottom: 12px;
              cursor: pointer;
              font-size: 22px;
              -webkit-user-select: none;
              -moz-user-select: none;
              -ms-user-select: none;
              user-select: none;
            }

            /* Hide the browser's default checkbox */
            .container input {
              position: absolute;
              opacity: 0;
              cursor: pointer;
              height: 0;
              width: 0;
            }

            /* Create a custom checkbox */
            .checkmark {
              position: absolute;
              top: 0;
              left: 0;
              height: 25px;
              width: 25px;
              background-color: #eee;
            }

            /* On mouse-over, add a grey background color */
            .container:hover input ~ .checkmark {
              background-color: #ccc;
            }

            /* When the checkbox is checked, add a blue background */
            .container input:checked ~ .checkmark {
              background-color: #2196F3;
            }

            /* Create the checkmark/indicator (hidden when not checked) */
            .checkmark:after {
              content: "";
              position: absolute;
              display: none;
            }

            /* Show the checkmark when checked */
            .container input:checked ~ .checkmark:after {
              display: block;
            }

            /* Style the checkmark/indicator */
            .container .checkmark:after {
              left: 9px;
              top: 5px;
              width: 5px;
              height: 10px;
              border: solid white;
              border-width: 0 3px 3px 0;
              -webkit-transform: rotate(45deg);
              -ms-transform: rotate(45deg);
              transform: rotate(45deg);
            }
    </style>
    <!-- END CSS for this page -->
    <div class="card mb-3">
        <div class="card-body">
            <!--Header-->
            <div class="alert alert-success" role="alert">
            </div>
            <!-- Body -->
            <form  method="POST"  action="{{ route('style.store') }}" data-parsley-validate novalidate>
                {{ csrf_field() }}

                <div class="form-group row ">
                    <div class="form-group col-md-4 control-label">
                        <label for="style_name">Style Name<span class="text-danger">*</span></label>
                        <input type="text" name="style_name" data-parsley-trigger="change" required placeholder="Enter Style Name" class="form-control" id="style_name">
                    </div>
                    <div class="form-group col-md-4 control-label">
                        <label for="ar_name">Font Size</label>
                        <select class="form-control" name="style_font_size">
                            <option></option>
                            
                            
                            <option style="font-size: 10px;" value="10">10</option>
                            <option style="font-size: 12px;" value="12">12</option>
                            <option style="font-size: 14px;" value="14">14</option>
                            <option style="font-size: 16px;" value="16">16</option>
                            <option style="font-size: 18px;" value="18">18</option>
                            <option style="font-size: 20px;" value="20">20</option>
                            <option style="font-size: 24px;" value="24">24</option>
                            <option style="font-size: 30px;" value="30">30</option>
                            <option style="font-size: 36px;" value="36">36</option>
                            
                        </select>
                    </div>
                    <div class="form-group col-md-4 control-label">
                        <label class="col-md-4 control-label" for="font_family">Font Family</label>
                        <select class="form-control" name="style_font_family">
                            <option></option>
                            <option value="ArefRuqaa-Regular" style="font-family: ArefRuqaa-Regular;font-size:18px">ArefRuqaa</option>
                            <option value="arial" style="font-family: arial;font-size:18px">Arial</option>
                            <option value="Cairo-Regular" style="font-family: Cairo-Regular;font-size:18px">Cairo</option>
                            <option value="Changa-Regular" style="font-family: Changa-Regular;font-size:18px">Changa</option>
                            <option value="CrimsonText-Regular" style="font-family: CrimsonText-Regular;font-size:18px">CrimsonText</option>
                            <option value="EBGaramond-Regular" style="font-family: EBGaramond-Regular;font-size:18px">EBGaramond</option>
                            <option value="Tajawal-Regular" style="font-family: Tajawal-Regular;font-size:18px">Tajawal</option>
                            <option value="timesnewroman" style="font-family: timesnewroman;font-size:18px">Times New Roman</option>
                            
                        </select>
                    </div>
                </div>

                <div class="form-group row col-md-12 control-label">
                    <div class="col-md-2"> 
                        <label class="container">Bold
                            <input type="checkbox"  name="style_bold" id ="style_bold" value="bold">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-2">
                        <label class="container">Italic
                            <input type="checkbox"  name="style_italic" id="style_italic" value="italic">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div  class="col-md-2" >
                        <label class="container">Under line
                            <input type="checkbox"  name="style_under_line" id="style_under_line" value="underline">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-2">
                        <label class="container">Border
                            <input type="checkbox"  name="style_border" id="style_border" value="solid">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-2 control-label">
                        <label class="container" id="text_color_val">Text Color
                            <input type="color" name="style_text_color"  placeholder="Enter Arabic style name" class="form-control" id="style_text_color"  >
                        </label>
                    </div>
                    <div class="form-group col-md-2 control-label">
                        <label class="container" id="background_color_value">Background Color
                            <input type="color" name="style_background_color" class="form-control" id="style_background_color" >
                        </label>
                    </div>
                    
                </div>



                <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary" type="submit">
                        Create
                    </button>
                    <a class="btn btn-secondary m-l-5" href ="{{route('style.index')}}">
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
      
$(document).ready(function(){
        document.getElementById('style_background_color').value = "#ffffff";
        console.log(document.getElementById('style_background_color').value);
        $('#form').parsley();
    });
/*        document.getElementById('italic').value = 'normal';
        document.getElementById('').value = '#ffffff';
        document.getElementById('').value = '#ffffff';
        document.getElementById('').value = '#ffffff';
*/


        var textColorButton = document.getElementById("style_text_color");
        var colorDiv = document.getElementById("text_color_val");
        textColorButton.onchange = function() {
            colorDiv.style.color = textColorButton.value;
        }
        var backgroundColorButton = document.getElementById("style_background_color");
        var backgroundColorDiv = document.getElementById("background_color_value");
        backgroundColorButton.onchange = function() {
            backgroundColorDiv.style.color = backgroundColorButton.value;
        }
  </script>
  @endsection




















