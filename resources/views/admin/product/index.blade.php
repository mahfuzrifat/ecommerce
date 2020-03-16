@extends('layouts.backend.app')
@section('title','product')
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
				All Products  <spna class="badge bg-red">{{ $data->count() }}</spna>
				<a href="{{ route('admin.product.create') }}" class="btn btn-info btn-sm" style="float: right;">Add New Product </a>
				</h2>
			</div>
			<div class="body">
				<div >
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>ID</th>
								<th>Product Name</th>
								<th>Product Code</th>
								<th>Qty</th>
								<th>Sell Price</th>
								<th>Brand</th>
								<th>Category</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							@foreach($data as $key=>$row)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ str_limit($row->product_name,12) }}</td>
								<td>{{ $row->product_code }}</td>
								<td>{{ $row->qty }}</td>
								<td>{{ $row->sell_price }}</td>
								<td>{{ $row->brand->brand_name }}</td>
								<td>{{ $row->category->category_name }}</td>
								<td>
									@if($row->product_status == true)
									<spna class="badge bg-green">Active</spna>
									@else
									<spna class="badge bg-red">De-Active</spna>
									@endif
								</td>
								<td>
									<a href="{{ route('admin.product.status',$row->id) }}" class="btn btn-sm {{ $row->product_status == true ? 'btn-warning':'btn-success' }}" data-toggle="tooltip" data-placement="bottom" title="{{ $row->product_status == true ? 'Do it De-Active':'Do it Active' }}" data-original-title="Tooltip on bottom"><i class="{{ $row->product_status == true ? 'fa fa-thumbs-down':'fa fa-thumbs-up' }}" ></i></a>
									<a href="{{ route('admin.product.edit',$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
									<a href="{{ route('admin.product.show',$row->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
									
									<a href="{{ route('admin.product.delete',$row->id) }}" class="btn btn-sm btn-danger"  id="delete" ><i class="fa fa-trash"></i></a>
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

@endsection
@push('js')
<script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>

@endpush