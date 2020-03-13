@extends('layouts.backend.app')
@section('title','subcategory')
@push('css')
@endpush
@section('content')
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="card">
		<div class="header">
			<h2>
			 Update Sub-Category
			 <a href="{{ route('admin.subcategory.index') }}" class="btn btn-info btn-sm" style="float: right;">All Sub-Category</a>
			</h2> 
		</div>
		<div class="body">
			<form class="form-horizontal" action="{{ route('admin.subcategory.update',$data->id) }}" method="post">
					@csrf
					<div class="body">
						<div class="row clearfix">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="email_address_2">Sub-Category Name</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="email_address_2" class="form-control @error('sub_category_name') is-invalid @enderror" name="sub_category_name" value="{{ $data->sub_category_name }}" required autofocus>
										
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
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="email_address_2">Select Category</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="category_id" required>
											<option value="">-- Please select --</option>
											@foreach($cat as $row)
											<option value="{{ $row->id }}" {{ $row->id == $data->category_id ? 'selected':'' }}>{{ $row->category_name }}</option>
											@endforeach
										</select>
									</div>
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