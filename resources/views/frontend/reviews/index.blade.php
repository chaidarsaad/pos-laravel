@extends('layouts.front')

@section('title', "Write a Review")

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($verified_purchase->count() > 0)
                        <h5>Anda menulis review untuk {{ $product->name }}</h5>
                        <form action="{{ url('/add-review') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <textarea class="form-control" name="user_review" rows="5" placeholder="Masukkan review disini"></textarea>
                            <button type="submit" class="btn btn-primary mt-3">Simpan Review</button>
                        </form>
                    @else
                        <div class="alert alert-danger">
                            <h5>Anda tidak memenuhi syarat untuk mengisi review produk ini</h5>
                            <p>
                                Hanya orang yang telah membeli produk ini yang bisa mengisi review.
                            </p>
                            <a href="{{ url('/') }}" class="btn btn-primary mt-3">Kembali</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
