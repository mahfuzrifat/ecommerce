@extends('layouts.backend.app')
@section('title','sub_category')
@push('css')
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
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
				All Sub-category
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#defaultModal" style="float: right;">Add New Sub-category</button>
				</h2>
			</div>
			<div class="body">
				<div >
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>ID</th>
								<th>Sub-Category Name</th>
								<th>Avaiable Status</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							@foreach($data as $key=>$row)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ $row->sub_category_name }}</td>
								<td>
									@if($row->s_status == true)
									<spna class="badge bg-green">Active</spna>
									@else
									<spna class="badge bg-red">De-Active</spna>
									@endif
								</td>
								<td>
									<a href="{{ route('admin.subcategory.status',$row->id) }}" class="btn btn-sm {{ $row->s_status == true ? 'btn-warning':'btn-success' }}" data-toggle="tooltip" data-placement="bottom" title="{{ $row->s_status == true ? 'Do it De-Active':'Do it Active' }}" data-original-title="Tooltip on bottom"><i class="{{ $row->s_status == true ? 'fa fa-thumbs-down':'fa fa-thumbs-up' }}" ></i></a>
									<a href="{{ route('admin.subcategory.edit',$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
									
									<a href="{{ route('admin.subcategory.destroy',$row->id) }}" class="btn btn-sm btn-danger"  id="delete" ><i class="fa fa-trash"></i></a>
									
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
				<h4 class="modal-title" id="defaultModalLabel">Add New Sub-Category</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="{{ route('admin.subcategory.store') }}" method="post">
					@csrf
					<div class="body">
						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
								<label for="email_address_2">Sub-Category Name</label>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="email_address_2" class="form-control @error('sub_category_name') is-invalid @enderror" name="sub_category_name" value="{{ old('sub_category_name') }}" required autofocus>
										
									</div>
									@error('sub_category_name')
									<span class="invalid-feedback" role="alert">
										<strong style="color: red">{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
						</div><br>
						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
								<label for="email_address_2">Select Category</label>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="category_id" required>
											<option value="">-- Please select --</option>
											@foreach($cat as $row)
											<option value="{{ $row->id }}">{{ $row->category_name }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div><br>
						<div class="row clearfix">
							<div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-5">
								<input type="checkbox" id="remember_me_3" class="filled-in" value="true" name="c_status" checked>
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
<script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
@endpush