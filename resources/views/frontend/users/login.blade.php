@extends('frontend.layouts.app')
@section('content')
				<div style="width: 50%;" class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
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
						<form action="#" method="POST">
							@csrf
							<input type="text" placeholder="Email" name="email" />
							<input type="password" placeholder="Password" name="password" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<div>
							<button style=" width: 100%" type="submit" class="btn btn-default">Login</button>
							<a style="margin-top: 10px; width: 100%" href="{{url('frontend/register')}}" class="btn btn-danger">Register</a>
							</div>
						</form>
					</div><!--/login form-->
				</div>
@endsection
