@extends('frontend.layouts.app')
@section('content')
        <div style="width: 100%;" class="col-sm-4">
            <div class="signup-form">
                <h2>Account Update</h2>
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
                <form action="#" method="POST" encType="multipart/form-data" >
                	@csrf
						<input type="text" placeholder="Name" name="name" value="{{ $user['name'] }}" />
						<input type="email" placeholder="Email Address" name="email" value="{{ $user['email'] }}"/>
						<input type="password" placeholder="Password" name="password" />
						<input type="text" placeholder="Phone" name="phone" value="{{ $user['phone'] }}"/>
						<input type="text" placeholder="Address" name="address" value="{{ $user['address'] }}"/>
						<select name="id_country" class="form-control form-control-line">
                            <option value="">Please select</option>
                            @foreach($country as $key => $value)
                            <option value="{{ $value['id'] }}">
                                {{ $value['name'] }}
                            </option>
                             @endforeach
                        </select>
						<input id="avatar" type="file" name="avatar">
                    <button type="submit" class="btn btn-default">Update</button>
                </form>
            </div>
        </div>
@endsection