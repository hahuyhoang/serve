@extends('adminlte::page')

@section('title','User Package')
@section('adminlte_css')
@stop
@section('content_header')
    <h1>List Users Package</h1>
    <p>Manage your user package</p>
    <div class="card-header">    	
    	<div class="card-tools">
    		<form action="{{route('users.list_user_package')}}" method="get">
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

                <div class="card-tools">
                	{{$start}}-{{$record}}/{{$total_record}}
                	<div class="btn-group float-right">
                		<button type="button" class="btn btn-default btn-sm left" <?php if(!isset($_GET['page'])){echo "disabled";}?>>
                			<i class="fa fa-chevron-left "></i>
                		</button>
                		<button type="button" class="btn btn-default btn-sm right" <?php if(isset($_GET['page']) && $_GET['page'] > 0){if($_GET['page'] >= ceil($total_record/$numb_paginate)){echo "disabled";}}?>>
                			<i class="fa fa-chevron-right "></i>
                		</button>
                	</div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0  mailbox-messages">
              	<table class="table table-hover ">
              		<thead>
              			<tr>
              				<th>User Name</th>
                      <th>Phone</th>
              				<th>Package</th>
              				<th>Active date</th>
                      <th>Expiration Date</th>
              			</tr>
              		</thead>
              		<tbody>              			
              			@if(count($data_list_user_package) > 0)
              			@foreach($data_list_user_package as $data)
              				    				
              			<tr>
              				<td><a href="{{route('users.edit',['user'=>$data ->user->id])}}">{{$data->user->name}}</a></td>              				
                      <td>{{$data ->user->phone}}</td>
                      <td>{{$data ->package->name}}</td>
              				<td>{{$data -> active_date}}</td>
                      <td>{{$data -> expiration_date}}</td>
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
                	{!!$data_list_user_package -> appends(request()->except('page')) -> links()!!}
                </div>
              </div>
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@stop
@push('js')
<script type="text/javascript">
	/*paginate ********************** //*/

	$(".left").click(function(){
		var pg = @if(isset($_GET['page'])){{$_GET['page']}}@else{{'1'}}@endif;
		var kw = $('#keyword').val();
		if(kw != ''){
			var key = '&keyword=' +(kw);
		}else{
			var key = "";
		}
		if(pg == 1){
			var str_page = "?page=1";
		}else{
			if(pg >= 2){
				var str_page = "?page=" + (pg - 1);
			}else{
				var str_page = "";
			}
		}
		var current_link = <?php echo "'".strtok($_SERVER["REQUEST_URI"],'?')."'";?>;
		window.location.href = current_link + str_page + key;
	});

	$(".right").click(function(){
		var pg = @if(isset($_GET['page'])){{$_GET['page']}}@else{{'1'}}@endif;
		var kw = $('#keyword').val();
		if(kw != ''){
			var key = '&keyword=' +(kw);
		}else{
			var key = "";
		}
		var page_paginate = <?php $page_paginate = ceil($total_record/$numb_paginate); echo $page_paginate; ?>;
		if((pg + 1)>page_paginate){
			var str_page = "?page=" + (pg);
			
		}else{
			var str_page = "?page=" + (pg + 1);
		}


		var current_link = <?php echo "'".strtok($_SERVER["REQUEST_URI"],'?')."'";?>;
		window.location.href = current_link + str_page + key;
	});
</script>
@endpush