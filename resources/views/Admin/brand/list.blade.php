@extends('Admin.layout.app')
@section('content')
	<div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Brand</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Brand</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
       
        	@if (Session('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                        <strong>{{ Session('success') }}</strong>

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
            <form method="POST">
            @csrf

            <div class="form-group row">
                <label for="category" class="col-md-4 col-form-label text-md-right">Brand</label>
                <div class="col-md-3">
                    <input id="brand" type="text" class="form-control @error('category') is-invalid @enderror" name="brand" autofocus>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Add Brand
                    </button>
                </div>
            </div>
        </form>
        <br>
        @if (Session('deleted'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ Session('deleted') }}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($brand as $key => $value)
                                        <tr>
                                            <th scope="row">{{$key + 1}}</th>
                                            <td>{{$value['brand']}}</td>
                                            <td>
                                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/brand/'.$value['id']) }}" aria-expanded="false">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="float: right; margin-right: 10px;">
                                    {{ $brand->links('pagination::simple-bootstrap-4', ['onEachSide' => 2]) }}
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
@endsection
