@extends('layouts.master')

@section('title', '更換頭像')

@section('test')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
@endsection

@section('content')
<style>
    .hide
    {
    display:none;
    }
    </style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">更換頭像</div>

                <div id="app" class="card-body">
                    <form action="{{ route('users.uploadAvatar') }}" id="form0" method="POST" enctype="multipart/form-data">
                        @csrf
        
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label text-md-center">目前頭像</label>
                            <div class="col-md-8 offset-md-2 text-center">
                                <img src="{{ Auth::user()->getAvatarUrl() }}" class="rounded-circle" style="max-height: 150px; max-width: 150px;">
                            </div>
                        </div>

                        <div class="form-group row text-center">
                            <label for="avatar" class="col-md-12 col-form-label">更換頭像</label>
                            <div class="col-md-6 offset-md-3">
                                <input type="file" id="avatar" name="avatar" class="form-control-file" @change='read' accept="image/*" required>
                            </div>
                            <p class="form-text text-muted col-md-12">圖片檔(jpeg, png, bmp, gif, svg)</p>
                             <img v-if='see'  style="margin-left:180px;" class="rounded-circle" :src="avatar" id="demo" width="150" height="150" class="hide">
                        </div>
                       
        
                        <div class="form-group row text-center mt-3 mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit"  class="btn btn-md btn-outline-success btn-block">儲存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>    
// $('#avatar').change(function() {
//   var file = $('#avatar')[0].files[0];
//   var reader = new FileReader;
//   reader.onload = function(e) {
//     $('#demo').attr('src', e.target.result);
//   };
//   reader.readAsDataURL(file);
// });
</script>
@endsection
@push('script')
<script>
        new Vue({
            el:"#app",
            data:{
                avatar:'',
                see:0
            },
            methods:{
                read(e){
                    var img=e.target.files[0]
                    var reader =new FileReader()
                    reader.readAsDataURL(img)
                    reader.onload=e=>{
                        this.avatar=e.target.result
                    }
                    this.see=1
                }             
            }
        })
    </script>
@endpush
