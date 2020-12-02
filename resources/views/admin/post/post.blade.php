@extends('admin.layouts.master')
@section('title','文章')
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
            <h1><b>文章列表</b>
            @can('admin.posts.create',Auth::user())
              <a class="float-right btn btn-info" href={{ route('admin.posts.create') }} role="button">發布文章</a></h1>
            @endcan 

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{ route('admin.home') }}>首頁</a></li>
              <li class="breadcrumb-item active">文章</li>
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
                    <th>標題</th>
                    <th>作者</th>
                    <th>類型</th>
                    <th>創建日期</th>
                    @can('admin.posts.update',Auth::user())
                    <th>編輯</th>
                    @endcan
                    @can('admin.posts.delete',Auth::user())
                    <th>刪除</th>
                    @endcan
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($posts as $post)
                  <tr>
                    <td>{{ ($loop->index)+1 }}</td>
                    <td>  {{ Illuminate\Support\Str::limit($post->title, 20,'...') }}  </td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->postType->name }}</td>
                    <td>{{ $post->created_at->toDateString() }} <div class="float-right">{{ $post->created_at->diffForHumans() }}</div></td>
                    @can('admin.posts.update',Auth::user())
                    <td><a href={{ route('admin.posts.edit',$post->id) }}><i class="ml-3 fas fa-edit"></i></a></td>
                    @endcan
                    @can('admin.posts.delete',Auth::user())
                    <td><a  id="submit{{ $post->id }}" onclick="event.preventDefault();if(confirm('是否要刪除?')){document.getElementById('delete{{ $post->id}}').submit();}" href="#"><i style="color: firebrick;" class="ml-3 fas fa-trash-alt"></i></a>
                    <form id="delete{{ $post->id}}" style="display: hidden" class="delete" action='{{ route('admin.posts.destroy',$post->id) }}' 
                      method="POST">
                    @csrf
                    @method('DELETE')
                    </form>
                    </td>
                     @endcan
                  </tr> 
                   
                  @endforeach
                  </tbody>

                  <tfoot>
                  <tr>
                    <th>順序</th>
                    <th>標題</th>
                    <th>作者</th>
                    <th>類型</th>
                    <th>創建日期</th>
                    @can('admin.posts.update',Auth::user())
                    <th>編輯</th>
                    @endcan
                    @can('admin.posts.delete',Auth::user())
                    <th>刪除</th>
                    @endcan
                  </tr>
                  </tfoot>
                </table>
{{--                 <div class="offset-lg-3 mt-3 ">
                {{ $posts->links() }}
                </div> --}}
              </div>
              <!-- /.card-body -->
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
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "pageLength": 5,
          "searching": true,
          "ordering": true,
          "info": false,
          "autoWidth": false,
          "responsive": true,
          "language": {
              "emptyTable":"無相關資料",
              "search":"搜尋:",
              "paginate": {
                "first":"第一頁",
                "last":"最後一頁",
                "next":"下一頁",
                "previous":"上一頁"
            },
          }
        });
		  });
</script>
    @endsection