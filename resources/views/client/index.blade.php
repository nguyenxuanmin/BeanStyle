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
    @endif
@endsection
