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
              <li class="breadcrumb-item active">Users</li>
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
                <h1 class="card-title">Users
                  <a class="btn btn-sm btn-outline-secondary" href="{{ route('user.create') }}"><i class="fas fa-plus"></i> Create User</a>
                </h1>
                <p class="float-right">Total Users :{{ \App\Models\User::count() }}</p>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($users as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td><img src="{{ $item->photo }}" alt="banner photo" style="border-radius: 50%; height: 60px; width: 60px;"></td>
                      <td>{{ $item->full_name }}</td>
                      <td>{{ $item->email }}</td>
                      <td>{{ $item->role }}</td>
                      <td>
                        <input type="checkbox" name="toogle" value="{{ $item->id }}" data-toggle="toggle" {{ $item->status=='active' ? 'checked' : '' }} data-on="active" data-off="inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                      </td>
                      <td>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#userID{{ $item->id }}" title="view"  data-placement="bottom" class="float-left btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i></a>

                        <a href="{{ route('user.edit', $item->id) }}" data-toggle="tooltip" title="edit"  data-placement="bottom" class="float-left btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>

                        <form class="float-left ml-1" action="{{ route('user.destroy', $item->id) }}" method="POST">
                          @csrf
                          @method('delete')
                          <a href="" data-toggle="tooltip" title="delete" data-id="{{ $item->id }}"  data-placement="bottom" class="dltBtn btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></a> 
                        </form>
                        
                      </td>

                      {{--MODAL--}}
                      <div class="modal fade" id="userID{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          @php
                            $user=\App\Models\User::where('id', $item->id)->first();
                          @endphp
                          <div class="modal-content">
                            <div class="text-center">
                                <img src="{{ $item->photo }}" style="border-radius: 50%; margin: 2% 0; max-height: 90px;max-width: 120px;">
                              </div>
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">{{ $user->full_name }}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <strong>Username:</strong>
                              <p>{{ $user->username }}</p>

                              <div class="row">
                                <div class="col-md-6">
                                  <strong>Email:</strong>
                                  <p>{{ $user->email }}</p>
                                </div>
                                <div class="col-md-6">
                                  <strong>Phone:</strong>
                                  <p>{{ $user->phone }}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <strong>Address:</strong>
                                  <p>{{ $user->address }}</p>
                                </div>
                                <div class="col-md-6">
                                  <strong>Role:</strong>
                                  <p>{{ $user->role }}</p>
                                </div>
                              </div>
                              <div class="col-md-6">
                                  <strong>Status:</strong>
                                  <p class="btn btn-danger">{{ $user->status }}</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
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
        url:"{{route('user.status')}}",
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
