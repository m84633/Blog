@extends('admin.layouts.master')
@section('title','tags')
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
            <h1><b>Tags</b> <a class="float-right btn btn-info" href={{ route('admin.tags.create') }} role="button">new tag</a></h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{ route('admin.home') }}>首頁</a></li>
              <li class="breadcrumb-item active">tags</li>
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
                    <th>slug</th>
                    <th>編輯</th>
                    <th>刪除</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($tags as $tag)
                    <tr>
                      <td>{{ ($loop->index)+1 }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->slug }}</td>
                        <td><a href={{ route('admin.tags.edit',$tag->slug) }}><i class="ml-3 fas fa-edit"></i></a></td>
                        <td><a  id="submit{{ $tag->id }}" onclick="event.preventDefault();if(confirm('是否要刪除?')){document.getElementById('delete{{ $tag->id}}').submit();}" href="#"><i style="color: firebrick;" class="ml-3 fas fa-trash-alt"></i></a>
                    <form id="delete{{ $tag->id}}" style="display: hidden" class="delete" action={{ route('admin.tags.destroy',$tag->slug) }} method="POST">
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
                    <th>slug</th>
                    <th>編輯</th>
                    <th>刪除</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="offset-lg-3 mt-3">
                {{ $tags->links() }}
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