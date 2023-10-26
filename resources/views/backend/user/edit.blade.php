@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
              <li class="breadcrumb-item active">Edit User</li>
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
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('patch')

              <div class="form-group">
                <label for="inputName">Full Name</label>
                <input type="text" class="form-control" placeholder="Full Name" name="full_name" value="{{ $user->full_name }}">
              </div>
              <div class="form-group">
                <label for="inputName">Username</label>
                <input type="text" class="form-control" placeholder="Username" name="username" value="{{ $user->username }}">
              </div>
              <div class="form-group">
                <label for="inputName">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $user->email }}">
              </div>
              <div class="form-group">
                <label for="inputName">Phone</label>
                <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{ $user->phone }}">
              </div>
              <div class="form-group">
                <label for="inputName">Address</label>
                <input type="text" class="form-control" placeholder="Address" name="address" value="{{ $user->address }}">
              </div>

              <div class="form-group">
                <label for="inputDescription">Photo</label>
                <div class="input-group">
                   <span class="input-group-btn">
                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                       <i class="fa fa-picture-o"></i> Choose
                     </a>
                   </span>
                   <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ $user->photo }}">
                 </div>
                 <div id="holder" style="margin-top:15px;max-height:100px;"></div>             
               </div>

              <div class="form-group">
                <label for="">Role <span class="text-danger">*</span></label>
                <select name="role" class="form-control custom-select">
                  <option>Role</option>
                  <option value="admin" {{ $user->role=='admin' ? 'selected':'' }}>Admin</option>
                  <option value="customer" {{ $user->role=='customer' ? 'selected':'' }}>Customer</option>
                  <option value="vendor" {{ $user->role=='vendor' ? 'selected':'' }}>Vendor</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control custom-select">
                  <option>Status</option>
                  <option value="active" {{ $user->status=='active' ? 'selected':'' }}>Active</option>
                  <option value="inactive" {{ $user->status=='inactive' ? 'selected':'' }}>Inactive</option>
                </select>
              </div>

              <button type="submit" class="btn btn-success">Update</button>
              <button type="submit" class="btn btn-outline-secondary">Cancel</button>
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
