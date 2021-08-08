@extends('layouts.app')

@section('content') 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-flex">
            <h1 class="m-0">Companies </h1><button type="button" class="btn btn-block bg-gradient-primary btn-sm create-new" data-toggle="modal" data-target="#createmodal"><i class='fas fa-plus-circle'></i> Create</button>
          </div> 
        </div> 
      </div> 
    </div> 
    <section class="content">
      <div class="container-fluid"> 
        <div class="row">
          <div class="col-lg-12 col-12">
            <table id="table" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Index</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th>Website</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> 
                </tbody>
            </table>
          </div>  
        </div> 
      </div> 
    </section>   
    <div class="modal fade" id="createmodal">
     <div class="modal-dialog createmodal">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title">Create Company</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
                <form method="POST" id="form-create" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" class="form-control" name='id' >
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name='name' placeholder="Name" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name='email' placeholder="Email">
                  </div>
                  <div class="form-group"> 
                    <label for="website">Website</label>
                    <input type="text" class="form-control" name='website' placeholder="Website">
                  </div>
                  <div class="form-group">
                    <label for="logo_url">Logo</label><br> 
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="logo_url">
                        <label class="custom-file-label" for="logo">Choose file(png|jpg|gif)</label>
                      </div>
                    </div>
                  </div> 
                </form> 
         </div>
         <div class="modal-footer justify-content-between">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="button" class="btn btn-primary" id='save-create'>Save changes</button>
         </div>
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>
    <div class="modal fade" id="editmodal">
     <div class="modal-dialog editmodal">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title">Edit Company</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
                <form method="POST" id="form-edit" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" class="form-control" name='id' >
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name='name' placeholder="Name" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name='email' placeholder="Email">
                  </div>
                  <div class="form-group"> 
                    <label for="website">Website</label>
                    <input type="text" class="form-control" name='website' placeholder="Website">
                  </div>
                  <div class="form-group">
                    <label for="logo_url">Logo</label><br> 
                    <img src="" alt="logo" class='table-logo'/><br> <br> 
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="logo_url">
                        <label class="custom-file-label" for="logo">Choose file(png|jpg|gif)</label>
                      </div>
                    </div>
                  </div> 
                </form> 
         </div>
         <div class="modal-footer justify-content-between">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="button" class="btn btn-primary" id='save-edit'>Save changes</button>
         </div>
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": "{{ route('companies') }}", 
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'logo_url', name: 'logo'},
                {data: 'website', name: 'website'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        }); 
        $(document).on('click','.table-website',function(){
            var url = $(this).attr('data-url');
            window.open(url, '_blank');
        });
        $(document).on('click','.edit',function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                'data': {
                    '_token': CSRF_TOKEN,
                    'id': $(this).attr('data-id')
                },
                method: 'POST',
                'url': '{{ route("companies_getbyid") }}',
            }).done(function(res){
                if(res.status == true){
                    $('#editmodal input[name="id"]').val(res.company.id);
                    $('#editmodal input[name="name"]').val(res.company.name);
                    $('#editmodal input[name="email"]').val(res.company.email);
                    $('#editmodal input[name="website"]').val(res.company.website);
                    $('#editmodal input[name="logo_url"]').val(null);
                    $('#editmodal img').attr('src','storage/'+res.company.logo_url);
                    $('#editmodal').modal('show');
                }else{
                    toastr.error(res.message);
                }
            }).fail(function(){
                toastr.error('Something went wrong, please try again!');
            });
        });
        $(document).on('click','#save-edit',function(){
            var formData = new FormData($('#form-edit')[0]); 
            $.ajax({
                'data': formData,
                'method': 'POST',
                'url': '{{ route("company_edit") }}',
                'contentType': false,
                'processData': false
            }).done(function(res){
                if(res.status == true){
                    toastr.success(res.message);
                    $('#table').DataTable().ajax.reload();
                    $('#editmodal').modal('hide');
                }else{
                    toastr.error(res.message);
                }
            }).fail(function(res){
                var errors = res.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $('#editmodal input[name="'+key+'"]').parent().append('<span class="text-danger">'+val[0]+'</span>');
                        toastr.info(val[0]);
                        setTimeout(() => {
                            $('.text-danger').remove();
                        }, 3000);
                    }); 
            });
        });
        $(document).on('click','#save-create',function(){
            var formData = new FormData($('#form-create')[0]); 
            $.ajax({
                'data': formData,
                'method': 'POST',
                'url': '{{ route("company_create") }}',
                'contentType': false,
                'processData': false
            }).done(function(res){
                if(res.status == true){
                    toastr.success(res.message);
                    $('#table').DataTable().ajax.reload();
                    $('#createmodal').modal('hide');
                    $('#createmodal input[name="logo_url"]').val(null);
                }else{
                    toastr.error(res.message);
                }
            }).fail(function(res){
                var errors = res.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $('#createmodal input[name="'+key+'"]').parent().append('<span class="text-danger">'+val[0]+'</span>');
                        toastr.info(val[0]);
                        setTimeout(() => {
                            $('.text-danger').remove();
                        }, 3000);
                    }); 
            });
        });
        $(document).on('change','.custom-file-input',function(){
            $('#editmodal img').hide();
        }); 
    });
    function deletecompany(id){
        $.ajax({ 
                'method': 'POST',
                'url': "{{ route('company_delete') }}", 
                'data': {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id':id
                },
                'dataType': "json",
            }).done(function(res){
                if(res.status == true){
                    toastr.success(res.message);
                    $('#table').DataTable().ajax.reload();  
                }else if(res.status == '2'){
                    if (confirm(res.message)) { 
                        $.ajax({ 
                            'method': 'POST',
                            'url': "{{ route('company_delete') }}", 
                            'data': {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'id':id,
                                'confirmed':true
                            },
                            'dataType': "json",
                        }).done(function(res){
                            toastr.success(res.message);
                            $('#table').DataTable().ajax.reload();  
                        }).fail(function(){
                            toastr.error('Something went wrong, please try again!');
                        });
                    } else { 
                        return true;
                    }
                }else{
                    toastr.error(res.message);
                }
            }).fail(function(){
                toastr.error('Something went wrong, please try again!');
            });
    }
</script>
@endsection