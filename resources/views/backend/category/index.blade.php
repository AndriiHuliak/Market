@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-md-12">
        @include('backend.layouts.notification')
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Categories
                  <a class="btn btn-sm btn-outline-secondary" href="{{ route('category.create') }}"><i class="fas fa-plus"></i> Create Category</a>
                </h1>
                <p class="float-right">Total Categories :{{ \App\Models\Category::count() }}</p>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Photo</th>
                    <th>Is parent</th>
                    <th>Parents</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($categories as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->title }}</td>
                      <td><img src="{{ $item->photo }}" alt="category photo" style="max-height: 90px;max-width: 120px;"></td>
                      <td>{{ $item->is_parent===1 ? 'Yes':'No' }}</td>
                      <td>{{ \App\Models\Category::where('id', $item->parent_id)->value('title') }}</td>
                      <td>
                        <input type="checkbox" name="toogle" value="{{ $item->id }}" data-toggle="toggle" {{ $item->status=='active' ? 'checked' : '' }} data-on="active" data-off="inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                      </td>
                      <td>
                        <a href="{{ route('category.edit', $item->id) }}" data-toggle="tooltip" title="edit"  data-placement="bottom" class="float-left btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>

                        <form class="float-left ml-1" action="{{ route('category.destroy', $item->id) }}" method="POST">
                          @csrf
                          @method('delete')
                          <a href="" data-toggle="tooltip" title="delete" data-id="{{ $item->id }}"  data-placement="bottom" class="dltBtn btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></a> 
                        </form>
                        
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.dltBtn').click(function(e) {
      var form=$(this).closest('form');
      var dataId=$(this).data('id');
      e.preventDefault();
      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();
          swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
          });
        } else {
          swal("Your imaginary file is safe!");
        }
      });
    });
  </script>

  <script>
    $('input[name=toogle]').change(function() {
      var mode=$(this).prop('checked');
      var id=$(this).val();
      //alert(id);
      $.ajax({
        url:"{{route('category.status')}}",
        type:"POST",
        data:{
          _token:'{{ csrf_token()}}',
          mode:mode,
          id:id,
        },
        success:function (response) {
          if(response.status){
            alert(response.msg);
          }
          else{
            alert('Please try again!');
          }
        }
      })
    })
  </script>
@endsection
