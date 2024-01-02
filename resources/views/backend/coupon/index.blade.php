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
              <li class="breadcrumb-item active">Coupons</li>
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
                <h1 class="card-title">Coupons
                  <a class="btn btn-sm btn-outline-secondary" href="{{ route('coupon.create') }}"><i class="fas fa-plus"></i> Create Coupon</a>
                </h1>
                <p class="float-right">Total Coupon :{{ \App\Models\Coupon::count() }}</p>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($coupons as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->code }}</td>
                      <td>
                        @if($item->type=='fixed')
                          <span class="badge badge-success">{{ $item->type }}</span>
                        @else
                          <span class="badge badge-primary">{{ $item->type }}</span>
                        @endif
                      </td>
                      <td>{{ $item->value }}</td>
                      <td>
                        <input type="checkbox" name="toogle" value="{{ $item->id }}" data-toggle="toggle" {{ $item->status=='active' ? 'checked' : '' }} data-on="active" data-off="inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                      </td>
                      <td>
                        <a href="{{ route('coupon.edit', $item->id) }}" data-toggle="tooltip" title="edit"  data-placement="bottom" class="float-left btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>

                        <form class="float-left ml-1" action="{{ route('coupon.destroy', $item->id) }}" method="POST">
                          @csrf
                          @method('delete')
                          <a href="" data-toggle="tooltip" title="delete" data-id="{{ $item->id }}"  data-placement="bottom" class="dltBtn btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></a> 
                        </form>
                        
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  
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
        url:"{{route('coupon.status')}}",
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
