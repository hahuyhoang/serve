@extends('adminlte::page')

@section('title','User')
@section('adminlte_css')
<link rel="stylesheet" href="{{asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@stop
@section('content_header')
<h1>List Users</h1>
<p>Manage your user website</p>
<div class="card-header">
	<div class="card-tools">
		<form action="{{route('users.index')}}" method="get">
			<div class="input-group input-group-sm" style="width: 150px;">

				<input type="text" name="keyword" id="keyword" value="@if($keyword){{$keyword}}@endif" class="form-control float-right" placeholder="Search">
				<div class="input-group-append">
					<button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
				</div>
			</div>
		</form>
	</div>
</div>
@stop

@section('content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!--/.col (right) ------------------------------------------------------------------------------------------>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<!-- Check all button -->
						<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i></button>
						<div class="btn-group">
							<button type="button" class="btn btn-default btn-sm delete">
								<i class="far fa-trash-alt"></i>
							</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0  mailbox-messages">
						<table class="table table-hover ">
							<thead>
								<tr>
									<th></th>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Role</th>
									<th>Created At</th>
								</tr>
							</thead>
							<tbody>
								@if(count($data_list_user) > 0)
								@foreach($data_list_user as $data)

								<tr>
									<td>
										<div class="icheck-primary">
											<input type="checkbox" value="" class="check" id="check{{$data->id}}" data-row-id="{{$data->id}}">
											<label for="check{{$data->id}}"></label>
										</div>
									</td>
									<td>{{$data -> id}}</td>
									<td><a href="{{route('users.edit',['user'=>$data -> id])}}">{{$data -> name}}</a></td>
									<td>{{$data -> email}}</td>
									<td>{{$data -> role[0]->name}}</td>
									<td>{{$data -> created_at}}</td>
								</tr>
								@endforeach
								@else
								<tr>
									<td><span class="tag tag-success">No Data</span></td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>

				</div>
				<!-- /.card -->
				<!-- /.card-body -->
				<div class="card-header">
					<div class="card-tools">
						{!!$data_list_user -> appends(request()->except('page')) -> links()!!}
					</div>
				</div>
			</div>

		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
@stop
@push('js')
<script>
	$(function() {
		//Enable check and uncheck all functionality
		$('.checkbox-toggle').click(function() {
			var clicks = $(this).data('clicks')
			if (clicks) {
				//Uncheck all checkboxes
				$('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
				$('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
			} else {
				//Check all checkboxes
				$('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
				$('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
			}
			$(this).data('clicks', !clicks)
		})

		//multi delete
		$(".delete").click(function() {
			var arr = [];
			$(".check:checked").each(function() {
				arr.push($(this).data('row-id'));
			});
			if (arr.length <= 0) {
				alert("Please select the item you want to delete.");
				return;
			} else {
				WRN_PROFILE_DELETE = "Are You Sure You Want To Delete" + (arr.length > 1 ? "these" : "this") + " row?";
			}
			var checked = confirm(WRN_PROFILE_DELETE);
			if (checked == true) {
				var selected_values = arr.join(",");
				var link = "{{route('users.destroy', 'id')}}";
				link = link.replace('id', selected_values);
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type: 'delete',
					url: link,
					data: 'list_id=' + selected_values,
					success: function(data) {
						console.log(data);
						if (data.success) {
							window.location.reload();
							alert(data.message);
						} else {
							alert(data.message);
						}
					}
				});
			}
		});
	});
</script>
@endpush