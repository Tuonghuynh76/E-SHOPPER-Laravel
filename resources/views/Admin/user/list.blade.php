@extends('Admin.layout.app')
@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">List User</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">List User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        @if (Session('deleted'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ Session('deleted') }}</strong>
            </div>
        @endif
        <!-- ============================================================== -->
        <!-- Start Page Content --> 
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $key => $value)
								<tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>
                                    @if ($value['avatar'])                       
                                        <img src="{{ asset('upload/user/avatar/' . $value['avatar']) }}"  alt="user"  style="width: 40px; height: 40px" />
                                    @else
                                         <img src="{{ asset('upload/user/avatar/5.jpg') }}"  alt="user"  style="width: 40px; height: 40px" />
                                    @endif
                                    	
                                    </td>
                                    <td>{{$value['name']}}</td>
                                    <td>{{$value['email']}}</td>
                               	</tr>
                               	@endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- end Container fluid  -->
@endsection
