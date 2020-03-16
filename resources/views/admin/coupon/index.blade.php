@extends('layouts.backend.app')
@section('title','coupon')
@push('css')
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
 
@endpush
@section('content')
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<div class="card">
			<div class="header">
				<h2>
				All Coupons
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#defaultModal" style="float: right;">Add New Coupons</button>
				</h2>
			</div>
			<div class="body">
				<div >
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>ID</th>
								<th>Coupon Code</th>
								<th>Coupon Type</th>
								<th>Value</th>
								<th>Percent Off</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							@foreach($data as $key=>$row)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ $row->coupon_code }}</td>
								<td>{{ $row->type }}</td>
								<td>{{ $row->value }} {{ $row->value == null ? '':'/=' }}</td>
								<td>{{ $row->percent_off }} {{ $row->percent_off == null ? '':'%' }}</td>
								<td>
									@if($row->p_status == true)
									<spna class="badge bg-green">Active</spna>
									@else
									<spna class="badge bg-red">De-Active</spna>
									@endif
								</td>
								<td>
									<a href="{{ route('admin.coupon.status',$row->id) }}" class="btn btn-sm {{ $row->p_status == true ? 'btn-warning':'btn-success' }}" data-toggle="tooltip" data-placement="bottom" title="{{ $row->p_status == true ? 'Do it De-Active':'Do it Active' }}" data-original-title="Tooltip on bottom"><i class="{{ $row->p_status == true ? 'fa fa-thumbs-down':'fa fa-thumbs-up' }}" ></i></a>
									<a href="{{ route('admin.coupon.edit',$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
									
									<a href="{{ route('admin.coupon.destroy',$row->id) }}" class="btn btn-sm btn-danger"  id="delete" ><i class="fa fa-trash"></i></a>
									
								</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- modal --}}
<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Add New Coupon</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="{{ route('admin.coupon.store') }}" method="post">
					@csrf
					<div class="body">
						
						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
								<label for="email_address_2">Coupon Code</label>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="email_address_2" class="form-control @error('coupon_code') is-invalid @enderror" name="coupon_code" value="{{ old('coupon_code') }}" required autofocus>
										
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
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
								<label for="email_address_2">Coupons Type</label>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="type" required>
											<option value="">-- Please select --</option>
											<option value="fixed">Fixed</option>
											<option value="percent">Percent</option>
										</select> 
									</div>
								</div>
							</div>
						</div><br>
						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
								<label for="value">Fixed value</label>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="value" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" placeholder="if coupon type is fixed">
										
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
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
								<label for="off">Percent-Off</label>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="off" class="form-control @error('percent_off') is-invalid @enderror" name="percent_off" value="{{ old('percent_off') }}" placeholder="if coupon type is percent">
										
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
							<div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-5">
								<input type="checkbox" id="remember_me_3" class="filled-in" value="true" name="p_status" checked disabled>
								<label for="remember_me_3">Avaiable Status</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary waves-effect">SAVE</button>
					<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('js')
<script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
 
@endpush