@extends('layouts.backend.app')
@section('title','brand')
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
				All Category 
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#largeModal" style="float: right;">Add New Brand</button>
				</h2>
			</div>
			<div class="body">
				<div >
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>ID</th>
								<th>Brand Name</th>
								<th>Brand Logo</th>
								<th>Avaiable Status</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							@foreach($data as $key=>$row)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ $row->brand_name }}</td>
								
							<td><img src="{{ Storage::disk('public')->url('brands/'.$row->brand_logo) }}" alt="brand_logo_" style="height: 30px;width: 90px;"></td>
							  <td>
									@if($row->b_status == true)
									<spna class="badge bg-green">Active</spna>
									@else
									<spna class="badge bg-red">De-Active</spna>
									@endif
								</td>
								<td>
									<a href="{{ route('admin.brand.status',$row->id) }}" class="btn btn-sm {{ $row->b_status == true ? 'btn-warning':'btn-success' }}" data-toggle="tooltip" data-placement="bottom" title="{{ $row->b_status == true ? 'Do it De-Active':'Do it Active' }}" data-original-title="Tooltip on bottom"><i class="{{ $row->b_status == true ? 'fa fa-thumbs-down':'fa fa-thumbs-up' }}" ></i></a>
									<a href="{{ route('admin.brand.edit',$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
									
									<a href="{{ route('admin.brand.destroy',$row->id) }}" class="btn btn-sm btn-danger"  id="delete" ><i class="fa fa-trash"></i></a> 
									 
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
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Add New Brand</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="body"> 
						<div class="row clearfix">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="email_address_2">Brand Name</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="email_address_2" class="form-control @error('brand_name') is-invalid @enderror" name="brand_name" value="{{ old('brand_name') }}" required autofocus>
										
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
								<label for="logo">Brand Logo</label>
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
							<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
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

@endpush

 