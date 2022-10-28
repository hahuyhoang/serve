@extends('adminlte::page')
<!-- php -->
@php
$content_header = ($data_product == null) ? 'Create product':'Edit product';
$button = ($data_product == null) ? 'Add':'Update';
$action_form = ($data_product == null) ? route('admin.product.store'):route('admin.product.update',$data_product->id);
@endphp
<!-- end php -->

@section('title',$content_header)
@section('adminlte_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('vendor/select2/css/select2.css')}}">
<link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<script src="//cdn.ckeditor.com/4.10.1/basic/ckeditor.js"></script>
@stop
@section('content_header')
<h1>{{$content_header}}</h1>
<p>Manage your {{$content_header}}</p>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-7">
                <!-- general form elements -->
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">{{$content_header}}</h3>
                    </div>
                    <!-- form start -->
                    <form role="form" action="{{$action_form}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{($data_product == null) ? old('name'):$data_product->name}}" autocomplete="null">
                                <span class="text-danger">{{$errors -> first('name')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter title" value="{{($data_product == null) ? old('title'):$data_product->title}}" autocomplete="null">
                                <span class="text-danger">{{$errors -> first('title')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <div class="select2-purple">
                                    <select class="select2" multiple="multiple" data-placeholder="Select category" data-dropdown-css-class="select2-purple" style="width: 100%;" name="category[]">
                                        @foreach($list_category as $category)
                                        <option value="{{$category->id}}" @if($data_product !=null) @foreach($data_product -> product_category as $val)
                                            {{($val -> id == $category -> id) ? 'selected':''}}
                                            @endforeach
                                            @else
                                            @if(old('category'))
                                            @foreach(old('category') as $val)
                                            {{($val == $category -> id) ? 'selected':''}}
                                            @endforeach
                                            @endif
                                            @endif
                                            >{{ $category->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">{{$errors -> first('category')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Brand</label>
                                <div class="select2-purple">
                                    <select class="select2-brand" multiple="multiple" data-placeholder="Select brand" data-dropdown-css-class="select2-purple" style="width: 100%;" name="brand[]">
                                        @foreach($list_brand as $brand)
                                        <option value="{{$brand->id}}" @if($data_product !=null) @foreach($data_product -> product_brand as $val)
                                            {{($val -> id == $brand -> id) ? 'selected':''}}
                                            @endforeach
                                            @else
                                            @if(old('brand'))
                                            @foreach(old('brand') as $val)
                                            {{($val == $brand -> id) ? 'selected':''}}
                                            @endforeach
                                            @endif
                                            @endif
                                            >{{ $brand->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">{{$errors -> first('brand')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea class="form-control" name="description">{{($data_product == null) ? old('description'):$data_product->description}}</textarea>
                                <span class="text-danger">{{$errors -> first('description')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="number" class="form-control" name="price" placeholder="Enter price" value="{{($data_product == null) ? old('price'):$data_product->price}}" autocomplete="null" step="0.01">
                                <span class="text-danger">{{$errors -> first('price')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control select2bs4" style="width: 100%;" name='status'>
                                    <option value="1" @if($data_product !=null) {{($data_product -> status == 1) ? 'selected':''}} @endif>Active</option>
                                    <option value="0" @if($data_product !=null) {{($data_product -> status == 0) ? 'selected':''}} @endif>InActive</option>

                                </select>
                                <span class="text-danger">{{$errors -> first('status')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="">Product Image</label>
                                <div class="form-group" style="text-align: center;">
                                    <div class="dt-imgs">
                                        <div class="dt-close">
                                            @if($data_product !=null)
                                            <div id="previews1">@if($data_product->media_id !=null)<div class="gallerythumb">
                                                    <img class="thumb" src="{{$data_product->media->url_media}}" class="pic">
                                                    <div class="deletethumb"><i class="fas fa-times-circle"></i></div>
                                                </div>@endif</div>
                                            @else
                                            <div id="previews1"></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="abc">
                                    <div class="btn btn-default btn-file" style="background-color: #ffffff;">
                                        <i class="fa fa-paperclip"></i> Attachment
                                        <input type="file" id="avatar" name="avatar">
                                    </div>
                                </div>
                                <span class="text-danger">{{$errors -> first('thumbnail')}}</span>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{$button}}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@stop
@push('js')
<script type="text/javascript" src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function () {
         $('.select2').select2()
    })
    $(function () {
         $('.select2-brand').select2()
    })
</script>
<script>
    CKEDITOR.replace('description');
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#avatar').click(function(e) {
            var previews = document.getElementById('previews1');
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
                        $('<div class="dt-close"><input type="hidden" name="thumbnail[]" value=' + event.target.result + '  /></div>').append("<img class='thumb' src='" + event.target.result + "'" + "style=''>").append('<div class="deletethumb tsm"><i class="fas fa-times-circle"></i></div>').appendTo(imgPreview);;
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };

        $('#avatar').on('change', function() {
            images(this, '#previews1');
        });
        /*clear the file list when image is clicked*/
        $('body').on('click', '.deletethumb', function() {
            if (confirm("Do you want to delete this image?")) {
                $(this).parent().remove();
                $("#avatar").val(null); /* xóa tên của file trong input*/
            } else
                return false;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var images = function(input, imgPreview) {
            if (input.files) {
                var arr = [];
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $('<div class="thumb dt-height"><input type="hidden" name="image[]" value=' + event.target.result + ' /></div>').append("<img src='" + event.target.result + "'" + "style=''>").append('<div class="deletegallery" style="right:-5px;"><i class="fas fa-times-circle"></i></div>').appendTo(imgPreview);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };

        $('#file').on('change', function() {
            images(this, '#previews');
        });
        //clear the file list when image is clicked
        $('body').on('click', '.deletegallery', function() {
            if (confirm("Do you want to delete the photo?")) {
                $(this).parent().remove();
                $("#file").val(null); //xóa tên của file trong input
            } else
                return false;
        });
    });
</script>
@endpush