@extends('layouts.master')
@section('title', 'Trang Chủ')
@section('content')
<div class="site-home">
  <section class="section-advertise">
    <div class="row">
      <div class="col-md-8">
        <section class="slide-header">
          <div id="carouselExample1" class="carousel slide z-depth-1-half" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(45).jpg" title="Đại Châu">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(46).jpg" title="Hữu Hiệp">
              </div>
              @foreach($data['advertises'] as $advertise)
              <div class="carousel-item">
                <img class="d-block w-100" width="auto" src="{{ Helper::get_image_advertise_url($advertise->image) }}" title="{{$advertise->title}}">
              </div>
              @endforeach
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
                    <div class="post-item-image" style="background-image: url('{{ Helper::get_image_post_url($post->image) }}'); padding-top: 50%;">
                    </div>
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
              {!! Helper::get_promotion_percent($product->product_detail->sale_price,
              $product->product_detail->promotion_price, $product->product_detail->promotion_start_date,
              $product->product_detail->promotion_end_date) !!}
            </div>
            <div class="content-product">
              <h3 class="title">{{ $product->name }}</h3>
              <div class="start-vote">
                {!! Helper::get_start_vote($product->rate) !!}
              </div>
              <div class="price">
                {!! Helper::get_real_price($product->product_detail->sale_price,
                $product->product_detail->promotion_price, $product->product_detail->promotion_start_date,
                $product->product_detail->promotion_end_date) !!}
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
                    {!! Helper::get_promotion_percent($product->product_detail->sale_price,
                    $product->product_detail->promotion_price, $product->product_detail->promotion_start_date,
                    $product->product_detail->promotion_end_date) !!}
                  </div>
                  <div class="content-product">
                    <h3 class="title">{{ $product->name }}</h3>
                    <div class="start-vote">
                      {!! Helper::get_start_vote($product->rate) !!}
                    </div>
                    <div class="price">
                      {!! Helper::get_real_price($product->product_detail->sale_price,
                      $product->product_detail->promotion_price, $product->product_detail->promotion_start_date,
                      $product->product_detail->promotion_end_date) !!}
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6" style="display: flex;">
                  <div class="product-details">
                    <p><strong><i class="fas fa-microchip"></i> Năng suất: </strong>{{ $product->productivity }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Điện áp: </strong>{{ $product->vol }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Công suất: </strong>{{ $product->wat }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Bạc đạn: </strong>{{ $product->bearings }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Tốc độ quay: </strong>{{ $product->speed }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Trọng lượng: </strong>{{ $product->weight }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Kích thước: </strong>{{ $product->size }}GB</p>
                    <p><strong><i class="fas fa-microchip"></i> Model: </strong>{{ $product->model }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Bảo hành: </strong>{{ $product->insurance }}</p>
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
                    {!! Helper::get_promotion_percent($product->product_detail->sale_price,
                    $product->product_detail->promotion_price, $product->product_detail->promotion_start_date,
                    $product->product_detail->promotion_end_date) !!}
                  </div>
                  <div class="content-product">
                    <h3 class="title">{{ $product->name }}</h3>
                    <div class="start-vote">
                      {!! Helper::get_start_vote($product->rate) !!}
                    </div>
                    <div class="price">
                      {!! Helper::get_real_price($product->product_detail->sale_price,
                      $product->product_detail->promotion_price, $product->product_detail->promotion_start_date,
                      $product->product_detail->promotion_end_date) !!}
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 animate">
                  <div class="product-details">
                  <p><strong><i class="fas fa-microchip"></i> Năng suất: </strong>{{ $product->productivity }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Điện áp: </strong>{{ $product->vol }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Công suất: </strong>{{ $product->wat }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Bạc đạn: </strong>{{ $product->bearings }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Tốc độ quay: </strong>{{ $product->speed }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Trọng lượng: </strong>{{ $product->weight }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Kích thước: </strong>{{ $product->size }}GB</p>
                    <p><strong><i class="fas fa-microchip"></i> Model: </strong>{{ $product->model }}</p>
                    <p><strong><i class="fas fa-microchip"></i> Bảo hành: </strong>{{ $product->insurance }}</p>
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
  });
</script>
@if(session('alert') != null)
<script>
  Swal.fire(title = "{{ session('alert')['title'] }}", content = "{{ session('alert')['content'] }}", type = "{{ session('alert')['type'] }}");
</script>
@endif
@endsection