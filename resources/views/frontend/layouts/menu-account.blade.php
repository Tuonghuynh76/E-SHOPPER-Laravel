					<div class="left-sidebar">
						<h2>My Account</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="{{ url('frontend/account') }}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Account
										</a>
									</h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#mens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											My Product
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="{{ url('frontend/account/add-product') }}">Add Product</a></li>
											<li><a href="{{ url('frontend/account/my-product') }}">My Product</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>