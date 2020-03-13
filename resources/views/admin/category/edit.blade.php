@extends('layouts.backend.app')
@section('title','category')
@push('css')
@endpush
@section('content')
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="card">
		<div class="header">
			<h2>
			 Update Category
			 <a href="{{ route('admin.category.index') }}" class="btn btn-info btn-sm" style="float: right;">All Category</a>
			</h2> 
		</div>
		<div class="body">
			<form class="form-horizontal" action="{{ route('admin.category.update',$data->id) }}" method="post">
				@csrf
				<div class="row clearfix">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="email_address_2">Category Name</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="email_address_2" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ $data->category_name }}" required autocomplete="category_name" autofocus>
								
							</div>
							@error('category_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                                @enderror
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