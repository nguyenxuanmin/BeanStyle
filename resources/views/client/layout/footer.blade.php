<footer class="footer">
    <div class="mid-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-12 mb-3 mb-lg-0">
					<div class="logo-footer">
						<a href="{{route('index')}}">
                            @if (!empty($company->logo))
                                <img src="{{asset('storage/company/logo/'.$company->logo)}}" alt="{{$company->name}}" class="w-100 h-100 object-fit-cover">
                            @else
                                LOGO
                            @endif
                        </a>
					</div>
					<p class="my-3">
						Chúng tôi luôn trân trọng và mong đợi nhận được mọi ý kiến đóng góp từ khách hàng để có thể nâng cấp trải nghiệm dịch vụ và sản phẩm tốt hơn nữa.
                    </p>
                    <ul>
                        <li><b>Địa chỉ:</b> {{$company->address}}</li>
                        <li><b>Điện thoại:</b> <a href="tel:{{$company->hotline}}">{{$company->hotline}}</a></li>
                        <li><b>Email:</b> <a href="mailto:{{$company->email}}">{{$company->email}}</a></li>
                    </ul>
				</div>
				<div class="col-lg-4 col-12 mb-3 mb-lg-0">
                    <div class="mb-2"><b>Chính sách</b></div>
                    <ul>
                        @foreach ($policies as $item)
                            <li>
                                <a href="">{{$item->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="mb-2"><b>Hướng dẫn</b></div>
                    <ul>
                        @foreach ($instructs as $item)
                            <li>
                                <a href="">{{$item->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
			</div>
		</div>
	</div>
    <div class="copyright">
        <div class="container">
            <span>© Bản quyền thuộc về <b><a href="https://facebook.com/XuanMin9999" target="_blank" title="Facebook">Nguyễn Xuân Min</a></b></span>
        </div>
    </div>
</footer>