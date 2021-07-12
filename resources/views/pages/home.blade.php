@extends('layouts.master')
@section('title', 'Trang Chủ')
@section('content')
<div class="site-home">
  <section class="slide-header">
    <div id="carouselExample1" class="carousel slide z-depth-1-half" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(45).jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(46).jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(47).jpg" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExample1" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Sau</span>
      </a>
      <a class="carousel-control-next" href="#carouselExample1" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Tiếp</span>
      </a>
    </div>
  </section>
  <section class="section-advertise">
    <div class="row">
      <div class="col-md-8">
        <div class="content-advertise">
          <div id="slide-advertise" class="owl-carousel">
            @foreach($data['advertises'] as $advertise)
            <div class="slide-advertise-inner" style="background-image: url('{{ Helper::get_image_advertise_url($advertise->image) }}');" data-dot="<button>{{ $advertise->title }}</button>"></div>
            @endforeach
          </div>
          <div class="custom-dots-slide-advertises"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="new-posts">
          <div class="posts-header">
            <h3 class="posts-title">TIN TỨC MỚI</h3>
          </div>
          <div class="posts-content">
            @foreach($data['posts'] as $post)
            <div class="post-item">
              <a href="{{ route('post_page', ['id' => $post->id]) }}" title="{{ $post->title }}">
                <div class="row">
                  <div class="col-md-4 col-sm-3 col-xs-3 col-xs-responsive">
                    <div class="post-item-image" style="background-image: url('{{ Helper::get_image_post_url($post->image) }}'); padding-top: 50%;"></div>
                  </div>
                  <div class="col-md-8 col-sm-9 col-xs-9 col-xs-responsive">
                    <div class="post-item-content">
                      <h4 class="post-content-title">{{ $post->title }}</h4>
                      <p class="post-content-date">{{ date_format($post->created_at, 'h:i A d/m/Y') }}</p>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-favorite-products">
    <div class="section-header">
      <h2 class="section-title">SẢN PHẨM ƯA THÍCH</h2>
    </div>
    <div class="section-content">
      <div id="slide-favorite" class="owl-carousel">
        @foreach($data['favorite_products'] as $product)
        <div class="item-product">
          <a href="{{ route('product_page', ['id' => $product->id]) }}" title="{{ $product->name }}">
            <div class="image-product" style="background-image: url('{{ Helper::get_image_product_url($product->image) }}');padding-top: 100%;">
              {!! Helper::get_promotion_percent($product->product_detail->sale_price, $product->product_detail->promotion_price, $product->product_detail->promotion_start_date, $product->product_detail->promotion_end_date) !!}
            </div>
            <div class="content-product">
              <h3 class="title">{{ $product->name }}</h3>
              <div class="start-vote">
                {!! Helper::get_start_vote($product->rate) !!}
              </div>
              <div class="price">
                {!! Helper::get_real_price($product->product_detail->sale_price, $product->product_detail->promotion_price, $product->product_detail->promotion_start_date, $product->product_detail->promotion_end_date) !!}
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  <section class="section-products">
    <div class="section-header">
      <div class="section-header-left">
      </div>
      <div class="section-header-right">
        <ul>
          @foreach($data['producers'] as $producer)
          <li><a href="{{ route('producer_page', ['id' => $producer->id]) }}" title="{{ $producer->name }}">{{ $producer->name }}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="section-content">
      <div class="row">
        @foreach($data['products'] as $key => $product)
        @if($key == 0)
        <div class="col-md-2 col-md-40">
          <div class="item-product">
            <a href="{{ route('product_page', ['id' => $product->id]) }}" title="{{ $product->name }}">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="image-product" style="background-image: url('{{ Helper::get_image_product_url($product->image) }}');padding-top: 100%;">
                    {!! Helper::get_promotion_percent($product->product_detail->sale_price, $product->product_detail->promotion_price, $product->product_detail->promotion_start_date, $product->product_detail->promotion_end_date) !!}
                  </div>
                  <div class="content-product">
                    <h3 class="title">{{ $product->name }}</h3>
                    <div class="start-vote">
                      {!! Helper::get_start_vote($product->rate) !!}
                    </div>
                    <div class="price">
                      {!! Helper::get_real_price($product->product_detail->sale_price, $product->product_detail->promotion_price, $product->product_detail->promotion_start_date, $product->product_detail->promotion_end_date) !!}
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6" style="display: flex;">
                  <div class="product-details">
                    <p><strong><i class="fas fa-tv"></i> Màn Hình: </strong>{{ $product->monitor }}</p>
                    <p><strong><i class="fas fa-camera-retro"></i> Camera: </strong>{{ $product->front_camera }}</p>
                    <p><strong><i class="fas fa-laptop"></i> Kích Thước: </strong>{{ $product->rear_camera }}</p>
                    <p><strong><i class="fas fa-microchip"></i> CPU: </strong>{{ $product->CPU }}</p>
                    <p><strong><i class="fas fa-microchip"></i>GPU: </strong>{{ $product->GPU }}</p>
                    <p><strong><i class="fas fa-hdd"></i> RAM: </strong>{{ $product->RAM }}GB</p>
                    <p><strong><i class="fas fa-hdd"></i> Bộ Nhớ Trong: </strong>{{ $product->ROM }}GB</p>
                    @if(Str::is('*Linux*', $product->OS_version))
                    <p><strong><i class="fab fa-android"></i> HĐH: </strong>{{ $product->OS_version }}</p>
                    @elseif(Str::is('*MacOS*', $product->OS_version))
                    <p><strong><i class="fab fa-apple"></i> HĐH: </strong>{{ $product->OS_version }}</p>
                    @elseif(Str::is('*Windows*', $product->OS_version))
                    <p><strong><i class="fab fa-windows"></i> HĐH: </strong>{{ $product->OS_version }}</p>
                    @endif
                    <p><strong><i class="fas fa-battery-full"></i> Dung Lượng PIN: </strong>{{ $product->pin }}</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        @else
        <div class="col-md-2 col-md-20">
          <div class="item-product">
            <a href="{{ route('product_page', ['id' => $product->id]) }}" title="{{ $product->name }}">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="image-product" style="background-image: url('{{ Helper::get_image_product_url($product->image) }}');padding-top: 100%;">
                    {!! Helper::get_promotion_percent($product->product_detail->sale_price, $product->product_detail->promotion_price, $product->product_detail->promotion_start_date, $product->product_detail->promotion_end_date) !!}
                  </div>
                  <div class="content-product">
                    <h3 class="title">{{ $product->name }}</h3>
                    <div class="start-vote">
                      {!! Helper::get_start_vote($product->rate) !!}
                    </div>
                    <div class="price">
                      {!! Helper::get_real_price($product->product_detail->sale_price, $product->product_detail->promotion_price, $product->product_detail->promotion_start_date, $product->product_detail->promotion_end_date) !!}
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 animate">
                  <div class="product-details">
                    <p><strong><i class="fas fa-tv"></i> Màn Hình: </strong>{{ $product->monitor }}</p>
                    <p><strong><i class="fas fa-camera-retro"></i> Camera: </strong>{{ $product->front_camera }}</p>
                    <p><strong><i class="fas fa-laptop"></i> Kích Thước: </strong>{{ $product->rear_camera }}</p>
                    <p><strong><i class="fas fa-microchip"></i> CPU: </strong>{{ $product->CPU }}</p>
                    <p><strong><i class="fas fa-microchip"></i>GPU: </strong>{{ $product->GPU }}</p>
                    <p><strong><i class="fas fa-hdd"></i> RAM: </strong>{{ $product->RAM }}GB</p>
                    <p><strong><i class="fas fa-hdd"></i> Bộ Nhớ Trong: </strong>{{ $product->ROM }}GB</p>
                    @if(Str::is('*Linux*', $product->OS_version))
                    <p><strong><i class="fab fa-android"></i> HĐH: </strong>{{ $product->OS_version }}</p>
                    @elseif(Str::is('*MacOS*', $product->OS_version))
                    <p><strong><i class="fab fa-apple"></i> HĐH: </strong>{{ $product->OS_version }}</p>
                    @elseif(Str::is('*Windows*', $product->OS_version))
                    <p><strong><i class="fab fa-windows"></i> HĐH: </strong>{{ $product->OS_version }}</p>
                    @endif
                    <p><strong><i class="fas fa-battery-full"></i> Dung Lượng PIN: </strong>{{ $product->pin }}</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </section>
</div>
@endsection

@section('css')
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    $("#slide-advertise").owlCarousel({
      items: 1,
      autoplay: true,
      autoplayHoverPause: true,
      loop: true,
      nav: true,
      dots: true,
      dotsData: true,
      responsive: {
        0: {
          nav: false,
          dots: false
        },
        641: {
          nav: true,
          dots: true
        }
      },
      navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
      dotsContainer: '.custom-dots-slide-advertises'
    });

    $("#slide-favorite").owlCarousel({
      items: 5,
      autoplay: true,
      autoplayHoverPause: true,
      nav: true,
      dots: false,
      responsive: {
        0: {
          items: 1,
          nav: false
        },
        480: {
          items: 2,
          nav: false
        },
        769: {
          items: 3,
          nav: true
        },
        992: {
          items: 4,
          nav: true,
        },
        1200: {
          items: 5,
          nav: true
        }
      },
      navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>']
    });

    @if(session('alert'))
    Swal.fire(
      '{{ session('
      alert ')['
      title '] }}',
      '{{ session('
      alert ')['
      content '] }}',
      '{{ session('
      alert ')['
      type '] }}'
    )
    @endif
  });
</script>
@endsection