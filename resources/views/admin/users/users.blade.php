@extends('admin.layouts.master')
@section('title','users')
@section('head')
<link rel="stylesheet" href={{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
<link rel="stylesheet" href={{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script>
@endsection

@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @can('usersadd',auth()->user())
            <h1><b>管理者列表</b> <a class="float-right btn btn-info" href={{ route('admin.users.create') }} role="button">新增管理者</a></h1>
            @endcan
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
                    @can('usersadd',auth()->user())
                    <th>編輯</th>
                    @endcan
                    @can('usersdel',auth()->user())
                    <th>刪除</th>
                    @endcan
                  </tr>
                  </thead>
                  <tbody>
                    {{-- <user v-for='(value,index) in users' :key="index" v-bind='value' :index="index"></user> --}}
                    {{-- <tr is="user" v-for='(value,index) in users' :key="index" v-bind='value' :index="index"></tr> --}}
                    {{-- <tr></tr> --}}

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
                        @can('usersupdate',auth()->user())
                          <td><a href={{ route('admin.users.edit',$user->id) }}><i class="ml-3 fas fa-edit"></i></a></td>
                        @endcan
                        @can('usersdel',auth()->user())  
                          <td><a  id="submit{{ $user->id }}" onclick="event.preventDefault();if(confirm('是否要刪除?')){document.getElementById('delete{{ $user->id}}').submit();}" href="#"><i style="color: firebrick;" class="ml-3 fas fa-trash-alt"></i></a>
                            <form id="delete{{ $user->id}}" style="display: hidden" class="delete" action={{ route('admin.users.destroy',$user->id) }} method="POST">
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
                    <th>名稱</th>
                    <th>帳號權限</th>
                    @can('usersadd',auth()->user())
                    <th>編輯</th>
                    @endcan
                    @can('usersdel',auth()->user())
                    <th>刪除</th>
                    @endcan
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
    {{--           <div class="offset-lg-3 mt-3">
                {{ $users->links() }}
              </div> --}}
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
  crossorigin="anonymous"></script>
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
{{--     @push('script')
      <script>
        var url = window.location.href
        var page = url.split('=')[1]
        var user = {
          props : ['name','index','roles'],
          template : `
                    <tr>
                      <td>@{{ index+1 }}</td>
                        <td>@{{ name }}</td>
                        <td>@{{ role }}</td>
                        <td><a><i class="ml-3 fas fa-edit"></i></a></td>
                        <td><a><i style="color: firebrick;" class="ml-3 fas fa-trash-alt"></i></a></td>
                    </tr>`,

          data(){
            return {

            }
          },
          computed:{
            role:{
              get(){
                var roleNames=''
                for(i=0;i<this.roles.length;i++){
                  if(i == this.roles.length-1){
                    roleNames+=this.roles[i].name
                  }else{
                    roleNames+=this.roles[i].name+','
                  }
                }
                return roleNames
              }
          }
          }
          
        }

        new Vue({
          el : '#app',
          components : {user},
          data : {
            message : '',
            users : {},
          },
          mounted(){
                // this.dt = $("#example2").DataTable();
                axios.post('/getUsers',{
                  'page': page
                })
                  .then(response => {
                    this.users = response.data.data
                    console.log(response);
                })
                  .catch(function (error) {
                    console.log(error);
                });
          },
          watch : {
            users(val){
                $("#example2").DataTable().destroy();
                this.$nextTick(() => {
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
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
                        }
                      }
                  });
              });
            }
          }
        })
      </script>
    @endpush --}}