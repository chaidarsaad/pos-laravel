@extends('layouts.front')

@section('title')
    Welcome to Arie Cake Store
@endsection

@section('content')
    @include('layouts.inc.slider')
    <div class="py-5">
        <div class="container">
            <div class="row">
                @php $incrementCategory = 0 @endphp
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h3>Trending Kategori</h3>
                    </div>
                </div>
                @forelse ($trending_category as $tcategory)
                    <div
                        class="col-6 col-md-3 col-lg-2"
                        data-aos="fade-up"
                        data-aos-delay="{{ $incrementCategory+= 100 }}"
                    >
                        <a href="{{ url('category/'.$tcategory->slug) }}" class="component-categories d-block">
                            <div class="categories-image">
                                <img
                                src="{{ asset('assets/uploads/category/'.$tcategory->image) }}"
                                alt="Product image"
                                class="w-100"
                                />
                            </div>
                            <p class="categories-text">
                                {{  $tcategory->name }}
                            </p>
                        </a>
                    </div>
                @empty
                    <div
                        class="col-12 text-center py-5"
                        data-aos="fade-up"
                        data-aos-delay="100"
                    >
                        Tidak ada kategori
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <div class="py-5">
        <div class="container">
            <div class="row">
                @php $incrementProduct = 0 @endphp
                 <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h3>Produk Terbaru</h3>
                    </div>
                </div>
                @forelse ($featured_products as $prod)
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
        </div>
    </div>

@endsection

@section('scripts')
<script>
</script>
@endsection

