@extends('adminlte::page')
<!-- php -->
@php
$content_header = ($data_user == null) ? 'Create User':'Edit User';
$button = ($data_user == null) ? 'Add':'Update';
$action_form =  ($data_user == null) ? route('users.store'):route('users.update',['user'=>$data_user->id]);
@endphp
<!-- end php -->

@section('title',$content_header)
@section('adminlte_css')
<link href ="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel = "stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('public/vendor/select2/css/select2.css')}}">
<link rel="stylesheet" href="{{asset('public/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/css/prism.css')}}">
<link rel="stylesheet" href="{{asset('public/css/intlTelInput.css')}}">
<link rel="stylesheet" href="{{asset('public/css/isValidNumber.css')}}">
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
                        @if($data_user != null)
                        @method('PUT')
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{($data_user == null) ? old('name'):$data_user->name}}" autocomplete="null">
                                <span class="text-danger">{{$errors -> first('name')}}</span>
                            </div>
                            {{--<div class="form-group">
                                <label for="exampleInputEmail1">User Name</label>
                                <input type="text" class="form-control" name="user_name" placeholder="Enter user name" value="{{($data_user == null) ? old('user_name'):$data_user->user_name}}" >
                                <span class="text-danger">{{$errors -> first('user_name')}}</span>
                            </div>--}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{($data_user == null) ? old('email'):$data_user->email}}" >
                                <span class="text-danger">{{$errors -> first('email')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter address" value="{{($data_user == null) ? old('address'):$data_user->address}}" >
                                <span class="text-danger">{{$errors -> first('address')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Birthday</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="datemask" name="birthday" value="{{($data_user == null) ? old('birthday'): date("d-m-Y",strtotime($data_user->birthday))}}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask >                                    
                                </div>
                                <span class="text-danger">{{$errors -> first('birthday')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="tel" class="form-control" id="phone_login" value="{{($data_user == null) ? old('phone'):$data_user->phone}}" placeholder="Điện Thoại" autocomplete="off" data-parsley-required data-parsley-minlength="10">
                                <input type="hidden" class="addphoneuser" id="addphoneuser_login" name="phone" value="{{($data_user == null) ? old('phone'):$data_user->phone}}">
                                <span id="valid-login" class="hide2">✓ Hợp lệ</span>
                                <span id="error-login" class="hide2"></span>
                                <span class="text-danger">{{$errors -> first('phone')}}</span>
                            </div>

                            @if($data_user == null)
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter password" value="{{old('password')}}">
                                <span class="text-danger">{{$errors -> first('password')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                <input type="password" class="form-control" name="re_password" placeholder="Enter confirm password" value="{{old('re_password')}}">
                                <span class="text-danger">{{$errors -> first('re_password')}}</span>
                            </div>
                            @endif

                            
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control select2bs4" style="width: 100%;" name='role_id'>
                                    @foreach($list_role as $data_role)
                                    <option  value="{{$data_role -> id}}" 
                                        @if($data_user != null)
                                        {{($data_user -> role_id == $data_role -> id) ? 'selected':''}}
                                        @else
                                        {{(old('role_id') == $data_role -> id) ? 'selected':''}}
                                        @endif
                                        >{{$data_role -> name}}</option>
                                        @endforeach                                   
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>User Package</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name='package_id' id="package_id">
                                        <option value="" selected="selected">None Package</option>
                                        @foreach($list_package as $data_package)
                                        <option  value="{{$data_package -> id}}" 
                                            @if($data_user != null)
                                                @if($data_user->CheckUserPackage())
                                                    {{($data_user->CheckUserPackage()->package_id == $data_package -> id) ? 'selected':''}}
                                                @endif
                                            @else
                                                {{(old('data_package') == $data_package -> id) ? 'selected':''}}
                                            @endif
                                            >{{$data_package -> name}}</option>
                                            @endforeach                                   
                                        </select>
                                    </div>
                                    @php
                                    if($data_user != null){
                                        if($data_user->CheckUserPackage()){
                                            $style = 'list-style: none; display: block';
                                            $number_day = $data_user->CheckDayPackage;
                                        }else{
                                            $style = 'list-style: none; display: none';
                                            $number_day = $data_user->CheckDayPackage;
                                        }
                                    }else{
                                        $style = 'list-style: none; display: none';
                                        $number_day = '';
                                    }
                                        
                                    @endphp

                                    <div class="form-group" id="group" style="{{$style}}">
                                        <label>Number Day Use Package</label>
                                        <input type="text"  class="form-control" name="number_day" placeholder="Enter number day" value="{{($data_user == null) ? old('number_day'):$number_day}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Avatar</label>
                                        <div class="form-group"  style="text-align: center;">
                                            <div  class="dt-imgs">                                      
                                                <div class="dt-close">
                                                    @if($data_user !=null)
                                                    <div id="previews">@if($data_user->avatar !=null)<div class="gallerythumb">
                                                        <img class="thumb" src="{{$data_user->UrlAvatar}}" class="pic" >
                                                        <div class="deletethumb tsm"><i class="fas fa-times-circle"></i></div>
                                                        <input type="hidden" name="id_img[]" value="{{$data_user->UrlAvatar}}">
                                                    </div>@endif</div>
                                                    @else
                                                    <div id="previews"></div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="abc">
                                            <div class="btn btn-default btn-file" style="background-color: #ffffff;">
                                                <i class="fa fa-paperclip"></i> Attachment
                                                <input type="file" id="avatar" name="avatar" >
                                            </div>
                                        </div>	
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" id="submit" class="btn btn-primary">{{$button}}</button>
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
        <script type="text/javascript" src="{{asset('public/vendor/select2/js/select2.full.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('public/vendor/moment/moment.min.js')}}"></script>
    <script src="{{asset('public/vendor/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>

    <script src="{{asset('public/js/intl-tel-input/prism.js')}}"></script>
    <script src="{{asset('public/js/intl-tel-input/intlTelInput.js')}}"></script>
    <script src="{{asset('public/js/intl-tel-input/utils.js')}}"></script>
        <script>

            $(function () {
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })
                //Datemask dd/mm/yyyy
                $('#datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })

                $("#package_id").change(function(){
                    var val_package_id =  $(this).val();
                    if(val_package_id){
                        $('#group').css("display","block");
                    }else{
                        $('#group').css("display","none");
                    }
                });
                $("#package_id").click(function(){
                    var val_package_id =  $(this).val();
                    if(val_package_id){
                        $('#group').css("display","block");
                    }else{
                        $('#group').css("display","none");
                    }
                });

            })
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
            if(confirm("Do you want to delete this image?")){
                $(this).parent().remove();
                $("#avatar").val(null);/* xóa tên của file trong input*/
            }else{                
                return false;
            }
        });
      });
  </script>
<script type="text/javascript">
    var input = document.querySelector("#phone_login"),
      addphoneuser = document.querySelector("#addphoneuser_login"),
      errorMsg = document.querySelector("#error-login"),
      validMsg = document.querySelector("#valid-login");

      // here, the index maps to the error code returned from getValidationError - see readme
      var errorMap = [ "Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

      // initialise plugin
      var iti = window.intlTelInput(input, {
        nationalMode: true,
        utilsScript: "js/intl-tel-input/utils.js"
      });
      /*lấy mã quốc gia + số đt*/
      var handleChange = function() {
        var phone_national = (iti.isValidNumber()) ? iti.getNumber() : "";
        $('#addphoneuser_login').val(phone_national);
      };

      // listen to "keyup", but also "change" to update when the user selects a country
      input.addEventListener('change', handleChange);
      input.addEventListener('keyup', handleChange);
      /*end lấy mã quốc gia + số đt*/
      
      var reset = function() {
        input.classList.remove("error");
        errorMsg.innerHTML = "";
        errorMsg.classList.add("hide2");
        validMsg.classList.add("hide2");
      };

      // on blur: validate
      input.addEventListener('blur', function() {
        reset();
        if (input.value.trim()) {
          if (iti.isValidNumber()) {
            validMsg.classList.remove("hide2");
            $('#submit').attr('disabled',false);
          } else {
            input.classList.add("error");
            var errorCode = iti.getValidationError();
            errorMsg.innerHTML = errorMap[errorCode];
            errorMsg.classList.remove("hide2");      
            $('#submit').attr('disabled',true);
          }
        }
      });

      // on keyup / change flag: reset
      input.addEventListener('change', reset);
      input.addEventListener('keyup', reset);
      //phone null
      // $("#phone").keyup(function(){
      //   if($(this).val()==''){
      //     $('#submit').attr('disabled',false);
      //   }
      //   else
      //   {
      //     $('#submit').attr('disabled',false);
      //   }
      // });
</script>
  @endpush