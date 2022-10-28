@extends('adminlte::page')

@section('title', 'Settings Payment')

@section('content_header')
<h1>Settings Payment</h1>
@stop

@section('content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<div class="col-md-9">
					<!-- general form elements -->
					<div class="card ">
						<div class="card-header">
							<h3 class="card-title">Settings Payment VNPAY</h3>
						</div>
						<!-- form start -->
						<form role="form" action="{{route('postSettingPayment')}}" method="post" enctype="multipart/form-data">
							{{csrf_field()}}

							<div class="card-body">
								<div class="form-group">
									<label for="inputPPemail">VNPAY URL</label>
									<div class="input-group">
										<input type="text" id="inputPPemail" name="VNPAY_URL" class="form-control" placeholder="Your vnpay url" value="{{{$c->VNPAY_URL}}}">
									</div>
									<span class="text-danger">{{$errors -> first('VNPAY_URL')}}</span>
								</div>
								<div class="form-group">
									<label for="inputPPemail">VNPAY CODE</label>
									<div class="input-group">
										<input type="text" id="inputPPemail" name="VNPAY_CODE" class="form-control" placeholder="Your vnpay code" value="{{{$c->VNPAY_CODE}}}">
									</div>
									<span class="text-danger">{{$errors -> first('VNPAY_CODE')}}</span>
								</div>
								<div class="form-group">
									<label for="inputPPemail">VNPAY SECRET</label>
									<div class="input-group">
										<input type="text" id="inputPPemail" name="VNPAY_SECRET" class="form-control" placeholder="Your vnpay secret" value="{{{$c->VNPAY_SECRET}}}">
									</div>
									<span class="text-danger">{{$errors -> first('VNPAY_SECRET')}}</span>
								</div>
							</div>
							<!-- /.card-body -->

							<div class="card-footer">
								<button type="submit" id="submitActive" class="btn btn-primary pull-right">Update setting vnpay</button>
							</div>
						</form>
					</div>
					<!-- /.card -->
				</div>
			</div>
			
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
@stop
