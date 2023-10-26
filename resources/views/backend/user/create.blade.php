@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('banner.index') }}">Users</a></li>
              <li class="breadcrumb-item active">Add User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

        <div class="col-md-12">
          @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>
            </div>

        
            <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="inputName">Full Name</label>
                <input type="text" class="form-control" placeholder="Full Name" name="full_name" value="{{ old('full_name') }}">
              </div>
              <div class="form-group">
                <label for="inputName">Username</label>
                <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}">
              </div>
              <div class="form-group">
                <label for="inputName">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
              </div>
              <div class="form-group">
                <label for="inputName">Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}">
              </div>
              <div class="form-group">
                <label for="inputName">Phone</label>
                <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{ old('phone') }}">
              </div>
              <div class="form-group">
                <label for="inputName">Address</label>
                <input type="text" class="form-control" placeholder="Address" name="address" value="{{ old('address') }}">
              </div>

              <div class="form-group">
                <label for="inputDescription">Photo</label>
                <div class="input-group">
                   <span class="input-group-btn">
                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                       <i class="fa fa-picture-o"></i> Choose
                     </a>
                   </span>
                   <input id="thumbnail" class="form-control" type="text" name="photo">
                 </div>
                 <div id="holder" style="margin-top:15px;max-height:100px;"></div>             
               </div>

              <div class="form-group">
                <label for="">Role <span class="text-danger">*</span></label>
                <select name="role" class="form-control custom-select">
                  <option>Role</option>
                  <option value="admin" {{ old('role')=='admin' ? 'selected':'' }}>Admin</option>
                  <option value="customer" {{ old('role')=='customer' ? 'selected':'' }}>Customer</option>
                  <option value="vendor" {{ old('role')=='vendor' ? 'selected':'' }}>Vendor</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control custom-select">
                  <option>Status</option>
                  <option value="active" {{ old('status')=='active' ? 'selected':'' }}>Active</option>
                  <option value="inactive" {{ old('status')=='inactive' ? 'selected':'' }}>Inactive</option>
                </select>
              </div>

                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                </div>
              </form>

            </div>

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  @endsection

  @section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
       $('#lfm').filemanager('image');
    </script>

    <script>
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>
  @endsection
