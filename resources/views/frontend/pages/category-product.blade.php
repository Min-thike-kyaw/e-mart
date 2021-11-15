@extends('frontend.layouts.master')

@section('content')
<div>
    <div class="container">
        <h1><b>Home>{{$category->title}}</b></h1>
    </div>
</div>
<div class="products-box">
    <div class="container mb-5">
        <div class="row special-list">
            @if (count($category->products) > 0)
                @foreach ($category->products->reverse()  as $product)
                <div class="col-lg-3 col-md-6 special-grid best-seller">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                <p class="sale">Sale</p>
                            </div>
                            @php
                                $photo = explode(',',$product->photo)

                            @endphp
                            <img src='{{$photo[0]}}' class="img-fluid" alt="Image">
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="{{route('product-detail',$product->slug)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                </ul>
                                <a class="cart" href="#">Add to Cart</a>
                            </div>
                        </div>
                        <div class="why-text">
                            <h4>{{ucwords($product->title)}}</h4>

                            <h6><span>Brand: </span>{{ucwords($product->brand->title)}}</h6>
                            <h5>${{$product->offer_price}} <span class="text-danger"><del>${{$product->price}}</del></span></h5>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <h1>No Product found</h1>
            @endif






        </div>
    </div>


</div>
@endsection
