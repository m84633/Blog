  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2016-{{ now()->year }} <a href="http://adminlte.io">Hello Blog</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src={{ asset('admin/plugins/jquery/jquery.min.js') }}></script>
<!-- Bootstrap 4 -->
<script src={{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<!-- AdminLTE App -->
<script src={{ asset('admin/dist/js/adminlte.min.js') }}></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src={{ asset('admin/dist/js/demo.js') }})></script> --}}

<script src={{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }} ></script>

  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
@section('footer')
@show

    <script>
          let no_read_not = {
              props:['data'],
              template:`
                        <div>
                            <a href="#" class="dropdown-item text-white bg-danger">
                              <i class="fas fa-envelope mr-2"></i>@{{ data.data.data}}
                              <span class="float-right text-white text-sm">@{{ diffForHumans }}</span>
                            </a>
                        </div>`,
              computed : {
                diffForHumans : {
                  get(){
                        moment.locale('zh-tw');
                        return moment(this.data.created_at,"YYYY-MM-DD hh:mm:ss").fromNow()
                  }
                }
              }
          }

          let read_not = {
            props:['data'],
            template:`
                        <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i>@{{ data.data.data }}
                        <span class="float-right text-muted text-sm">@{{ diffForHumans }}</span>
                        </a>`,
            computed:{
              diffForHumans:{
                get(){
                  moment.locale('zh-tw')
                  return moment(this.data.created_at,"YYYY-MM-DD hh:mm:ss").fromNow()
                }
              }
            }                      
          }

          let post={
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

          let url = window.location.href 
          let page = url.split('=')[1]

          new Vue({
            el:'#app',
            components:{post,no_read_not,read_not},
            data:{
              message:'',
              posts:{},
              notSearching:true,
              notFound:false,
              showSearch:false,
              notCount :'',
              notReadCount : '',
              notRead : [],
              Read : [],
              notAll:true,
              haveNot:true
            },
            methods : {
              mark(){
                if(this.notRead){
                  axios.post('/markasread')
                  .then((response)=> {
                    console.log(response);
                    this.notReadCount=0
                    this.Read = this.notRead.concat(this.Read)
                    this.notRead =''
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
                }
              },
              seeAll(){
                this.notAll=!this.notAll
              },
              deleteAll(){
                  axios.post('/deletenot',{
                    'id' : {{ auth()->user()->id }}
                  })
                  .then((response)=> {
                    console.log(response);
                    this.notRead=''
                    this.Read=''
                    this.notReadCount=0
                    this.notCount=0
                    this.haveNot=false
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
              }
            },
            created(){
                this.notReadCount = {{Auth::user()->unreadnotifications->count()}}
                var url = window.location.href
                var reg = RegExp(/admin\/home/)
                if(reg.test(url)){
                  this.showSearch=true
                }

                axios.post('/getPosts',{
                  'page': page
                })
                  .then(response => {
                    this.posts = response.data.data
                    // console.log(response);
                    this.notCount = {{ Auth::user()->notifications->count() }}
                    this.notRead = {!! auth()->user()->unreadNotifications !!}
                    this.Read = {!! auth()->user()->readNotifications !!}
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
            },
            computed : {
              ReadLoop : {
                get(){
                  // return this.notRead.replace(/\[|\]/g,"")
                  return 5-this.notReadCount
                },
              }
            },
            watch : {
              message(val){
                if(val){
                  console.log(val)
                  axios.post('/searchBack', {
                    'keyword':val
                  })
                  .then((response)=> {
                    console.log(response);
                    if(response.data.length == 0){
                      this.notFound=true
                      this.posts=''
                    }else{
                      this.posts = response.data;
                    }
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

              },
              notCount(val){
                if(val == 0){
                  this.haveNot=false
                }
              }
            }
          })
    </script>
