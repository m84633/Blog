@extends('layouts.master')

@section('title', '修改資料')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-6">
        <form method="POST" action="{{route('users.update',['id'=>$user->id])}}">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="form-group">
              <label class="sr-only" for="exampleInputEmail1">Email address</label>
            <input value="{{$user->email}}" name="email" type="email" class="form-control-plaintext" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" readonly>
            </div>
            <div class="form-group">
              <label class="" for="exampleInputPassword1">姓名</label>
            <input type="text" name="name" value="{{$user->name}}" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">密碼</label>
            <input value="{{$user->password}}" name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
    </div>
</div>

@stop