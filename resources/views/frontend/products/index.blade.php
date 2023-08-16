@extends('layouts.front')

@section('title')
    {{ $category->name }}
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('category') }}">
                Kategori
            </a> /
            <a href="{{ url('category/'.$category->slug) }}">
                {{ $category->name }}
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="row">
                @php $incrementProduct = 0 @endphp
                <div class="col-12" data-aos="fade-up">
                     <h2>{{ $category->name }}</h2>
                </div>
            </div>
            @forelse ($products as $prod)
            <div
                class="col-6 col-md-4 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="{{ $incrementProduct += 100 }}"
            >
                <a href="{{ url('category/'.$category->slug.'/'.$prod->slug) }}" class="component-products d-block">
                    <div class="products-thumbnail">
                        <div
                        class="products-image"
                        style="background-image: url('{{ asset('assets/uploads/products/'.$prod->image) }}');"
                        ></div>
                    </div>
                    <div class="products-text">
                        {{  $prod->name }}
                    </div>
                    <div class="products-price">
                        Rp {{ number_format($prod->price) }}
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-5" >
                Produk kosong
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
