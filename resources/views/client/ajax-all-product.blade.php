@if (count($products))
    <div class="my-all-product mx-15">
        @foreach ($products as $item)
            @php
                $price = $item->productSizes[0]->price;
                $discount = $item->productSizes[0]->discount;
                $flashSale = (($price - $discount) / $price) * 100;
            @endphp
            <div class="px-15">
                <div class="item-product mb-3 mb-lg-4">
                    <div class="item-product-badge">
                        @if ($item->isNew == 1)
                            <span class="item-product-badge-new">Hàng mới</span>
                        @endif
                        @if ($item->isBestSeller == 1)
                            <span class="item-product-badge-best">Bán chạy</span>
                        @endif
                    </div>
                    <div class="item-product-image">
                        <a href="">
                            <img src="{{asset('storage/products/'.$item->productColors[0]->productImages[0]->image)}}" alt="{{$item->name}}" class="w-100 h-100 object-fit-cover">
                        </a>
                    </div>
                    <div class="item-product-info">
                        <div class="item-product-vendor-color">
                            <span class="item-product-vendor">{{$item->brand->name}}</span>
                            <div class="item-product-color">
                                @foreach ($item->productColors as $k => $productColor)
                                    @if ($k < 3)
                                        <span style="background: {{$productColor->color->color_code}};"></span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <h3><a href="" title="{{$item->name}}">{{$item->name}}</a></h3>
                        <span class="item-product-discount">{{number_format($discount, 0, ',', '.')}}đ</span><span class="item-product-flash-sale">-{{round($flashSale)}}%</span>
                        <span class="item-product-price">{{number_format($price, 0, ',', '.')}}₫</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-warning">
        Sản phẩm đang được cập nhật.
    </div>
@endif
