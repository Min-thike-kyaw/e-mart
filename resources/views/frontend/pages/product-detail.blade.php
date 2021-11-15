@extends('frontend.layouts.master')
@section('links')
<link rel="stylesheet" href="{{asset('frontend/css/fontawesome.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/flex-slider.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/owl.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/toolplate-main.css')}}">
@endsection
@section('content')
<div class="single-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">

            <h1>Single Product</h1>
          </div>
        </div>
        <div class="col-md-6">
          <div class="product-slider">
            <div id="slider" class="flexslider">
              <ul class="slides">
                  @php
                      $photos = explode(',',$product->photo)
                  @endphp
                  @foreach ($photos as $photo)
                    <li>
                        <img src="{{$photo}}" />
                    </li>
                  @endforeach
                <!-- items mirrored twice, total of 12 -->
              </ul>
            </div>
            <div id="carousel" class="flexslider">
              <ul class="slides">
                @foreach ($photos as $photo)
                    <li>
                        <img src="{{$photo}}" />
                    </li>
                @endforeach

                <!-- items mirrored twice, total of 12 -->
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="right-content">
            <h4>{{ucwords($product->title)}}</h4>
            <h6>${{$product->offer_price}} <span class="text-danger"><del>${{$product->price}}</del></span></h6>
            <p>{!! $product->summary!!} </p>
            <span>{{$product->stock}} left on stock</span>
            <form action="" method="get">
              <label for="quantity">Quantity:</label>
              <input name="quantity" type="quantity" class="quantity-text" id="quantity"
                  onfocus="if(this.value == '1') { this.value = ''; }"
                  onBlur="if(this.value == '') { this.value = '1';}"
                  value="1">
              <input type="submit" class="button" value="Order Now!">
            </form>
            <div class="down-content">
              <div class="categories">
                <h6>Category: <span><a href="{{route('category-product',$product->category->slug)}}">{{$product->category->title}}</a>,<a href="{{route('category-product',$product->childCategory->slug)}}">{{$product->childCategory->title}}</a></span></h6>
              </div>
              <div class="share">
                <h6>Share: <span><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-twitter"></i></a></span></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="featured-items">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h1>You May Also Like</h1>
          </div>
        </div>
        <div class="col-md-12">
          <div class="owl-carousel owl-theme">
            @foreach ($rel_products as $r_product)
            <div class="products-single fix">
            @php
                $photo = explode(',',$r_product->photo)[0];
            @endphp
                <div class="box-img-hover">
                    <div class="type-lb">
                        <p class="sale">Sale</p>
                    </div>
                    <img src='{{$photo}}' class="img-fluid" alt="Image">
                    <div class="mask-icon">
                        <ul>
                            <li><a href="{{route('product-detail',$r_product->slug)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                        </ul>
                        <a class="cart" href="#">Add to Cart</a>
                    </div>
                </div>
                <div class="why-text">
                    <h4>{{$r_product->title}}</h4>
                    <h5> ${{$r_product->price}}</h5>
                </div>
                </div>
            @endforeach

            {{-- <a href="single-product.html">
              <div class="featured-item">
                <img src="assets/images/item-02.jpg" alt="Item 2">
                <h4>Erat odio rhoncus</h4>
                <h6>$25.00</h6>
              </div>
            </a>
            <a href="single-product.html">
              <div class="featured-item">
                <img src="assets/images/item-03.jpg" alt="Item 3">
                <h4>Integer vel turpis</h4>
                <h6>$35.00</h6>
              </div>
            </a>
            <a href="single-product.html">
              <div class="featured-item">
                <img src="assets/images/item-04.jpg" alt="Item 4">
                <h4>Sed purus quam</h4>
                <h6>$45.00</h6>
              </div>
            </a>
            <a href="single-product.html">
              <div class="featured-item">
                <img src="assets/images/item-05.jpg" alt="Item 5">
                <h4>Morbi aliquet</h4>
                <h6>$55.00</h6>
              </div>
            </a>
            <a href="single-product.html">
              <div class="featured-item">
                <img src="assets/images/item-06.jpg" alt="Item 6">
                <h4>Urna ac diam</h4>
                <h6>$65.00</h6>
              </div>
            </a>
            <a href="single-product.html">
              <div class="featured-item">
                <img src="assets/images/item-04.jpg" alt="Item 7">
                <h4>Proin eget imperdiet</h4>
                <h6>$75.00</h6>
              </div>
            </a>
            <a href="single-product.html">
              <div class="featured-item">
                <img src="assets/images/item-05.jpg" alt="Item 8">
                <h4>Nullam risus nisl</h4>
                <h6>$85.00</h6>
              </div>
            </a>
            <a href="single-product.html">
              <div class="featured-item">
                <img src="assets/images/item-06.jpg" alt="Item 9">
                <h4>Cras tempus</h4>
                <h6>$95.00</h6>
              </div>
            </a> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')

<script src='{{asset("frontend/js/jquery.min.js")}}'></script>
<script src='{{asset("frontend/js/bootstrap.bundle.min.js")}}'></script>
<script src='{{asset("frontend/js/detail-custom.js")}}'></script>

<script src='{{asset("frontend/js/owl.js")}}'></script>
<script src='{{asset("frontend/js/isotope.js")}}'></script>

<script src='{{asset("frontend/js/flex-slider.js")}}'></script>
<script language = "text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t){                   //declaring the array outside of the
    if(! cleared[t.id]){                      // function makes it static and global
        cleared[t.id] = 1;  // you could use true and false, but that's more typing
        t.value='';         // with more chance of typos
        t.style.color='#fff';
        }
    }
  </script>
@endsection
