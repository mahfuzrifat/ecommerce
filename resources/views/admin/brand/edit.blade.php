@extends('layouts.backend.app')
@section('title','brand')
@push('css')
@endpush
@section('content')
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="card">
		<div class="header">
			<h2>
			 Update Brand
			 <a href="{{ route('admin.brand.index') }}" class="btn btn-info btn-sm" style="float: right;">All Brand</a>
			</h2> 
		</div>
		<div class="body">
			<form class="form-horizontal" action="{{ route('admin.brand.update',$data->id) }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="row clearfix">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="email_address_2">Brand Name</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="email_address_2" class="form-control @error('brand_name') is-invalid @enderror" name="brand_name" value="{{ $data->brand_name }}" required autocomplete="brand_name" autofocus>
								
							</div>
							@error('brand_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>
					</div>
				</div> 
				<div class="row clearfix">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="logo">New Brand Logo</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="file" id="logo" class="form-control" name="brand_logo">
										
									</div>
									@error('brand_logo')
									<span class="invalid-feedback" role="alert">
										<strong style="color: red">{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="logo">Old Logo</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">  
										<img src="{{ Storage::disk('public')->url('brands/'.$data->brand_logo) }}" alt="brand_logo_" style="height: 50px;width: 90px;">
								</div>
							</div>
						</div>
				 
				<div class="row clearfix">
					<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
						<button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
@endsection
@push('js')
@endpush