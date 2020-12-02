@extends('layouts.master')

@section('title', '所有文章')

@section('content')

@section('style')
    .fa-thumbs-up{
        color:gray;
}
    .fa-thumbs-up:hover{
        color:DodgerBlue;
}
    a.thumb{
        text-decoration:none; 
}
@endsection
@section('test')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection
<div class="container" id="app">
    <div class="row">
        <div class="col-md-8">
            <h4>
                @auth
                    <div class="float-right">
                        <a href="{{ route('posts.create') }}" class="btn btn-md btn-success ml-2">
                            <i class="fas fa-plus"></i>
                            <span class="pl-1">新增文章</span>
                        </a>
                    </div>
                @endauth
                
                

                @isset($type)
                    分類：{{ $type->name }}
                    @auth
                        @if (Auth::user()->isAdmin())
                            <div class="float-right">
                                <form action="{{ route('types.destroy', ['id' => $type->id]) }}" method="POST">
                                    <span class="ml-2">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-md btn-danger">
                                            <i class="fas fa-trash"></i>
                                            <span class="pl-1">刪除分類</span>
                                        </button>
                                    </span>
                                </form>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('types.edit', ['type' => $type->id]) }}" class="btn btn-md btn-primary ml-2">
                                    <i class="fas fa-pencil-alt"></i>
                                    <span class="pl-1">編輯分類</span>
                                </a>
                            </div>
                        @endif
                    @endauth
                @endisset

                @if(isset($keyword))
                    搜尋：{{ $keyword }}
                @elseif(isset($tag))
                    Tag：{{ $tag }}
                @else
                    所有文章
                @endisset 
                 
                    
                        
            </h4>
            <hr>
            @if(count($posts) == 0 && !isset($user_search))
                <p class="text-center">
                    沒有任何文章
                </p>
            @endif
            @foreach($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="card-title">{{ $post['title'] }}</h4>
                                        </div>
                                        @if($post->tags)
                                        <div class="col-md-4">
                                            @foreach($post->tags as $tag)
                                                <a href="{{ route('tagShow',$tag->slug) }}"><small class="float-right" style="border-radius: 5px;border: 1px solid gray;padding: 2px;margin-left: 3px;color: green">#{{ $tag->name }}</small></a>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    @if($post->postType != null)
                                        <span class="badge badge-secondary ml-2">
                                            {{ $post->postType->name }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4 text-right">
                                    {{ $post->created_at->toDateString() }}
                                </div>
                            </div>
                            <hr class="my-2 mx-0">
                            <div class="row">
                                <div class="col-md-12" style="height: 100px; overflow: hidden;">
                                    <p class="card-text">
                                        {!! htmlspecialchars_decode($post->content) !!}
                                    </p> 
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-8">
                                    @auth
                                        @if (Auth::user()->isAdmin() || Auth::id() == $post->user_id)
                                            <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                                                @csrf 
                                                <span class="mr-1">{{ $post->comments->count() }}&nbsp;則回應</span>

                                                <like equser="{{ $post->likes }}" likecount="{{ $post->likes->count() }}"  post_id="{{ $post->id }}" user_id="{{ auth()->id() }}">{{ $post->likes->count() }}</like>
                                                <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class=" btn btn-md btn-primary">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    <span class="pl-1">編輯文章</span>
                                                </a>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button onclick="return del()" type="submit" class="btn btn-md btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                    <span class="pl-1">刪除文章</span>
                                                </button>
                                            </form>
                                        @else
                                            <span class="mr-1">{{ $post->comments()->count() }}&nbsp;則回應</span>
                                             <like equser="{{ $post->likes }}" likecount="{{ $post->likes->count() }}"  post_id="{{ $post->id }}" user_id="{{ auth()->id() }}">{{ $post->likes->count() }}</like>
                                        @endif
                                    @else
                                        <span class="mr-1">{{ $post->comments()->count() }}&nbsp;則回應</span>
                                         <like likecount="{{ $post->likes->count() }}"  post_id="{{ $post->id }}" user_id="{{ auth()->id() }}">{{ $post->likes->count() }}</like>
                                    @endauth 
                                </div>
                                <div class="col-md-4 mt-md-2">
                                    <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="float-right card-link">繼續閱讀...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @isset($user_search)
                @foreach($user_search as $user)
                @foreach($user->posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="card-title">{{ $post['title'] }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    @if($post->postType != null)
                                        <span class="badge badge-secondary ml-2">
                                            {{ $post->postType->name }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4 text-right">
                                    {{ $post->created_at->toDateString() }}
                                </div>
                            </div>
                            <hr class="my-2 mx-0">
                            <div class="row">
                                <div class="col-md-12" style="height: 100px; overflow: hidden;">
                                    <p class="card-text">
                                        {!! htmlspecialchars_decode($post->content) !!}
                                    </p> 
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-8">
                                    @auth
                                        @if (Auth::user()->isAdmin() || Auth::id() == $post->user_id)
                                            <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                                                @csrf 
                                                <span class="mr-1">{{ $post->comments->count() }}&nbsp;則回應</span>

                                                <like equser="{{ $post->likes }}" likecount="{{ $post->likes->count() }}"  post_id="{{ $post->id }}" user_id="{{ auth()->id() }}">{{ $post->likes->count() }}</like>
                                                <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class=" btn btn-md btn-primary">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    <span class="pl-1">編輯文章</span>
                                                </a>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button onclick="return del()" type="submit" class="btn btn-md btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                    <span class="pl-1">刪除文章</span>
                                                </button>
                                            </form>
                                        @else
                                            <span class="mr-1">{{ $post->comments()->count() }}&nbsp;則回應</span>
                                             <like equser="{{ $post->likes }}" likecount="{{ $post->likes->count() }}"  post_id="{{ $post->id }}" user_id="{{ auth()->id() }}">{{ $post->likes->count() }}</like>
                                        @endif
                                    @else
                                        <span class="mr-1">{{ $post->comments()->count() }}&nbsp;則回應</span>
                                         <like likecount="{{ $post->likes->count() }}"  post_id="{{ $post->id }}" user_id="{{ auth()->id() }}">{{ $post->likes->count() }}</like>
                                    @endauth 
                                </div>
                                <div class="col-md-4 mt-md-2">
                                    <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="float-right card-link">繼續閱讀...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @endforeach
            @endisset
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <a href="{{ route('posts.index') }}" class=" list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ (isset($type))?'':'active' }}">
                    全部分類
                    <span class="badge badge-secondary badge-pill">{{ $posts_total }}</span>
                </a>
                @foreach ($post_types as $post_type)
                    <a href="{{ route('types.show', ['id' => $post_type->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ isset($type)?($type->id == $post_type->id?'active':''):'' }}">
                        {{ $post_type->name }}
                        <span class="badge badge-secondary badge-pill">
                            {{ $post_type->posts->count() }}
                        </span>
                    </a>
                @endforeach
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('types.create') }}" class="list-group-item list-group-item-action">建立新分類</a>
                    @endif
                @endauth
            </div>
        </div>

    </div>
    <div class="row pt-2">
        <div class="col-md-8">
       @if(!isset($keyword))
{{--                 {{ $posts->appends(['keyword' => $keyword])->render() }}
            @else --}}
                {{$posts->links() }}
               {{--  {{$posts->url(app('request')->input('page'))}} --}}
            @endif
        </div>
       
    </div>
</div>
<script>
    function del() {
        var msg = "確定要刪除?";
        if (confirm(msg) == true) {
            return true;
        } else {
            return false;
        }
    }
</script>
@stop
@push('script')
    <script>
        var like={
            props:['post_id','user_id','likecount','equser'],
            template:`<div>
                        <a class="thumb" style="cursor: pointer;">
                            <small>@{{ count }}&nbsp;&nbsp;&nbsp;</small>
                            <i v-if="clicked != 1" @click.prevent.stop='LikeIt'  class="fas fa-thumbs-up"></i>
                            <i v-else style="color:DodgerBlue"  @click.prevent.stop='LikeIt' class="fas fa-thumbs-up"></i>
                        </a>
                    </div>`,
            methods:{
                LikeIt(){
                    if(this.user_id){
                            axios.post('like', {
                                post_id:this.post_id,
                                user_id:this.user_id
                          })
                          .then((response)=> {
                            console.log(response);
                            if(response.data == 'delete'){
                                this.count -- 
                                this.clicked=0
                            }else{
                            this.count++
                            this.clicked=1
                            }
                          })
                          .catch(function (error) {
                            console.log(error);
                          });
                            
                    }else{
                        window.location='login'
                    }
                },
            } ,
            data(){
                return {
                    count:'',
                    likeinfo:{},
                    clicked:''
                }
             },
             created: function(){
                this.count=this.likecount
                if(this.equser){
                    this.likeinfo=JSON.parse(this.equser);
                    for(let i=0;i<this.likeinfo.length;i++){
                        if(this.likeinfo[i]['user_id']==this.user_id){
                            return this.clicked=1
                        }
                    }
                    
                }
             },
             // computed:{
             //    counttest: function(){
             //        return this.likecount
             //    }
             // }
             // watch:{
             //    likecount(newv,old){
             //        this.count=newv
             //     }
            // },
       } 

        new Vue({
            el:"#app",
            components:{
                'like':like
            },
        })
    </script>
@endpush