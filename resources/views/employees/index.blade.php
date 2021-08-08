@extends('layouts.app')

@section('content') 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-flex">
            <h1 class="m-0">Employees </h1><button type="button" class="btn btn-block bg-gradient-primary btn-sm create-new" data-toggle="modal" data-target="#createmodal"><i class='fas fa-plus-circle'></i> Create</button>
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
                        <th>Full Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
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
           <h4 class="modal-title">Create Employee</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
                <form method="POST" id="form-create" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" class="form-control" name='id' >
                  <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" name='first_name' placeholder="First Name" required>
                  </div>
                  <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" name='last_name' placeholder="First Name" required>
                  </div>
                  <div class="form-group">
                    <label for="company_id">Company</label>
                    <select class="form-control" name='company_id' required>
                      <option value="" disabled selected>Select Company</option>
                      @foreach($companies as $company)
                      <option value="{{$company->id}}" >{{$company->name}}</option>  
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name='email' placeholder="Email">
                  </div>
                  <div class="form-group"> 
                    <label for="phone">phone</label>
                    <input type="text" class="form-control" name='phone' placeholder="Phone" maxlength='13'>
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
           <h4 class="modal-title">Edit Employee</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
                <form method="POST" id="form-edit" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" class="form-control" name='id' >
                  <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" name='first_name' placeholder="First Name" required>
                  </div>
                  <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" name='last_name' placeholder="First Name" required>
                  </div>
                  <div class="form-group">
                    <label for="company_id">Company</label>
                    <select class="form-control" name='company_id' required>
                      <option value="" disabled selected>Select Company</option>
                      @foreach($companies as $company)
                      <option value="{{$company->id}}" >{{$company->name}}</option>  
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name='email' placeholder="Email">
                  </div>
                  <div class="form-group"> 
                    <label for="phone">phone</label>
                    <input type="text" class="form-control" name='phone' placeholder="Phone" maxlength='13'>
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
   <div class="modal fade" id="showcompany">
     <div class="modal-dialog showcompany">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title">Company</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">   
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name='name' placeholder="Name" disabled>
                  </div>
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name='email' placeholder="Email" disabled>
                  </div>
                  <div class="form-group"> 
                    <label for="website">Website</label>
                    <input type="text" class="form-control" name='website' placeholder="website" disabled>
                  </div>
                  <div class="form-group">
                    <label for="logo_url">Logo</label><br> 
                    <img src="" alt="logo" class='table-logo'/><br> 
                  </div>  
         </div>
         <div class="modal-footer justify-content-between">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
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
            "ajax": "{{ route('employees') }}", 
            columns: [
                {data: 'id', name: 'id'},
                {data: 'full_name', name: 'full_name'},
                {data: 'company', name: 'company'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
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
                'url': '{{ route("employees_getbyid") }}',
            }).done(function(res){
                if(res.status == true){
                    $('#editmodal input[name="id"]').val(res.employee.id);
                    $('#editmodal input[name="first_name"]').val(res.employee.first_name);
                    $('#editmodal input[name="last_name"]').val(res.employee.last_name);
                    $('#editmodal input[name="email"]').val(res.employee.email);
                    $('#editmodal input[name="phone"]').val(res.employee.phone);
                    $('#editmodal select[name="company_id"]').val(res.employee.company_id); 
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
                'url': '{{ route("employee_edit") }}',
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
                      if(key== 'company_id') $('#editmodal select[name="'+key+'"]').parent().append('<span class="text-danger">'+val[0]+'</span>');
                       else $('#editmodal input[name="'+key+'"]').parent().append('<span class="text-danger">'+val[0]+'</span>');
                        toastr.info(val[0]);
                        setTimeout(() => {
                            $('.text-danger').remove();
                        }, 3000);
                    }); 
            });
            $('#editmodal input:not(#editmodal input[name="_token"],#editmodal select').val('');
        });
        $(document).on('click','#save-create',function(){
            var formData = new FormData($('#form-create')[0]); 
            $.ajax({
                'data': formData,
                'method': 'POST',
                'url': '{{ route("employee_create") }}',
                'contentType': false,
                'processData': false
            }).done(function(res){
                if(res.status == true){
                    toastr.success(res.message);
                    $('#table').DataTable().ajax.reload();
                    $('#createmodal').modal('hide');
                }else{
                    toastr.error(res.message);
                }
            }).fail(function(res){
              var errors = res.responseJSON.errors;
                    $.each(errors, function (key, val) {
                      if(key == 'company_id') $('#createmodal select[name="'+key+'"]').parent().append('<span class="text-danger">'+val[0]+'</span>');
                       else $('#createmodal input[name="'+key+'"]').parent().append('<span class="text-danger">'+val[0]+'</span>');
                        toastr.info(val[0]);
                        setTimeout(() => {
                            $('.text-danger').remove();
                        }, 3000);
                    }); 
            });
            $('#createmodal input:not(#createmodal input[name="_token"],#createmodal select').val('');
        });
        $(document).on('change','.custom-file-input',function(){
            $('#editmodal img').hide();
        }); 
        $(document).on('click','.company-view',function(){
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
                    $('#showcompany input[name="id"]').val(res.company.id);
                    $('#showcompany input[name="name"]').val(res.company.name);
                    $('#showcompany input[name="email"]').val(res.company.email);
                    $('#showcompany input[name="website"]').val(res.company.website);
                    $('#showcompany input[name="logo_url"]').val(null);
                    $('#showcompany img').attr('src','storage/'+res.company.logo_url);
                    $('#showcompany').modal('show');
                }else{
                    toastr.error(res.message);
                }
            }).fail(function(){
                toastr.error('Something went wrong, please try again!');
            });
        }); 
        $('input[name="first_name"],input[name="last_name"]').keydown(function(e) { 
          var k = e.keyCode || e.which;
          var ok = k >= 65 && k <= 90 || // A-Z
            k >= 96 && k <= 105 || // a-z
            k >= 35 && k <= 40 || // arrows
            k == 32 ||
            // k == 9 || //tab
            // k == 46 || //del
            k == 8 || // backspaces
            // (!e.shiftKey && k >= 48 && k <= 57); // only 0-9 (ignore SHIFT options)
            (!e.shiftKey && k <= 48 && k >= 57);

          if(!ok || (e.ctrlKey && e.altKey)){
            e.preventDefault();
          }
        });
        $('input[name="phone"]').keydown(function(e) { 
          var k = e.keyCode || e.which;
          var ok = 
          // k >= 65 && k <= 90 || // A-Z
            // k >= 96 && k <= 105 || // a-z
            k >= 35 && k <= 40 || // arrows
            k == 187 ||
            // k == 9 || //tab
            k == 46 || //del
            k == 8 || // backspaces
            // (!e.shiftKey && k >= 48 && k <= 57); // only 0-9 (ignore SHIFT options)
            (!e.shiftKey && k >= 48 && k <= 57);

          if(!ok || (e.ctrlKey && e.altKey)){
            e.preventDefault();
          }
        });
    });
    function deleteemployee(id){
        $.ajax({ 
                'method': 'POST',
                'url': "{{ route('employee_delete') }}", 
                'data': {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id':id
                },
                'dataType': "json",
            }).done(function(res){
                if(res.status == true){
                    toastr.success(res.message);
                    $('#table').DataTable().ajax.reload();  
                }else{
                    toastr.error(res.message);
                }
            }).fail(function(){
                toastr.error('Something went wrong, please try again!');
            });
    }
</script>
@endsection