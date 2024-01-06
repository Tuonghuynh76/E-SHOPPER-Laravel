@extends('frontend.layouts.app')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Step1</h2>
			</div>
			<div class="checkout-options">
				<h3>New User</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<label><input type="checkbox"> Register Account</label>
					</li>
					<li>
						<label><input type="checkbox"> Guest Checkout</label>
					</li>
					<li>
						<a href=""><i class="fa fa-times"></i>Cancel</a>
					</li>
				</ul>
			</div><!--/checkout-options-->

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->
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
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form id="sendmail" action="#" method="POST">
								@csrf
								<button type="submit" id="continueButton" class="btn btn-primary">Continue</button>
							</form>
							<form id="registerForm" action="{{url('frontend/checkout/register')}}" method="POST" style="display: none;">
								@csrf
							    <input type="text" placeholder="Email" name="email">
							    <input type="text" placeholder="User Name" name="name">
							    <input type="password" placeholder="Password" name="password">
							    <input type="address" placeholder="Address" name="address">
							    <input type="number" placeholder="Phone Number" name="phone">
							    <button id="register" type="submit" class="btn btn-primary">Register</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="idprod">#</td>
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@if(!empty($product))
							@foreach($product as $key => $value)
							<?php 
								$img = json_decode($value['image']);
							?>
						<tr>
							<td scope="row" class="idprod">{{ $key+1; }}</td>
							<td class="cart_product">
								<img style="width: 70px; height: 70px;" src="{{ url('/upload/product/images/hinh85_'.$img[0]) }}" alt="">
							</td>
							<td class="cart_description">
								<h4><a href="">{{  $value['name']; }}</a></h4>
								<p>Web ID: {{$value['id']}}</p>
							</td>
							<td class="cart_price">
								<p>${{ $value['price']; }}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{ $value['qty']; }}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">${{ $sum; }}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->
<script>
	$(document).ready(function() {
        $("#sendmail").submit(function(e) {
            e.preventDefault();
            var isLoggedIn = '{{Auth::check()}}';
            if (!isLoggedIn) {
            	alert('Vui lòng đăng nhập để tiếp tục')
                $("#registerForm").show();
                $("#sendmail").hide();
            } else {
                $(this).unbind('submit').submit();
            }
        });

    });
</script>
@endsection
