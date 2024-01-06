    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        #error-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1500;
            text-align: center;
        }

        #error-popup ul li {
        	padding-right: 35px;
        }
        
        #error-popup h2 {
            color: #FE980F;
        }

        #close-popup {
            background-color: #FE980F;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="index.html"><img src="{{ asset('frontend/images/home/logo.png') }}" alt="" /></a>
						</div>
						<div class="btn-group pull-right clearfix">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canada</a></li>
									<li><a href="">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canadian Dollar</a></li>
									<li><a href="">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								@if(Auth::check())
									@if(Auth::user()->name)
								<li><a id="account" href="{{ url('frontend/account')}}"><i class="fa fa-user"></i> {{Auth::user()->name}}</a></li>
									@endif
								@else
								<li><a id="account" href="{{ url('frontend/account')}}"><i class="fa fa-user"></i> Account</a></li>
								@endif
								<li><a href=""><i class="fa fa-star"></i> Wishlist <sup id="qantity"></sup></a></li>
								<li><a href="{{ url('frontend/checkout') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								@if(session()->has('cart'))
								<?php
									$data = session()->get('cart');
						            $total = 0;
						        ?>
						        	@foreach ($data as $key => $value) 
						                <?php $total = $total + $value['qty'];?>
						            @endforeach
								<li><a href="{{ url('frontend/cart')}}"><i class="fa fa-shopping-cart"></i> Cart <sup id="qantity">{{$total}}</sup></a></li>
								@else
								<li><a href="{{ url('frontend/cart')}}"><i class="fa fa-shopping-cart"></i> Cart </a></li>
								@endif
								@if(Auth::check())
									@if(Auth::user()->name)
								<li><a href="{{ url('frontend/logout')}}"><i class="fa fa-lock"></i> Logout</a></li>
									@endif
								@else
								<li><a href="{{ url('frontend/login')}}"><i class="fa fa-lock"></i> Login</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ url('frontend/home') }}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="cart.html">Cart</a></li> 
										<li><a href="login.html">Login</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{ url('frontend/blog-list') }}">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="404.html">404</a></li>
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<form action="{{ url('frontend/search') }}" method="POST">
								@csrf
							    <input type="text" name="search" placeholder="Enter product name">
							    <button class="btn btn-default" type="submit">Search</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->

	@if ($errors->has('error'))

        <div id="overlay"></div>
        <div id="error-popup">
            <h2>Error!!!</h2>
            <ul>
                @foreach ($errors->all() as $error)
	            <li>{{ $errors->first('error') }}</li>
                @endforeach
            </ul>
            <button id="close-popup">Đóng</button>
        </div>
        @endif

<script> 
	$(document).ready(function() {
	    $('#account').click(function() {
	    	var checkLogin = '{{Auth::check()}}';
	        if(checkLogin == "") {
	        	alert("Vui lòng login");
	        	return false;
	    	}
	    });
        function showErrorMessage() {
            $('#overlay').fadeIn();
            $('#error-popup').fadeIn();
        }

        $('#close-popup').click(function() {
            $('#overlay').fadeOut();
            $('#error-popup').fadeOut();
        });
        showErrorMessage();

	});
</script>