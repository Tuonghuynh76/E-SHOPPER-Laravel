@extends('frontend.layouts.app')
@section('content')
			<div class="col-sm-4" style="width: 100%;">
				<div class="signup-form"><!--sign up form-->
					<h2>New User Register!</h2>
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
						<input type="email" placeholder="Email Address" name="email" />
						<input type="password" placeholder="Password" name="password" />
						<input type="text" placeholder="Phone" name="phone" />
						<input type="text" placeholder="Address" name="address" />
						<input id="avatar" type="file" name="avatar">
						<select name="id_country" class="form-control form-control-line">
                            <option value="">Please select</option>
                            @foreach($country as $key => $value)
                            <option value="{{ $value['id'] }}">
                                {{ $value['name'] }}
                            </option>
                             @endforeach
                        </select>
						<button style="width: 45%;" type="submit" class="btn btn-default">Register</button>
						<a style="margin-top: 10px; width: 45%" href="{{url('frontend/login')}}" class="btn btn-danger">Login</a>
					</form>

				</div><!--/sign up form-->
			</div>
@endsection
