@extends('layouts.backend.app')
@section('title','coupon')
@push('css')
@endpush
@section('content')
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="card">
		<div class="header">
			<h2>
			 Update Coupon
			 <a href="{{ route('admin.coupon.index') }}" class="btn btn-info btn-sm" style="float: right;">All Coupons</a>
			</h2> 
		</div>
		<div class="body">
			<form class="form-horizontal" action="{{ route('admin.coupon.update',$data->id) }}" method="post">
					@csrf
					 <div class="body">
						
						<div class="row clearfix">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="email_address_2">Coupon Code</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="email_address_2" class="form-control @error('coupon_code') is-invalid @enderror" name="coupon_code" value="{{ $data->coupon_code }}" required autofocus>
										
									</div>
									@error('coupon_code')
									<span class="invalid-feedback" role="alert">
										<strong style="color: red">{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
						</div><br>
						<div class="row clearfix">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="email_address_2">Coupons Type</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="type" required>
											<option value="">-- Please select --</option>
											<option value="fixed" {{ $data->type == 'fixed' ? 'selected' :'' }}>Fixed</option>
											<option value="percent" {{ $data->type == 'percent' ? 'selected' :'' }}>Percent</option>
										</select> 
									</div>
								</div>
							</div>
						</div><br>
						<div class="row clearfix">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="value">Fixed value</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="value" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ $data->value }}" placeholder="if coupon type is fixed">
										
									</div>
									@error('value')
									<span class="invalid-feedback" role="alert">
										<strong style="color: red">{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
						</div><br>
						<div class="row clearfix">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="off">Percent-Off</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="off" class="form-control @error('percent_off') is-invalid @enderror" name="percent_off" value="{{ $data->percent_off }}" placeholder="if coupon type is percent">
										
									</div>
									@error('percent_off')
									<span class="invalid-feedback" role="alert">
										<strong style="color: red">{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
						</div><br>  
						<div class="row clearfix">
					<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
						<button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
					</div>
				</div>
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