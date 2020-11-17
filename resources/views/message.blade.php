         @if(count($errors)>0)
          @foreach($errors->all() as $error)
              <div class="row">
                <div class="offset-lg-2 col-lg-6">
                  <div style="padding: 0px" class="alert alert-danger fade show" role="alert">
                  <strong> {{ $error }}</strong> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                </div>
            </div>
          @endforeach
          @endif

          @if(session()->has('message'))
          	<div class="row">
                <div class="offset-lg-2 col-lg-6">
                  <div style="padding: 0px" class="alert alert-success fade show" role="alert">
                  <strong> {{ session('message') }}</strong> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                </div>
            </div>
          @endif