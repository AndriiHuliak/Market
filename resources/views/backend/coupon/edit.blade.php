@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Coupon</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">Coupons</a></li>
              <li class="breadcrumb-item active">Edit Coupon</li>
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
            <form action="{{ route('coupon.update', $coupon->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('patch')
              
              <div class="form-group">
                <label for="inputName">Coupon Code</label>
                <input type="text" class="form-control" placeholder="eg. HAPPY" name="code" value="{{ $coupon->code }}">
              </div>

              <div class="form-group">
                <label for="inputName">Coupon Value</label>
                <input type="text" class="form-control" placeholder="eg. 10%" name="value" value="{{ $coupon->value }}">
              </div>

              <div class="form-group">
                <label for="">Coupon Type <span class="text-danger">*</span></label>
                <select name="type" class="form-control custom-select">
                  <option>Type</option>
                  <option value="fixed" {{ $coupon->type=='fixed' ? 'selected':'' }}>Fixed</option>
                  <option value="percent" {{ $coupon->type=='percent' ? 'selected':'' }}>Percentage</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control custom-select">
                  <option>Status</option>
                  <option value="active" {{ $coupon->status=='actice' ? 'selected':'' }}>Active</option>
                  <option value="inactive" {{ $coupon->status=='inactice' ? 'selected':'' }}>Inactive</option>
                </select>
              </div>

                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary">Update</button>
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
