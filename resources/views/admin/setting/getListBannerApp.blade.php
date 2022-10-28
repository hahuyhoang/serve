@extends('adminlte::page')

@section('title','Settings')
@section('adminlte_css')
<link href ="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel = "stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@stop
@section('content_header')
    <h1>Banner Website</h1>
    <p>Manage your banner website</p>
    <div class="card-header">    	
    	<div class="card-tools">
    		<form action="{{route('admin.getListBannerApp')}}" method="get">
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
          <!-- left column -->
          <div class="col-md-5">
            <!-- general form elements -->
            <div class="card ">
            	<div class="card-header">
                <h3 class="card-title">Add New Banner App</h3>               
                
              </div>
              <!-- form start -->
              <form role="form" action="{{route('admin.createBannerApp')}}" method="post" enctype="multipart/form-data">
              	{{csrf_field()}}
                <div class="card-body">
                  <div class="form-group">
                  	<label>Title</label>
                  	<textarea class="form-control" name="title" rows="3" placeholder="Enter the title of the banner"></textarea>
                  	<span class="text-danger">{{$errors -> first('title')}}</span>
                  </div>
                  <div class="form-group">
                    <label for="">Image Banner</label>
                    <div class="form-group"  style="text-align: center;">
                    	<div  class="dt-imgs">
                    		<div class="dt-close">
                    			<div id="previews"></div>
                    		</div>
                    	</div>
                    </div>
                    <div class="abc">
                    	<div class="btn btn-default btn-file" style="background-color: #ffffff;">
                    		<i class="fa fa-paperclip"></i> Attachment
                    		<input type="file" id="avatar" name="avatar" >
                    	</div><!-- <span class="max">Max. 32MB</span> -->
                    </div>	
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </form>
            </div>

            <!-- /.card -->
          </div>
          <!--/.col (right) ------------------------------------------------------------------------------------------>
          <div class="col-md-7">
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
              				<th>Image Banner</th>
              				<th>Title</th>
              				<th>Created At</th>
              			</tr>
              		</thead>
              		<tbody>              			
              			@if(count($data_list_banner) > 0)
              			@foreach($data_list_banner as $data)
              				    				
              			<tr>
              				<td>
              					<div class="icheck-primary">
              						<input type="checkbox" value="" class="check" id="check{{$data->id}}" data-row-id="{{$data->id}}">
              						<label for="check{{$data->id}}"></label>
              					</div>
              				</td>

              				@if($data->url_img != null)
              				<td>
              					<div id = "gallery">
              						<div class = "row text-center">
              							<div class = "col-md-4">
              								<a href = "{{$data->url_img()}}"  data-toggle = "lightbox" data-gallery="gallery">
              									<img src = "{{$data->url_img()}}" class= "imggallery" width="50">
              								</a>
              							</div>
              						</div>
              					</div>
              				</td>

              				@else												
              				<td class="mailbox-subject">
              					<img src="" style="width: 50px;">
              				</td>												
              				@endif
              				<td>{{$data -> title}}</td>	              				
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
                	{!!$data_list_banner -> appends(request()->except('page')) -> links()!!}
                </div>
              </div>
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@stop
@push('js')
<script src = "https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js" crossorigin="anonymous"></script>
<script>
  $(document).on("click", '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
    $(this).ekkoLightbox();
  });
</script>
<script>
	$(function () {
    	 //Enable check and uncheck all functionality
		    $('.checkbox-toggle').click(function () {
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
		$(".delete").click(function(){
			var arr = [];
			$(".check:checked").each(function() {
				arr.push($(this).data('row-id'));
			});
			if(arr.length <= 0 ) {
				alert("Please select the item you want to delete.");
				return;
			} else {
				WRN_PROFILE_DELETE = "Are You Sure You Want To Delete"+(arr.length > 1 ? "these" : "this") + " row?";
			}
			var checked = confirm(WRN_PROFILE_DELETE);
			if(checked == true) {
				var selected_values = arr.join(",");
				var link = "{{route('admin.deleteBannerApp')}}";
				$.ajax({
					headers:{
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type:'post',
					url: link,
					data: 'list_id='+selected_values,
					success:function(data){
            console.log(data);
            if(data.success){
              window.location.reload();
              alert(data.message);
            }else{
              alert(data.message);
            }
          }
				});
			}
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#avatar').click(function(e) {
			var previews = document.getElementById('previews');
			if (previews.hasChildNodes()) {
				alert('You Can Only Choose An Image For This Item');
				e.preventDefault();
			}			
		});
		var images = function(input, imgPreview) {
			if (input.files) {
				var arr = [];
				var filesAmount = input.files.length;
				for (i = 0; i < filesAmount; i++) {
					var reader = new FileReader();
					reader.onload = function(event) {
						$('<div class="dt-close"><input type="hidden" name="image[]" value='+event.target.result+'  /></div>').append("<img class='thumb' src='"+event.target.result+"'"+"style=''>").append('<div class="deletethumb tsm"><i class="fas fa-times-circle"></i></div>').appendTo(imgPreview);;
					}
					reader.readAsDataURL(input.files[i]);
				}
			}
		};

		$('#avatar').on('change', function() {
			images(this, '#previews');
		});
            /*clear the file list when image is clicked*/
            $('body').on('click','.deletethumb',function(){
            	if(confirm("Do you want to delete this image?"))
            	{
            		$(this).parent().remove();
					$("#avatar").val(null);/* xóa tên của file trong input*/
				}
				else
					return false;
			});
        });
    </script>
@endpush