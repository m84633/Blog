@extends('layouts.master')

@section('title', '帳號管理')

@section('content')
<div class="container  ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <table class=" table table-striped ml-md-5">
                <thead>
                  <tr class="bg-primary">
                    <th scope="col" class="text-white" >#</th>
                    <th scope="col" class="text-white">姓名</th>
                    <th scope="col" class="text-white">電子郵件</th></th>
                    <th scope="col" class="text-white">編輯</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                     <tr>
                     <th scope="row">{{ $user->id }}</th>
                     <td>{{ $user->name }}</td>
                     <td>{{$user->email}}</td>
                     <td><a href="{{route('users.show',['id'=>$user->id])}}" class="text-decoration-none text-danger">修改</a>/<a href="{{ route('users.destroy',['id'=>$user->id]) }}" onclick="event.preventDefault(); $('#{{ $user->id }}').submit();" class=" text-danger text-decoration-none">刪除</a>
                     <form id="{{ $user->id }}" method="POST" style="display:none" action="{{route('users.destroy',['id'=>$user->id])}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    </form>
                    </td>
                  </tr>    
                    @endforeach
                </tbody>
              </table>
             
              
        </div> 
       
</div>
 <div class="row d-flex justify-content-center">
        <div class="mt-3">
                  {{ $users->render() }}
        </div>
    </div>
</div>



@stop
