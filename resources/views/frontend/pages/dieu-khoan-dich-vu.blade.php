@extends("frontend.layouts.master")
@section('title', 'Điều khoản dịch vụ - LẮC FOODS')
@section('description', 'Điều khoản dịch vụ - LẮC FOODS')
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
                            <span itemprop="item" content="{{route('pages.dieu-khoan-dich-vu')}}"><span itemprop="name">Điều khoản dịch vụ</span></span>
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
                <h1>ĐIỀU KHOẢN DỊCH VỤ – LẮC BOX</h1>
            </div>
            <div class="blog-content">
                <h3 dir="ltr"><strong>1. Định nghĩa</strong></h3>

<ul>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Lắc Box: Là công ty Cổ phần Sản xuất và Thương mại Lắc Box, sở hữu thương hiệu Lắc Box, chuyên cung cấp các món ăn nhanh theo phong cách Việt, mang đến trải nghiệm ẩm thực tiện lợi, sáng tạo và chất lượng cao.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Khách hàng: Là người sử dụng website Lắc Box, bao gồm người mua hàng và người truy cập tìm hiểu thông tin.</span></p>
	</li>
</ul>

<h3 dir="ltr"><strong>2. Quy định về đặt hàng</strong></h3>

<ul>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Khi đặt hàng trên website Lắc Box, khách hàng cần cung cấp đầy đủ và chính xác thông tin cá nhân (họ tên, số điện thoại, địa chỉ giao hàng).</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Đơn hàng chỉ được xác nhận khi Lắc Box gọi điện hoặc nhắn tin xác nhận.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Trong trường hợp sản phẩm hết hàng, lỗi hệ thống hoặc bất kỳ sự cố nào khác, Lắc Box có quyền hủy đơn hàng và sẽ thông báo lại cho khách hàng.</span></p>
	</li>
</ul>

<h3 dir="ltr"><strong>3. Hình thức thanh toán</strong></h3>

<ul>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Hiện tại, Lắc Box chỉ hỗ trợ thanh toán khi nhận hàng (COD).</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Khách hàng cần kiểm tra kỹ thông tin và đơn hàng trước khi thanh toán. Lắc Box không chịu trách nhiệm với các giao dịch ngoài hệ thống chính thức của website Lắc Box.</span></p>
	</li>
</ul>

<h3 dir="ltr"><strong>4. Chính sách vận chuyển</strong></h3>

<ul>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Lắc Box sử dụng các đơn vị vận chuyển đối tác để giao hàng.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Thời gian giao hàng có thể thay đổi tùy vào khu vực và điều kiện thời tiết.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Nếu khách hàng cung cấp sai địa chỉ hoặc không nhận hàng, đơn hàng có thể bị hủy mà không hoàn tiền.</span></p>
	</li>
</ul>

<h3 dir="ltr"><strong>5. Trách nhiệm và quyền hạn của Lắc Box</strong></h3>

<ul>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Cung cấp sản phẩm đúng với mô tả trên website Lắc Box.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Hỗ trợ khách hàng trong trường hợp có sự cố phát sinh từ dịch vụ hoặc sản phẩm.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Đảm bảo bảo mật thông tin khách hàng theo </span><a href="https://lacfoods.vn/chinh-sach-bao-mat" style="text-decoration-line: none;"><strong>chính sách bảo mật</strong></a><strong> </strong><span style="background-color:transparent; font-size:11pt">của Lắc Box.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Lắc Box có quyền từ chối phục vụ những khách hàng vi phạm điều khoản dịch vụ hoặc có hành vi không phù hợp.</span></p>
	</li>
</ul>

<h3 dir="ltr"><strong>6. Trách nhiệm của khách hàng</strong></h3>

<ul>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Tuân thủ các quy định khi đặt hàng và thanh toán trên website Lắc Box.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Không sử dụng website Lắc Box vào mục đích lừa đảo hoặc gây hại cho Lắc Box và người khác.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Không sao chép, sử dụng hoặc phân phối nội dung trên website Lắc Box mà không có sự đồng ý của công ty.</span></p>
	</li>
</ul>

<h3 dir="ltr"><strong>7 Điều khoản chung</strong></h3>

<ul>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Khi sử dụng website Lắc Box, khách hàng đồng ý với tất cả các điều khoản trên.</span></p>
	</li>
	<li dir="ltr">
	<p dir="ltr"><span style="background-color:transparent; font-size:11pt">Nếu có tranh chấp, hai bên sẽ ưu tiên giải quyết bằng thương lượng. Nếu không đạt thỏa thuận, tranh chấp sẽ được giải quyết theo quy định pháp luật.</span></p>
	</li>
</ul>

<p dir="ltr"><span style="background-color:transparent; color:rgb(0, 0, 0); font-family:arial,sans-serif; font-size:11pt">Điều khoản dịch vụ này giúp bảo vệ quyền lợi của khách hàng và Lắc Box trong quá trình giao dịch. Mọi thắc mắc hoặc yêu cầu hỗ trợ, khách hàng có thể liên hệ với chúng tôi qua các kênh hỗ trợ chính thức trên website Lắc Box.</span></p>


            </div>
        </div>
    </div>
@endsection
