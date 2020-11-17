@extends('admin.layouts.master')
@section('title','users')
@section('head')
<link rel="stylesheet" href={{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
<link rel="stylesheet" href={{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
@endsection

@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><b>管理者列表</b> <a class="float-right btn btn-info" href={{ route('admin.users.create') }} role="button">新增管理者</a></h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{ route('admin.home') }}>首頁</a></li>
              <li class="breadcrumb-item active">使用者</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>順序</th>
                    <th>名稱</th>
                    <th>帳號權限</th>
                    <th>編輯</th>
                    <th>刪除</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>{{ ($loop->index)+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>@foreach($user->roles as $role)
                            @if($loop->last)
                              {{ $role->name }} 
                            @else 
                            {{ $role->name }},
                            @endif
                        @endforeach</td>
                        <td><a href={{ route('admin.users.edit',$user->id) }}><i class="ml-3 fas fa-edit"></i></a></td>
                        <td><a  id="submit{{ $user->id }}" onclick="event.preventDefault();if(confirm('是否要刪除?')){document.getElementById('delete{{ $user->id}}').submit();}" href="#"><i class="ml-3 fas fa-trash-alt"></i></a>
                    <form id="delete{{ $user->id}}" style="display: hidden" class="delete" action={{ route('admin.users.destroy',$user->id) }} method="POST">
                    @csrf
                    @method('DELETE')
                    </form></td>
                      </tr>
                  @endforeach
                  

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>順序</th>
                    <th>名稱</th>
                    <th>帳號權限</th>
                    <th>編輯</th>
                    <th>刪除</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="offset-lg-3 mt-3">
                {{ $users->links() }}
              </div>
            </div>
            <!-- /.card -->


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
    @section('footer')
		<script src={{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}></script>
		<script src={{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}></script>
		<script src={{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}></script>
		<script src={{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}></script>
		<script>
		  $(function () {
		    $("#example1").DataTable({
		      "responsive": true,
		      "autoWidth": false,
		    });
		    $('#example2').DataTable({
		      "paging": false,
		      "lengthChange": false,
		      "searching": false,
		      "ordering": true,
		      "info": false,
		      "autoWidth": false,
		      "responsive": true,
		    });
		  });
</script>
    @endsection