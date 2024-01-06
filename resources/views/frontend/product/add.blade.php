@extends('frontend.layouts.app')
@section('content')
			<div class="col-sm-4" style="width: 100%;">
				<div class="signup-form"><!--sign up form-->
					<h2>New Product!</h2>
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('success')}}
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <br>
					<form action="#" method="POST" enctype="multipart/form-data">
						@csrf
						<input type="text" placeholder="Name" name="name" />
						<input type="text" placeholder="Price" name="price" />
						<select name="id_category" class="form-control form-control-line">
                            <option value="">Please select</option>
                            @foreach($category as $key => $value)
                            <option value="{{ $value['id'] }}">
                                {{ $value['category'] }}
                            </option>
                             @endforeach
                        </select>
                       	<select name="id_brand" class="form-control form-control-line">
                            <option value="">Please select</option>
                            @foreach($brand as $key => $value)
                            <option value="{{ $value['id'] }}">
                                {{ $value['brand'] }}
                            </option>
                             @endforeach
                        </select>
                        <select id="status" name="status" class="form-control form-control-line">
                        	<option value="0">Sale</option>
                        	<option value="1">New</option>
                    	</select>                    
                    	<div id="sale" style=" width: 200px">
                  			<input style="width: 100px; float: left;" type="text" placeholder="Sale" name="sale">
                  			<span style="width: 100px;  height: 40px; float: left; padding: 9px 2px 0px 5px">%</span>
                    	</div>
                        <input type="text" placeholder="Company Profile" name="company" />
                        <textarea placeholder="Detail" name="detail" rows="11"></textarea>
						<input id="avatar" type="file" name="files[]" multiple>
						<button style="width: 100%; margin-bottom: 10px;" type="submit" class="btn btn-default">Add Product</button>
					</form>

				</div><!--/sign up form-->
			</div>
<script>
$(document).ready(function(){
    $("#status").click(function(){
    var status = $(this).val();
        if(status == 1) {
            $('div#sale').css('display', 'none');
        } else {
            $('div#sale').css('display', 'block');
        }
    });
});          
</script>
@endsection
