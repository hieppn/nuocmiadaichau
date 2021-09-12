@extends('layouts.master')

@section('title', 'Sản Phẩm')

@section('content')

<section class="bread-crumb">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home_page') }}">{{ __('header.Home') }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Sản Phẩm</li>
    </ol>
  </nav>
</section>

<div class="site-products">
  <section class="section-advertise">
    <div class="content-advertise">
      <div id="slide-advertise" class="owl-carousel">
        @foreach($data['advertises'] as $advertise)
        <div class="slide-advertise-inner" style="background-image: url('{{ Helper::get_image_advertise_url($advertise->image) }}');" data-dot="<button>{{ $advertise->title }}</button>"></div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="section-filter">
    <div class="section-header">
      <h2 class="section-title">Tìm Kiếm Và Sắp Xếp</h2>
    </div>
    <div class="section-content">
      <form action="{{ route('products_page') }}" method="GET" accept-charset="utf-8">
        <div class="row">
          <div class="col-md-10">
            <div class="row">
              <div class="col-md-3 col-sm-6 col-xs-6">
                <input type="text" name="name" placeholder="Tìm kiếm..." value="{{ Request::input('name') }}">
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6">
                <select name='model'>
                  <option value='' {{ Request::input('model') == null ? 'selected' : '' }}>
                    Model
                  </option>
                  <option value="1" {{ Request::input('model') == '1' ? 'selected' : '' }}>Dòng máy siêu sạch phổ thông chuyên dụng cho lượng khách trung bình khá như khách vãng lai, hàng xóm, chợ</option>
                  <option value="2" {{ Request::input('model') == '2' ? 'selected' : '' }}>Dòng máy ép mía siêu sạch cao cấp chuyên dụng cho lượng khách khá và tương đối đông khách như căn tin, trường học</option>
                  <option value="3" {{ Request::input('model') == '3' ? 'selected' : '' }}>Dòng máy ép mía siêu sạch công nghiệp siêu cấp chuyên dụng cho lượng khách như công ty, siêu thị, hội chợ, nhà hát</option>
                  <option value="4" {{ Request::input('model') == '4' ? 'selected' : '' }}>Dòng xe nước mía siêu sạch phổ thông dụng lượng khách trung bình khá như vãng lai, hàng xóm, chợ</option>
                  <option value="5" {{ Request::input('model') == '5' ? 'selected' : '' }}>Dòng xe nước mía siêu sạch cao cấp thông dụng lượng khánh khá và tương đối đông khách như trường học, căn tin</option>
                  <option value="6" {{ Request::input('model') == '6' ? 'selected' : '' }}>Dòng xe nước mía siêu sạch công nghiệp siêu cấp pro dành cho lượng khách công ty, siêu thị, hội chợ, nhà hát</option>
                  <option value="7" {{ Request::input('model') == '7' ? 'selected' : '' }}>Dòng xe nước mía siêu sạch nửa bàn và liền bàn không tủ kính từ phổ thông tới công nghiệp siêu cấp</option>
                  <option value="8" {{ Request::input('model') == '8' ? 'selected' : '' }}>Dòng xe tay quay truyền thống 2rulo nhôm dành cho kinh doanh giá rẻ dành cho khách hàng chuộng thức uống có tạo bọt</option>
                  <option value="9" {{ Request::input('model') == '9' ? 'selected' : '' }}>Dòng xe tay quay hiện đại siêu cấp bật nhất thị trường 2 rulo inox không bay màu rỉ sét theo thời gian</option>
              
                </select>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6">
                <select name='price'>
                  <option value='' {{ Request::input('price') == null ? 'selected' : '' }}>
                    Giá Sản Phẩm
                  </option>
                  <option value='asc' {{ Request::input('price') == 'asc' ? 'selected' : '' }}>
                    Giá từ thấp tới cao
                  </option>
                  <option value='desc' {{ Request::input('price') == 'desc' ? 'selected' : '' }}>
                    Giá từ cao tới thấp
                  </option>
                </select>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6">
                <select name='type'>
                  <option value='' {{ Request::input('type') == null ? 'selected' : '' }}>
                    Loại Sản Phẩm
                  </option>
                  <option value='promotion' {{ Request::input('type') == 'promotion' ? 'selected' : '' }}>
                    Sản phẩm khuyến mại
                  </option>
                  <option value='vote' {{ Request::input('type') == 'vote' ? 'selected' : '' }}>
                    Sản phẩm đánh giá cao
                  </option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-default">Lọc Sản Phẩm</button>
          </div>
        </div>
      </form>
    </div>
  </section>

  <section class="section-products">
    <div class="section-header">
      <div class="section-header-left">
        <h2 class="section-title">ĐIỆN THOẠI</h2>
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
      @if($data['products']->isEmpty())
      <div class="empty-content">
        <div class="icon"><i class="fab fa-searchengin"></i></div>
        <div class="title">Oooops!</div>
        <div class="content">Không tìm thấy sản phẩm nào</div>
      </div>
      @else
      <div class="row">
        @foreach($data['products'] as $key => $product)
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
        @endforeach
      </div>
      @endif
    </div>
    <div class="section-footer text-center">
      {{ $data['products']->appends(Request::query())->links() }}
    </div>
  </section>
</div>

@endsection

@section('css')
<style>
  .slide-advertise-inner {
    background-repeat: no-repeat;
    background-size: cover;
    padding-top: 21.25%;
  }

  #slide-advertise.owl-carousel .owl-item.active {
    -webkit-animation-name: zoomIn;
    animation-name: zoomIn;
    -webkit-animation-duration: .6s;
    animation-duration: .6s;
  }
</style>
@endsection

@section('js')
<script>
  $(document).ready(function() {

    $("#slide-advertise").owlCarousel({
      items: 2,
      autoplay: true,
      loop: true,
      margin: 10,
      autoplayHoverPause: true,
      nav: true,
      dots: false,
      responsive: {
        0: {
          items: 1,
        },
        992: {
          items: 2,
          animateOut: 'zoomInRight',
          animateIn: 'zoomOutLeft',
        }
      },
      navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>']
    });
  });
</script>
@endsection