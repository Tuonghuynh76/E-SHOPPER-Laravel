@extends('frontend.layouts.app')
@section('content')

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="idprod">#</td>
							<td class="image">Item</td>
							<td class="description">Description</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@if(!empty($prod))
						<?php 
						$total = 0;
						$sum = 0;
						?>
							@foreach($prod as $key => $value)
							<?php 
								$sum = $value['qty'] * $value['price'];
								$total = $total + $sum;
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
						@else
						<h3>You don't have any product in your cart.</h3>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$@if(!empty($prod)){{$total+2}}@endif</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="{{ url('frontend/checkout') }}">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
<script>
    $(document).ready(function() {
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function downupBtn(id, qty) {
    		$.ajax({
			    type: 'POST',
			  	url: "{{url('/frontend/cart/downup')}}",
			    data: {
			        id_prod: id,
			        qty: qty
			    },
			    success: function(data) {
		        console.log(data);
			    },
			    error: function(error) {
			        console.error('Error:', error);
			    }
			});
		}
    	$('.cart_quantity_delete').click(function() {
        	var id = $(this).closest("tr").find("td.cart_description p").text().replace("Web ID: ", "")
    		if($(this)) {
    			    $.ajax({
				        type: 'POST',
			        	url: "{{url('/frontend/cart/delete')}}",
				        data: {
				            id_prod: id,
				        },
				        success: function(data) {
				            console.log(data);
				        },
				        error: function(error) {
				            console.error('Error:', error);
				        }
				    });
    		}
    	})
        $('.cart_quantity_up').click(function(e) {
            e.preventDefault();
            var id = $(this).closest("tr").find("td.cart_description p").text().replace("Web ID: ", "")
            var qty = $(this).closest("div.cart_quantity_button").find('input.cart_quantity_input').val();
            var prc = $(this).closest("tr").find("td.cart_price p").text().replace("$", "");
            var total;
            if($(this)) {
            	qty++;
            	total1 = parseInt(qty) * parseInt(prc);
            	$(this).closest("div.cart_quantity_button").find('input.cart_quantity_input').val(qty);
				$(this).closest("tr").find("p.cart_total_price").text("$" + total1);
				downupBtn(id, qty);
			}
        });

        $('.cart_quantity_down').click(function(e) {
            e.preventDefault();
            var id = $(this).closest("tr").find("td.cart_description p").text().replace("Web ID: ", "")
            var qty = $(this).closest("div.cart_quantity_button").find('input.cart_quantity_input').val();
            var prc = $(this).closest("tr").find("td.cart_price p").text().replace("$", "");
            var total;
            if($(this) && qty > 0) {
            	qty--;
            	total1 = parseInt(qty) * parseInt(prc)
            	$(this).closest("div.cart_quantity_button").find('input.cart_quantity_input').val(qty);
				$(this).closest("tr").find("p.cart_total_price").text("$" + total1);
				downupBtn(id, qty);
			}
        });
    });
</script>
@endsection
