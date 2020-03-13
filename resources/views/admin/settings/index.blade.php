@extends('layouts.backend.app')
@section('title','admin-settings')

@push('css')
@endpush

@section('content')
<div class="card">
<div class="header">
    <h2>
        Settings 
    </h2> 
</div>
<div class="body">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs tab-nav-right" role="tablist">
        <li role="presentation" class="active"><a href="#home" data-toggle="tab" aria-expanded="false">Profile Info</a></li>
        <li role="presentation" ><a href="#profile" data-toggle="tab" aria-expanded="true">Change Password</a></li> 
    </ul><br>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="home"> 
        	<div class="row">
        		<div class="col-md-4">
        			       <div class="card profile-card">
                    	               <div class="card" style="
											  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
											  max-width: 300px;
											  margin: auto;
											  text-align: center;
											  font-family: arial;
											  padding: 5px;
											">
  <img src="{{ Storage::disk('public')->url('user/'.$data->photo) }}" alt="John" style="width:100%">
  <h3>{{ $data->name }}</h3>
  <p  style="color: grey;
   "></p> 
</div>
                    </div>
        		</div>
        		<form action="{{ route('admin.user.update',$data->id) }}" method="post" enctype="multipart/form-data">
        			@csrf
        		<div class="col-md-8">
        			 <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    <label for="email_address_2">Name</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                              <input type="text" name="name" required class="form-control" value="{{ $data->name }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    <label for="password_2">Email</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="email" name="email" class="form-control" value="{{ $data->email }}" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    <label for="password_2">Phone</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" name="phone" class="form-control" value="{{ $data->phone }}" required placeholder="{{ $data->phone == null ? 'Update Your Phn Number':''  }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    <label for="password_2">Admin Image</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    <label for="password_2">About</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" class="form-control"  required value="{{ $data->about }}" name="about" placeholder="{{ $data->about == null ? 'Update Your About':''  }}">
                        </div>
                    </div>
                </div>
                </div>
            <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    <label for="password_2">Address</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" class="form-control"  required value="{{ $data->address }}" name="address" placeholder="{{ $data->address == null ? 'Update Your Address':''  }}">
                        </div>
                    </div>
                </div>
        		</div>
        		  <div class="row clearfix">
                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5"> 
                	<button type="submit" class="btn btn-info waves-effect">Update</button>
                </div>
            </div>
        	</div> 
        	</form>
            </div> 
        </div>
        <div role="tabpanel" class="tab-pane fade " id="profile">
        	 <div class="card-body">
            <form method="POST" action="{{ route('admin.password.update') }}">
                @csrf 
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    <label for="password_2">Old Password</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="password" class="form-control @error('o_password') is-invalid @enderror"  required name="o_password">
                             @error('o_password')
                        <span class="invalid-feedback" role="alert"  style="color: red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        </div>
                    </div>
                </div>
                    
                </div>

               <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    <label for="password_2">New Password</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"  required name="password">
                             @error('password')
                        <span class="invalid-feedback " role="alert" style="color: red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        </div>
                    </div>
                </div> 
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    <label for="password_2">Confirm Password</label>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="password" class="form-control" name="password_confirmation"
                               required autocomplete="new-password">
                             @error('password')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        </div>
                    </div>
                </div> 
                </div> 

                <div class="form-group "> 
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button> 
                    </div>
                </div>
            </form>
        </div>
        </div>
        </div>  
    </div>
</div>
</div>
@endsection

@push('js')
@endpush