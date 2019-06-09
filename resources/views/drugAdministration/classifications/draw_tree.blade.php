<!DOCTYPE html>
<html lang="en">
<head>
    <!--
         Switchery css 
        <link href="{{ asset('/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet" />
         Bootstrap CSS 
        <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        
         Font Awesome CSS 
        <link href="{{ asset('/assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        
         Custom CSS 
        <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

        
 
    <script src="{{ asset('/assets/tree/jquery.min.js')}}" ></script>
    <link rel="stylesheet" href="{{ asset('/assets/tree/style.min.css')}}" />
    <script src="{{ asset('/assets/tree/jstree.min.js')}}"></script>

    NOTE
    <link href="{{ asset('/assets/tree/bootstrap.css') }}" rel="stylesheet">
  <script src="{{ asset('/assets/tree/bootstrap.js') }}"></script>   
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
  choice
  <script src="{{ asset('/assets/tree/bootstrap-toggle.min.js') }}"></script>
  <link href="{{ asset('/assets/tree/bootstrap-toggle.min.css') }}" rel="stylesheet"> -->
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/themes/default/style.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/jstree.min.js"></script>
</head>
<body>

<div>
	<input type="text" id="plugins4_q" value="" class="input" style="margin:0em auto 1em auto; display:block; padding:4px; border-radius:4px; border:1px solid silver;">
<div id="container"></div>
</div>
</body>
<script type="text/javascript">
$(document).ready(function(){ 
     $.ajax({
            type :'GET',
            url : "{{route('classification.build_tree')}}", 
            success:function(jsonData){
                tree = JSON.parse(jsonData);
                $('#container').jstree({
                'plugins': ["wholerow", "checkbox", "dnd", "state", "themes", "json_data", "ui", "contextmenu"],
                'core' : {
                        'data' : tree
                        }
                });
            }
        });

});

</script>




</html>