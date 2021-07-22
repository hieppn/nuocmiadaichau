@extends('layouts.master')

@section('title', 'Giới Thiệu')

@section('content')

<section class="bread-crumb">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home_page') }}">{{ __('header.Home') }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Giới Thiệu</li>
    </ol>
  </nav>
</section>

<div class="site-about">
  <section class="section-advertise">
    <div class="content-advertise">
      <div id="slide-advertise" class="owl-carousel">
        @foreach($advertises as $advertise)
        <div class="slide-advertise-inner" style="background-image: url('{{ Helper::get_image_advertise_url($advertise->image) }}');" data-dot="<button>{{ $advertise->title }}</button>"></div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="section-about">
    <div class="section-header">
      <h2 class="section-title">Giới Thiệu</h2>
    </div>
    <div class="section-content">
      <div class="row">
        <div class="col-md-9 col-sm-8">
          <div class="content-left">
            <div class="note">
              <div class="note-icon"><i class="fas fa-info-circle"></i></div>
              <div class="note-content">
                <i>Website <strong style="color: red;font-weight:bold;font-size: 24px">ĐẠI CHÂU</strong> thuộc <span style="font-weight: bolder;color: #256c20">công ty inox Đại Châu</span> nhằm đưa sản phẩm Việt nâng tầm quốc tế.</i>
              </div>
            </div>
            <div class="content">
            <p> Xưởng sản xuất máy ép mía uy tín, chất lượng số <b style="color: red;">ONE</b>.Trên thị trường máy ép mía Việt Nam, Đại Châu là xưởng sản xuất uy tín, lâu đời ở TP.HCM. Sở hữu 2 nhà xưởng lên tới gần 900m2, đội ngũ nhân viên kỹ thuật lành nghề. Tất cả các linh kiện đều nhập trực tiếp bên Malaysia và Nhật Bản về bên xưởng sủ dụng máy móc hiện đại để tự sản xuất ra thành phẩm từ a-z, đặt biệt nhập khẩu mô tơ chính hãng 100%, sản xuất với số lượng máy ép mía lớn nên chi phí được tiết kiệm rất nhiều cho khách hàng. Giá máy luôn rẻ hơn 700 nghìn - 1 triệu đồng so với tất cả các đơn vị khác. </p>
            <p>Chúng tôi luôn có những chính sách tốt nhất cho khách hàng bao gồm giao hàng tận nhà miễn phí tất cả các đơn hàng tại TP HCM, hướng dẫn sử dụng, hướng dẫn vệ sinh, khách hàng nhận hàng rôi thanh toán. Hỗ trợ cước tối đa cho khách hàng tại tỉnh. Và nhiều món quà tặng hấp dẫn để khách hàng sử dụng về sau như: lưới lọc kay mía , dao cạo mía… cho tất cả khách hàng mới mua máy bên em. Và những khách hàng thân thiện , còn được tặng máy ép ly hoặt cuộn keo tuỳ vào loại máy khách yêu cầu.</p>
            <p>Chính vì thế, nhân viên của chúng tôi đã không ngừng nghỉ thiết kế và sản xuất nhiều mẫu máy ép mía đẳng cấp bật nhất thị trường nước mía trong và ngoài nước. Xưởng sản xuất chúng tôi đã cho ra mắt hàng loạt dòng máy ép mía, xe nước mía với nhiều kiểu dáng, mẫu mã, nhu cầu sử dụng. Đem lại sự trải nghiệm an tâm trên từng sản phẩm bên xưởng . Nhằm đưa tới tay người dùng đúng hàng chính hãng công ty 100%. Giá thành rẻ phải chăng hợp với mọi điều kiện của người dân.💥💥Đặt biệt, tất cả dòng sản phẩm xe hoặt máy ép mía bên em đều được bảo hành cao cấp lên đến 2 năm cho bà con mình an tâm về chất lượng của từng sản phẩm bên công ty em.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-4">
          <div class="content-right">
            <div class="online_support">
              <h2 class="title">CHÚNG TÔI LUÔN SẴN SÀNG<br>ĐỂ GIÚP ĐỠ BẠN</h2>
              <img src="{{ asset('images/support_online.jpg') }}">
              <h3 class="sub_title">Để được hỗ trợ tốt nhất. Hãy gọi</h3>
              <div class="phone">
                <a href="tel:0979396926" title="0979396926">0979396926</a>
              </div>
              <div class="or"><span>HOẶC</span></div>
              <h3 class="title">Chat hỗ trợ trực tuyến</h3>
              <h3 class="sub_title">Chúng tôi luôn trực tuyến 24/7.</h3>
            </div>
          </div>
        </div>
      </div>
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