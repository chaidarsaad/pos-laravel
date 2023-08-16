@extends('layouts.front')

@section('title')
    Category
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('category') }}">
                Kategori
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                      <h5>Semua Kategori</h5>
                    </div>
                </div>
                <div class="row">
                @php $incrementCategory = 0 @endphp
                    @forelse ($category as $cate)
                    <div
                        class="col-6 col-md-3 col-lg-2"
                        data-aos="fade-up"
                        data-aos-delay="{{ $incrementCategory+= 100 }}" style="align-content: center"
                    >
                        <a href="{{ url('category/'.$cate->slug) }}" class="component-categories d-block">
                            <div class="categories-image">
                                <img src="{{ asset('assets/uploads/category/'.$cate->image) }}" alt="Category image" class="w-100">
                            </div>
                            <p class="categories-text">
                                {{ $cate->name }}
                            </p>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5" 
                          data-aos="fade-up"
                          data-aos-delay="100">
                          Tidak ada kategori
                    </div>
                @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            @php $incrementProduct = 0 @endphp
             <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h3>Semua Produk</h3>
                </div>
            </div>
            @forelse ($products as $prod)
            <div
            class="col-6 col-md-4 col-lg-3"
            data-aos="fade-up"
            data-aos-delay="{{ $incrementProduct += 100 }}"
            >
                <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}" class="component-products d-block">
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
            <div
                class="col-12 text-center py-5"
                data-aos="fade-up"
                data-aos-delay="100"
            >
                Tidak ada produk
            </div>
            @endforelse
        </div>
        <div class="row">
            <div class="col-12 mt-4">
              {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

