@extends('frontend.layouts.app')
@section('content')
<style>
    .valueProd{
        padding-bottom: 13px;
        text-align: center;
    }
    .prod {
        width: 70px;
        height: 70px;
    }
    .tag {
        color: #696763;
        font-family: 'Roboto', sans-serif;
        font-size: 20px;
        font-weight: 300;
        margin-bottom: 30px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div id="cart_items" class="col-12">
            <h2 class="tag">My Product</h2>
                @if(session('deleted'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                    {{ session('deleted') }}
                </div>
                @endif
            <div class="card">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <th style="padding-bottom: 13px; text-align: center;" scope="col">#</th>
                                <th style="padding-bottom: 13px; text-align: center;" scope="col">Name</th>
                                <th style="padding-bottom: 13px; text-align: center;" scope="col">Image</th>
                                <th style="padding-bottom: 13px; text-align: center;" scope="col">Price</th>
                                <th style="padding-bottom: 13px; text-align: center;" scope="col">Status</th>
                                <th style="padding-bottom: 13px; text-align: center;" scope="col">Create at</th>
                                <th style="padding-bottom: 13px; text-align: center;" scope="col">Action</th>
                             </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $key => $value)
                            <?php
                                $img = json_decode($value['image']);
                            ?>
                            <tr>
                                <td scope="row">{{$key + 1}}</td>
                                <td class="valueProd">{{ $value['name'] }}</td>
                                <td class="valueProd">
                                    <img class="prod" src="{{ url('/upload/product/images/hinh85_'.$img[0]) }} " alt="product.jpg">
                                </td>
                                <td class="valueProd">{{ $value['price'] }}$</td>
                                <td class="valueProd">{{ $value['status'] == 0 ? 'Sale' : 'New' }}</td>
                                <td class="valueProd">{{ date('d-m-Y H:i:s', strtotime($value['created_at'])) }}</td>
                                <td class="valueProd">
                                    <a href="{{url('/frontend/account/update-product/'.$value['id'])}}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('/frontend/account/delete-product/'.$value['id'])}}" class="btn btn-danger"> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                @if($product->count() == 0)
                <div style="text-align: center;">
                    <h3>Không có sản phẩm nào! </h3>
                    <a href="{{url('frontend/account/add-product')}}" class="btn btn-danger">Thêm sản phẩm</a>
                </div>
                @endif
                    <div style="float: right; margin: 5px 10px 0 0;">
                        {{ $product->links('pagination::simple-bootstrap-4', ['onEachSide' => 2]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
