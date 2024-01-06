<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<style type="text/css">
.demo {
    margin: 20px;
    padding: 20px;
    border: 1px solid #ccc;
}

.demo p {
    margin: 0;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.cart_menu {
    background-color: #FE980F;
    color: #fff;
    font-size: 16px;
    font-family: 'Roboto', sans-serif;
    font-weight: normal;
}

.table tbody tr {
    border-bottom: 1px solid #ddd;
}

.table td {
    padding: 10px;
    text-align: center;
}

.cart_product img {
    max-width: 70px;
    max-height: 70px;
}

.total-result {
    width: 100%;
}

.total-result tr {
    border-bottom: 1px solid #ddd;
}

.cart_total_price {
    font-weight: bold;
}

.cart_quantity_delete {
    color: #ff0000;
    cursor: pointer;
}

@media (max-width: 767px) {
    .table thead {
        display: none;
    }

    .table tbody, .table th, .table td {
        display: block;
        width: 100%;
        box-sizing: border-box;
    }

    .table td {
        text-align: left;
        padding: 10px;
        margin-bottom: 5px;
    }

    .cart_product img {
        max-width: 50px;
        max-height: 50px;
    }
}
    </style>
</head>
<body>
 			<div class="demo">
 				<?php 
 					$user = $data['user']->toArray();
 				?>
 				<p>Thông tin khách hàng:</p>
		        <p>Full name: {{ $user['name'] }}</p>
		        <p>Phone: {{ $user['phone'] }}</p>
		        <p>Address: {{ $user['address'] }}</p>
				<p></p>
				<p></p>
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
							@foreach($data['body'] as $key => $value)
							<?php 
								$img = json_decode($value['image']);
							?>
						<tr>
							<td scope="row" class="idprod">{{ $key+1; }}</td>
							<td class="cart_product">
								<img style="width: 70px; height: 70px;" src="{{ url('/upload/product/images/hinh85_'.$img[0]) }}" alt="product">
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
									<input class="cart_quantity_input" type="text" name="quantity" value="{{ $value['qty']; }}" autocomplete="off" size="2">
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">${{ $value['price'] * $value['qty']; }}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
							@endforeach
						<td colspan="4">&nbsp;</td>
						<td colspan="2">
							<table class="table table-condensed total-result">
								<tr class="shipping-cost">
									<td>Shipping Cost</td>
									<td>Free</td>										
								</tr>
								<tr>
									<td>Total</td>
									<td>$<span class="cart_total_price">{{ $data['sum'] }}</span></td>
								</tr>
							</table>
						</td>
					</tbody>
				</table>
			</div>
</body>
</html>