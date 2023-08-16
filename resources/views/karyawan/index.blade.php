@extends('layouts.karyawan')

@section('content')

@section('content')
<!-- Section Content -->  
  <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
  >
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Karyawan Dashboard</h2>
        <p class="dashboard-subtitle">ariecakestore karyawan panel</p>
      </div>
      <div class="dashboard-content">
        <div class="row">
                <div class="col-md-4">
                    <div class="card mb-2">
                        <a href="{{ url('productskar') }}" style="text-decoration: none">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Total Produk
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $product }}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <a href="{{ url('categorieskar') }}" style="text-decoration: none">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Total Kategori
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $category }}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card mb-2">
                        <a href="{{ url('orderskar') }}" style="text-decoration: none">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Total Transaction
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $total_orders }}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <a href="{{ url('orderskar') }}" style="text-decoration: none">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Transaction Success
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $completed_orders }}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <a href="{{ url('orderskar') }}" style="text-decoration: none">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Transaction Pending
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $pending_orders }}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
      </div>
    </div>
  </div>
@endsection

