@extends('frontend.layouts.app')
@section('content')
<style>
.ul-img {
    display: flex;
    width: 50%;
    list-style: none;
    padding: 0;
}

.ul-img li {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 120px;
    margin: 0 5px;
}

.ul-img li img {
    width: 85px;
    height: 84px;
    object-fit: cover;
}

.ul-img li input {
    margin-top: 5px;
}

</style>
			<div class="col-sm-4" style="width: 100%;">
				<div class="signup-form"><!--sign up form-->
					<h2>Update Product!</h2>
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
						<input type="text" placeholder="Name" name="name" value="{{ $product['name'] }}" />
						<input type="text" placeholder="Price" name="price" value="{{ $product['price'] }}" />
						<select name="id_category" class="form-control form-control-line">
                            <option value="">Please select</option>
                            @foreach($category as $key => $value)
                            <option
                                <?php if(!empty($product['id_category']) && $value['id'] == $product['id_category']) echo "selected"?>  value="{{ $value['id'] }}"
                                >
                            {{ $value['category'] }}
                            </option>
                            @endforeach
                        </select>
                       	<select name="id_brand" class="form-control form-control-line">
                            <option value="">Please select</option>
                            @foreach($brand as $key => $value)
                            <option
                                <?php if(!empty($product['id_brand']) && $value['id'] == $product['id_brand']) echo "selected"?>  value="{{ $value['id'] }}"
                                >
                            {{ $value['brand'] }}
                            </option>
                            @endforeach
                        </select>
                        <select id="status" name="status" class="form-control form-control-line">
                            @if($product['status'] == 0)
                            <option value="0">Sale</option>
                            <option value="1">New</option>
                            @else
                            <option value="1">New</option>
                        	<option value="0">Sale</option>
                            @endif
                        </select>                    
                    	<div id="sale" style=" width: 200px">
                  			<input value="{{ $product['sale'] }}" style="width: 100px; float: left;" type="text" placeholder="Sale" name="sale">
                  			<span style="width: 100px;  height: 40px; float: left; padding: 9px 2px 0px 5px">%</span>
                    	</div>
                        <input id="avatar" type="file" name="files[]" multiple>
                            <?php
                                $img = json_decode($product['image']);
                            ?>
                        <ul class="ul-img">
                            @for($i = 0; $i < count($img); $i++)
                            <li>
                                <img  src="{{ url('/upload/product/images/'.$img[$i])}} " alt="product.png"/>
                                <input type="checkbox" name='img_delete[]' value="{{ $img[$i] }}" />
                            </li>
                            @endfor
                        </ul>
                        <input type="text" placeholder="Company Profile" name="company" value="{{ $product['company'] }}" />
                        <textarea placeholder="Detail" name="detail" rows="11">{{ $product['detail'] }}</textarea>
						<button style="width: 100%; margin-bottom: 10px" type="submit" class="btn btn-default">Update Product</button>
					</form>

				</div><!--/sign up form-->
			</div>
<script>
$(document).ready(function(){
    $("#status").change(function(){
    var status = $(this).val();
        if(status == 0) {
            $('div#sale').show();
        } else {
            $('div#sale').hide();
        }
    });
        $('#status').trigger('change');
});          
</script>
@endsection
