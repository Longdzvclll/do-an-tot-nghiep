@extends("frontend.layouts.master")
@section('title', 'Chính sách bảo mật - LẮC FOODS')
@section('description', 'Chính sách bảo mật - LẮC FOODS')
@section("images", asset("images/logo.png"))
@section("content")
    <div class="breadcrumb-shop">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd5  ">
                    <ol class="breadcrumb breadcrumb-arrows" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a href="/" target="_self" itemprop="item"><span itemprop="name">Trang chủ</span></a>
                            <meta itemprop="position" content="1">
                        </li>


                        <li class="active" itemprop="itemListElement" itemscope=""
                            itemtype="http://schema.org/ListItem">
                            <span itemprop="item" content="{{route('pages.chinh-sach-bao-mat')}}"><span itemprop="name">Chính sách bảo mật</span></span>
                            <meta itemprop="position" content="2">
                        </li>

                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper-row pd-page">
        <div class="container-fluid">
            <div class="heading-page text-center">
                <h1>CHÍNH SÁCH BẢO MẬT – LẮC FOODS</h1>
            </div>
            <div class="blog-content">
                <p dir="ltr"><span style="background-color:transparent; color:rgb(0, 0, 0); font-family:arial,sans-serif; font-size:11pt">Tại</span><a href="https://lacfoods.vn" style="text-decoration-line: none;"><span style="background-color:transparent; color:rgb(0, 0, 0); font-family:arial,sans-serif; font-size:11pt"> </span><span style="background-color:transparent; color:rgb(17, 85, 204); font-family:arial,sans-serif; font-size:11pt">Lắc Foods</span></a><span style="background-color:transparent; color:rgb(0, 0, 0); font-family:arial,sans-serif; font-size:11pt">, chúng tôi &ndash; dưới sự quản lý của công ty mẹ Lắc Box &ndash; luôn cam kết bảo vệ tuyệt đối thông tin cá nhân của khách hàng trong mọi giao dịch trên nền tảng trực tuyến. Chính sách bảo mật dưới đây giúp bạn hiểu rõ về cách Lắc Box thu thập, sử dụng và bảo vệ dữ liệu cá nhân một cách minh bạch và an toàn.</span></p>

<h3 dir="ltr"><strong>1. Thông tin cá nhân được thu thập</strong></h3>

<p dir="ltr"><span style="background-color:transparent; color:rgb(0, 0, 0); font-family:arial,sans-serif; font-size:11pt">Khi khách hàng đăng ký tài khoản hoặc thực hiện giao dịch mua sắm trên Lắc Box, chúng tôi sẽ thu thập các thông tin sau:</span></p>

<ul>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Họ và tên</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Số điện thoại liên hệ</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Địa chỉ nhận hàng</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Email (nếu có)</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Nội dung phản hồi, đánh giá, tin nhắn hoặc yêu cầu hỗ trợ từ khách hàng</span></p>
	</li>
</ul>

<h3 dir="ltr"><strong>2. Mục đích sử dụng thông tin</strong></h3>

<p dir="ltr"><span style="background-color:transparent; color:rgb(0, 0, 0); font-family:arial,sans-serif; font-size:11pt">Thông tin khách hàng tại Lắc Box được thu thập nhằm các mục đích sau:</span></p>

<ul>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Xử lý đơn hàng và giao hàng đúng thời gian, đúng địa chỉ.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Chăm sóc khách hàng, hỗ trợ xử lý khiếu nại nhanh chóng, minh bạch.</span><br />
	<span style="background-color:transparent; font-size:11pt">Gửi thông tin khuyến mãi, ưu đãi mới nhất nếu khách hàng đồng ý nhận thông báo.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Cải tiến sản phẩm và trải nghiệm người dùng, giúp thương hiệu Lắc Box ngày càng hoàn thiện.</span></p>
	</li>
</ul>

<h3 dir="ltr"><strong>3. Bảo mật thông tin</strong></h3>

<p dir="ltr"><span style="background-color:transparent; color:rgb(0, 0, 0); font-family:arial,sans-serif; font-size:11pt">Lắc Box cam kết bảo mật tất cả thông tin khách hàng và không bán, chia sẻ hoặc trao đổi dữ liệu cá nhân với bất kỳ bên thứ ba nào, trừ khi có yêu cầu của cơ quan pháp luật hoặc để phục vụ mục đích thực hiện đơn hàng (cung cấp cho đơn vị vận chuyển).</span></p>

<h3 dir="ltr"><strong>4. Quyền của khách hàng</strong></h3>

<p dir="ltr"><span style="background-color:transparent; color:rgb(0, 0, 0); font-family:arial,sans-serif; font-size:11pt">Khách hàng có quyền:</span></p>

<ul>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Chỉnh sửa hoặc cập nhật thông tin cá nhân bất kỳ lúc nào.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Từ chối nhận các thông tin quảng cáo từ Lắc Box qua SMS, email hoặc các phương thức khác.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Liên hệ trực tiếp với chúng tôi để yêu cầu hỗ trợ hoặc làm rõ về chính sách bảo mật.</span></p>
	</li>
</ul>

<h3 dir="ltr"><strong>5. Kênh liên hệ bảo mật</strong></h3>

<p dir="ltr"><span style="background-color:transparent; color:rgb(0, 0, 0); font-family:arial,sans-serif; font-size:11pt">Mọi thắc mắc liên quan đến chính sách bảo mật của Lắc Box, khách hàng vui lòng liên hệ:</span></p>

<p dir="ltr"><span style="background-color:transparent; color:rgb(0, 0, 0); font-family:arial,sans-serif; font-size:11pt">📞 </span><strong>Hotline / Zalo</strong><span style="background-color:transparent; color:rgb(0, 0, 0); font-family:arial,sans-serif; font-size:11pt">: 0839.004.889</span><br />
<span style="background-color:transparent; color:rgb(0, 0, 0); font-family:arial,sans-serif; font-size:11pt">📍 </span><strong>Fanpage Facebook</strong><span style="background-color:transparent; color:rgb(0, 0, 0); font-family:arial,sans-serif; font-size:11pt">: </span><a href="https://www.facebook.com/lacfastfoods/" style="text-decoration-line: none;"><em>https://www.facebook.com/lacfastfoods/</em></a></p>


            </div>
        </div>
    </div>
@endsection
