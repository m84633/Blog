@extends('admin.layouts.master')
@section('title','首頁')
@section('content')
@section('head')
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script>
@endsection

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><b>文章列表</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <post v-for='(value,index) in posts' v-bind=value :key=index>
        
      </post>
      <!-- /.card -->

    </section>
    <!-- /.content -->
    <div v-if="notSearching">
      {{ $posts->links() }}
    </div>
  </div>
  
  @endsection

  @section('footer')
  @endsection

  @push('script')

    <script>
          var post={
            props:['title','content','created_at','user'],
            template:`      
                      <div class="card">
                        <div class="card-header">
                          <h3 style="font-weight: bolder;" class="card-title">標題 : @{{ title }}</h3>
                          <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                          </div>
                        </div>
                        {{-- <div class="card-body" overflow: hidden;> --}}
                        <div class="card-body">
                          @{{ content }}
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                          發布者 : @{{user.name}}<div class="float-right">發布時間:@{{ created_at }}</div>
                        </div>
                        <!-- /.card-footer-->
                      </div>`,
            methods:{

            } ,
            computed : {
              diffForHumans: {
                get : function(){
                  moment.locale('zh-tw');
                  return moment(this.created_at,"YYYY-MM-DD hh:mm:ss").fromNow()
                }
              }
            },
            data(){
                return {
                    
                }
             },

          } 

          var url = window.location.href 
          var page = url.split('=')[1]

          new Vue({
            el:'#app',
            components:{post},
            data:{
              message:'',
              posts:{},
              notSearching:true
            },
            mounted(){
                axios.post('/getPosts',{
                  'page': page
                })
                  .then(response => {
                    this.posts = response.data.data
                    // console.log(response);
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
            },
            // computed : {
            //   search : {
            //     get(){
            //       return this.message
            //     },
            //     set(val){
            //       this.test = val
            //       // axios.post('/searchBack', {
            //       //   'keyword':newValue
            //       // })
            //       // .then(function (response) {
            //       //   console.log(response);
            //       // })
            //       // .catch(function (error) {
            //       //   console.log(error);
            //       // });
            //     }
            //   }
            // }
            watch : {
              message(val){
                if(val){
                  console.log(val)
                  axios.post('/searchBack', {
                    'keyword':val
                  })
                  .then((response)=> {
                    console.log(response);
                    this.posts = response.data;
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
                  this.notSearching = false
                }else{
                  axios.post('/getPosts',{
                    'page': page
                  })
                    .then(response => {
                      this.posts = response.data.data
                      // console.log(response);
                      this.notSearching = true
                    })
                    .catch(function (error) {
                      console.log(error);
                  });
                }

              }
            }
          })
    </script>
  @endpush
