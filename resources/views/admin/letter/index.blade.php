@extends('layouts.backend.app')
@section('title','subscriber')
@push('css')
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
		<div class="card">
			<div class="header">
				<h2>
				All Subscriber  <spna class="badge bg-red">{{ $data->count() }}</spna>
				</h2>
			</div>
			<div class="body">
				<div >
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>ID</th>
								<th>Subscriber Email</th>
								<th>Join</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							@foreach($data as $key=>$row)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ $row->email }}</td> 
								<td>{{ $row->created_at->Format('F d,Y') }}</td> 
								<td> 
									<a href="{{ route('admin.letter.delete',$row->id) }}" class="btn btn-sm btn-danger"  id="delete" ><i class="fa fa-trash"></i></a> 
									 
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