@extends('client.layout.master-page')

@section('title')
    Trang chủ
@endsection

@section('content')
    @if (count($sliders))
        <section class="section-slider">
            <div class="my-slider">
                @foreach ($sliders as $slider)
                    <div class="item-slider">
                        <img src="{{asset('storage/sliders/'.$slider->image)}}" alt="{{$slider->name}}" class="w-100 h-100 object-fit-cover">
                    </div>
                @endforeach
            </div>
        </section>
        <section class="section-benefit">
            <div class="container">
                <div class="row">
                    @foreach ($benefits as $item)
                        <div class="col-6 col-lg-3">
                            <div class="item-benefit">
                                <div class="item-benefit-image">
                                    <img src="{{asset('storage/benefits/'.$item->image)}}" alt="{{$item->name}}" class="object-fit-cover">
                                </div>
                                <div class="item-benefit-info">
                                    <h3>{{$item->name}}</h3>
                                    <span>{{$item->description}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
