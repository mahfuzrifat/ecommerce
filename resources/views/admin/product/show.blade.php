@extends('layouts.backend.app')
@section('title','product-show')
@push('css')
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href=" {{ asset('assets/backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
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
				Show Product
				<a href="{{ route('admin.product.index') }}" class="btn btn-info btn-sm" style="float: right;">All Products</a>
				</h2>
			</div>
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="body">
						<div class="row clearfix">
							<div class="col-sm-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="product_name" value="{{ $data->product_name }}" required>
										<label class="form-label">Product Name</label>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="product_code" value="{{ $data->product_code }}" required>
										<label class="form-label">Product Code</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-sm-4">
								<div class="form-group form-float">
									<div class="form-line">
										<select class="form-control show-tick" name="category_id" required>
											<option value="">{{ $data->category->category_name }}</option> 
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="subcategory_id" required >
											<option>{{ $data->subcategory->sub_category_name }}</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="brand_id" required>
											<option >{{ $data->brand->brand_name }}</option> 
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-sm-4">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="number" class="form-control" name="qty" value="{{ $data->qty }}" required>
										<label class="form-label">Quantity</label>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="number" class="form-control" name="buy_price" value="{{ $data->buy_price }}" required>
										<label class="form-label">Buy Price</label>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="number" class="form-control @error('sell_price') is-invalid @enderror" name="sell_price" value="{{ $data->sell_price }}" required>
										<label class="form-label">Sell Price</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-sm-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" data-role="tagsinput" name="product_color" value="{{ $data->product_color }}" required disabled> 
									</div>
									<label class="form-label">Product Color</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" data-role="tagsinput" name="product_size" value="{{ $data->product_size }}" disabled>
									</div>
										<label class="form-label">Product Size</label>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-sm-12">
								<div class="form-group form-float">
									<div class="form-line">
										<textarea type="text" class="form-control" name="product_details" required>{{ $data->product_details }}</textarea>
										<label class="form-label">Product Details</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-sm-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" value="{{ $data->video_link }}" name="video_link">
										<label class="form-label">Product Video Link</label>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="number" class="form-control" name="discount_price" value="{{ $data->discount_price }}">
										<label class="form-label">Discount Price</label>
									</div>
								</div>
							</div>
						</div>
			     		<div class="row clearfix">
							<div class="col-sm-4">
								<div class="form-group">
									<div class="form-line">
										<img src="{{ Storage::disk('public')->url('products/'.$data->photo_one) }}" style="height: 80px;width: 80px;" >
									</div>
									<label class="form-label">Product Image(1)</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<div class="form-line">
										<img src="{{ Storage::disk('public')->url('products/'.$data->photo_two) }}" style="height: 80px;width: 80px;" >
									</div>
									<label class="form-label">Product Image(2)</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<div class="form-line">
										<img src="{{ Storage::disk('public')->url('products/'.$data->photo_three) }}" style="height: 80px;width: 80px;" >
									</div>
									<label class="form-label">Product Image(3)</label>
								</div>
							</div>
						</div> 
						<div class="demo-checkbox">
                                <input type="checkbox" id="md_checkbox_21" class="filled-in chk-col-green"  name="new_arrival" value="1" {{ $data->new_arrival == 1 ? 'checked':'' }} >
                                <label for="md_checkbox_21">New Arrival</label>
                                <input type="checkbox" id="md_checkbox_22" class="filled-in chk-col-green" name="best_deals" value="1" {{ $data->best_deals == 1 ? 'checked':'' }} >
                                <label for="md_checkbox_22">Best Deals</label>
                                <input type="checkbox" id="md_checkbox_23" class="filled-in chk-col-green" name="best_seller" value="1" {{ $data->best_seller == 1 ? 'checked':'' }}>
                                <label for="md_checkbox_23">Best Seller</label>
                                <input type="checkbox" id="md_checkbox_24" class="filled-in chk-col-green" name="featured_items" value="1" {{ $data->featured_items == 1 ? 'checked':'' }}>
                                <label for="md_checkbox_24">Featured Items</label>
                                <input type="checkbox" id="md_checkbox_25" class="filled-in chk-col-green" name="buyone_getone" value="1" {{ $data->buyone_getone == 1 ? 'checked':'' }} >
                                <label for="md_checkbox_25">BuyOne GetOne</label> 
                            </div>
						<div class="row clearfix">
							<div class="col-sm-6">
								<div class="row clearfix">
									<a href="{{ route('admin.product.index') }}" class="btn btn-info m-l-20 m-t-15">OK</a> 
									 <a href="{{ route('admin.product.edit',$data->id) }}" class="btn btn-sm btn-info m-t-15"><i class="fa fa-pencil"></i> UPDATE</a>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
{{-- modal --}}

@endsection
@push('js')
<script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script> 

@endpush