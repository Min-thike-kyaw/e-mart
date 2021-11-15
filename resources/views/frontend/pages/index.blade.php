@extends('frontend.layouts.master')


@section('content')
<div id="slides-shop" class="cover-slides">
    <ul class="slides-container">
        @foreach ($banners as $banner)
            <li class="text-left">
                <img src='{{$banner->photo}}' alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>{{$banner->title}}</strong></h1>
                            <p class="m-b-40">{!!$banner->description!!}</p>
                            <p><a class="btn hvr-hover" href="#">Shop New</a></p>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach

        {{-- <li class="text-center">
            <img src='{{asset("frontend/images/banner-02.jpg")}}' alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Thewayshop</strong></h1>
                        <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        <p><a class="btn hvr-hover" href="#">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
        <li class="text-right">
            <img src='{{asset("frontend/images/banner-03.jpg")}}' alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Thewayshop</strong></h1>
                        <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        <p><a class="btn hvr-hover" href="#">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li> --}}
    </ul>
    <div class="slides-navigation">
        <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
</div>
<!-- End Slider -->

<!-- Start Categories  -->
<div class="categories-shop">
    <div class="container">
        <div class="row">
            @foreach ($categories as $cat)
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                        <img class="img-fluid" style="max-height: 300px" src='{{$cat->photo}}' alt="" />
                        <a class="btn hvr-hover" href="{{route('category-product',$cat->slug)}}">{{$cat->title}}</a>
                    </div>
                </div>
            @endforeach

            {{-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src='{{asset("frontend/images/wallet-img.jpg")}}' alt="" />
                    <a class="btn hvr-hover" href="#">Wallet</a>
                </div>
                <div class="shop-cat-box">
                    <img class="img-fluid" src='{{asset("frontend/images/women-bag-img.jpg")}}' alt="" />
                    <a class="btn hvr-hover" href="#">Bags</a>
                </div>
            </div> --}}
            {{-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src='{{asset("frontend/images/shoes-img.jpg")}}' alt="" />
                    <a class="btn hvr-hover" href="#">Shoes</a>
                </div>
                <div class="shop-cat-box">
                    <img class="img-fluid" src='{{asset("frontend/images/women-shoes-img.jpg")}}' alt="" />
                    <a class="btn hvr-hover" href="#">Women Shoes</a>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!-- End Categories -->

<!-- Start Products  -->
<div class="products-box">
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-left">
                    <h1 class="text-danger">Popular Products</h1>
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p> --}}
                </div>
            </div>
        </div>

        <div class="row special-list">
            @foreach (\App\Models\Product::where(['status' => 'active', 'condition' => 'new', 'condition' => 'popular'])->orderBy('id','DESC')->limit(4)->get() as $product)
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





        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-left">
                    <h1 class="text-danger">New Products</h1>
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p> --}}
                </div>
            </div>
        </div>

        <div class="row special-list">
            @foreach (\App\Models\Product::where(['status' => 'active', 'condition' => 'new' , 'condition' => 'new'])->orderBy('id','DESC')->limit(4)->get() as $product)
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





        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-left">
                    <h1 class="text-danger">Winter Products</h1>
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p> --}}
                </div>
            </div>
        </div>

        <div class="row special-list">
            @foreach (\App\Models\Product::where(['status' => 'active', 'condition' => 'new', 'condition' => 'winter'])->orderBy('id','DESC')->limit(4)->get() as $product)
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





        </div>
    </div>
</div>
<!-- End Products  -->

<!-- Start Blog  -->
<div class="latest-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>latest blog</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="blog-box">
                    <div class="blog-img">
                        <img class="img-fluid" src='{{asset("frontend/images/blog-img.jpg")}}' alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="title-blog">
                            <h3>Fusce in augue non nisi fringilla</h3>
                            <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis. Praesent laoreet lacinia elit id lobortis.</p>
                        </div>
                        <ul class="option-blog">
                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Likes"><i class="far fa-heart"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Views"><i class="fas fa-eye"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Comments"><i class="far fa-comments"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="blog-box">
                    <div class="blog-img">
                        <img class="img-fluid" src='{{asset("frontend/images/blog-img-01.jpg")}}' alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="title-blog">
                            <h3>Fusce in augue non nisi fringilla</h3>
                            <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis. Praesent laoreet lacinia elit id lobortis.</p>
                        </div>
                        <ul class="option-blog">
                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Likes"><i class="far fa-heart"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Views"><i class="fas fa-eye"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Comments"><i class="far fa-comments"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="blog-box">
                    <div class="blog-img">
                        <img class="img-fluid" src='{{asset("frontend/images/blog-img-02.jpg")}}' alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="title-blog">
                            <h3>Fusce in augue non nisi fringilla</h3>
                            <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis. Praesent laoreet lacinia elit id lobortis.</p>
                        </div>
                        <ul class="option-blog">
                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Likes"><i class="far fa-heart"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Views"><i class="fas fa-eye"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Comments"><i class="far fa-comments"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Blog  -->


<!-- Start Instagram Feed  -->
<div class="instagram-box">
    <div class="main-instagram owl-carousel owl-theme">
        <div class="item">
            <div class="ins-inner-box">
                <img src='{{asset("frontend/images/instagram-img-01.jpg")}}' alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src='{{asset("frontend/images/instagram-img-02.jpg")}}' alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src='{{asset("frontend/images/instagram-img-03.jpg")}}' alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src='{{asset("frontend/images/instagram-img-04.jpg")}}' alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src='{{asset("frontend/images/instagram-img-05.jpg")}}' alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src='{{asset("frontend/images/instagram-img-06.jpg")}}' alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src='{{asset("frontend/images/instagram-img-07.jpg")}}' alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src='{{asset("frontend/images/instagram-img-08.jpg")}}' alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src='{{asset("frontend/images/instagram-img-09.jpg")}}' alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src='{{asset("frontend/images/instagram-img-05.jpg")}}' alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Instagram Feed  -->


@endsection
