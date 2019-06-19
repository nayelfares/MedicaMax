@extends('drugAdministration.tags.base')
@section('action-content')
        <!-- BEGIN CSS for this page -->
         <style>
        .panel-heading {
            padding: 0;
        }
        .panel-heading ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .panel-heading li {
            float: left;
            border-right:1px solid #bbb;
            display: block;
            padding: 14px 16px;
            text-align: center;
        }
        .panel-heading li:last-child:hover {
            background-color: #ccc;
        }
        .panel-heading li:last-child {
            border-right: none;
        }
        .panel-heading li a:hover {
            text-decoration: none;
        }

        .table.table-bordered tbody td {
            vertical-align: baseline;
        }
        /* icheck checkboxes */
        .iradio_flat-yellow {
            background: url(https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/yellow.png) no-repeat;
        }
    </style>
<div class="card mb-3"> 

  <div class="card-header">
    <i class="fa fa-tint bigfonts" aria-hidden="true"></i> All tags ({{$count}})  
    <span class="pull-right">
      <a  class="btn btn-outline-info btn-sm" href="{{ route('tag.index') }}"><i class="fa fa-refresh bigfonts" aria-hidden="true"></i> </a>
      <a class="btn btn-primary btn-sm" href="#addTagModal" data-toggle="modal" id="add_tag"><i class="fa fa-plus bigfonts" aria-hidden="true"></i> Add new tag</a>
    </span>              
  </div>

  <div class="card-body" style="margin-top: 0.0em;margin-bottom: 0.0em;">
    <form  method="POST"  action="{{ route('tag.store') }}" data-parsley-validate novalidate>
                {{ csrf_field() }}
        
    </form>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table id="example" class="table table-bordered table-hover display" style="width:100%">
        <thead>
          <tr>
            <th>id</th>
            <th>Code</th>
            <th>Text</th>
            <td>Action</td>
          </tr>
        </thead>

        <tbody>
          @foreach ($tags as $tag)
          <tr role="row" class="odd">
            <td>{{ $tag->id }}</td>
            <td>{{ $tag->code }}</td>
            <td>{{ $tag->tag_text }}</td>
            <td>
             <form  method="POST" action="{{ route('tag.destroy', ['id' => $tag->id]) }}" onsubmit = "return confirm('Are you sure?')">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              
              <a  class="btn btn-primary btn-sm"  href="javascript:void(0)" id="edit-tag" data-id="{{ $tag->id }}"><i class="fa fa-pencil" aria-hidden="true" ></i></a>

              <a href="#editTagModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>




              <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>
                
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>



  <!-- Add Modal HTML -->
  <div id="addTagModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content card mb-3">
        
        <form  method="POST"  action="{{ route('tag.store') }}" data-parsley-validate novalidate>
                {{ csrf_field() }}
          <div class="modal-header">            
            <h4 class="modal-title">Add Tag</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="card-body">
            <div class="form-group">
                <label for="code">Code<span class="text-danger">*</span></label>
                <input type="text" name="code" data-parsley-trigger="change" required placeholder="Enter Code" class="form-control" id="code" value="">

                <label for="tag_text">Text</label>
                <input type="text" name="tag_text" data-parsley-trigger="change" placeholder="Enter Text" class="form-control" id="tag_text" value="">

                <label for="tag_text">Text Color</label>
                <input class="input" type="color" name="text_color" data-parsley-trigger="change"  class="form-control" id="text_color" style=";width: 75px;padding-top: 1px;">
                <input class="input" style="float: right;width: 75px;padding-top: 1px;" type="color" value="#ffffff" id="background_color" name="background_color" > 
                <label for="tag_text" style="float: right;padding-right: 10px;padding-top: 1px;">backgraound color</label><br>

                <input type="checkbox" name="bold" value="1" >  Bold<br>
                <input type="checkbox" name="italic" value="1" >  Italic<br>
                <input type="checkbox" name="under_line" value="1" >  Under line<br>
                <input type="checkbox" name="border" value="1" >  Border<br>
                <input type="checkbox" name="sup_text" value="1" >  Sup text<br>
                <input type="checkbox" name="sub_text" value="1" > Sub Text<br><br>
                
            </div>
        </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-success" value="Add">
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Delete Modal HTML -->
  <div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form>
          <div class="modal-header">            
            <h4 class="modal-title">Delete Employee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <p>Are you sure you want to delete these Records?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-danger" value="Delete">
          </div>
        </form>
      </div>
    </div>
  </div>


</div>
</div>




<!-- BEGIN Java Script for this page -->
<script src={{asset("js/alaa/jquery-3.3.1.js")}}></script>
<script src={{asset("js/alaa/jquery.dataTables.min.js")}}></script>
<link  href="{{ asset('/js/alaa/jquery.dataTables.min.css')}}" type="text/css" />

<script>
  // START CODE FOR BASIC DATA TABLE 
 
  $(document).ready(function() {
      $('#example').DataTable();


      $('#example thead th').each( function () {
          var title = $('#example thead th').eq( $(this).index() ).text();
          $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      } );

      // DataTable
      var table = $('#example').DataTable();

      // Apply the search
      table.columns().eq( 0 ).each( function ( colIdx ) {
          $( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
              table
              .column( colIdx )
              .search( this.value )
              .draw();
          });
      });

  });
/////
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*  When user click add user button */
    $('#add_tag').click(function () {
        $('#btn-save').val("create-user");
        $('#userForm').trigger("reset");
        $('#userCrudModal').html("Add New User");
        $('#ajax-crud-modal').modal('show');
    });
 
   /* When click edit user */
    $('body').on('click', '#edit-user', function () {
      var user_id = $(this).data('id');
      $.get('ajax-crud/' + user_id +'/edit', function (data) {
         $('#userCrudModal').html("Edit User");
          $('#btn-save').val("edit-user");
          $('#ajax-crud-modal').modal('show');
          $('#user_id').val(data.id);
          $('#name').val(data.name);
          $('#email').val(data.email);
      })
   });
////
  function delete_record(id)
  {
    if (confirm('Confirm delete')) {
    }
  }
</script>
@endsection
