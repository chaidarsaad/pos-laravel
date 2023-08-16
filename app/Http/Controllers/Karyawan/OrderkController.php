<?php

namespace App\Http\Controllers\Karyawan;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;


class OrderkController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        // $orders = Order::where('status','0')->get();
        return view('karyawan.orders.index', [
            'orders' => $orders

        ]);
    }

    public function view($id)
    {
        $orders = Order::where('id', $id)->first();
        return view('karyawan.orders.view', [
            'orders' => $orders
        ]);
    }

    public function updateorder(Request $request, $id)
    {
        $orders = Order::find($id);
        $orders->status_pesanan = $request->input('status_pesanan');
        $orders->update();
        return redirect('karyawan/view-orderkar/'.$id)->with('status', "Pesanan Telah di Update");
    }

    public function viewinvoice($id)
    {
	$ongkir = Order::with(['district'])->findOrFail($id);
        $orders = Order::where('id', $id)->first();
        return view('karyawan.orders.invoice', [
            'orders' => $orders,
'ongkir' => $ongkir
        ]);
    }

    public function invoice($id){
$ongkir = Order::with(['district'])->findOrFail($id);
        $orders = Order::where('id', $id)->first();
        $namafile = $orders->tracking_no.'.pdf';
        $pdf = Pdf::loadView('karyawan.orders.invoice', [
            'orders' => $orders,
'ongkir' => $ongkir
        ]);
        return $pdf->download($namafile);
    }

}
