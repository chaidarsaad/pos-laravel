<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pos;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;


class PoskController extends Controller
{
    // buat nampilin product
    public function index(){
        $positems = Pos::all();

        if (request()->ajax()) {
            $query = Product::query();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <div class="btn-group">
                        <div class="" aria-labelledby="action' .  $item->id . '">
                            <form action="' . url('insert-pointofsalekar', $item->id) . '" method="post">
                                ' . method_field('post') . csrf_field() . '
                                <button type="submit" class="btn btn-primary">
                                    Tambah
                                </button>
                            </form>
                        </div>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('karyawan.pos.index', [
            'positems' => $positems
        ]);
    }

    //tambah product ke pos
    public function insert(Request $request, $id){

        $data = [
            'prod_id' => $id,
            'prod_qty' => 1,
        ];

        try {
            //code...
            Pos::create($data);
            return redirect('pointofsaleskar');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('pointofsaleskar')->with('status', "Produk Sudah Ada di Point Of Sales");
        }
    }

    //update prod_qty
    public function update(Request $request, $id){
        $pos = Pos::find($id);
        $pos->prod_qty = $request->input('prod_qty');
        $pos->update();
        return redirect('pointofsaleskar');
    }

    public function deletepos($id){
      $pos = Pos::find($id);
      $pos->delete();
      return redirect('pointofsaleskar');
    }

    public function checkoutpos(Request $request){
        $order = new Order();

        $totalPrice = 0;
        $order->total_price = $request->input('total_price');
        $order->fname = $request->input('fname');
        $order->status = 'Sudah Dibayar';
        $order->tracking_no = 'store-' . mt_rand(00000, 99999);

        $order->save();
        
        $positems = Pos::all();
        foreach ($positems as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->product->price
            ]);

            $prod = Product::where('id', $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();

            $reseps = $prod->resep;
            foreach ($reseps as $resep) {
                $stokBahan = $resep->stokbahan;
                $stokBahan->netto -= $resep->netto * $item->prod_qty;
                $stokBahan->save();
            }
        }

        $positems = Pos::all();
        Pos::destroy($positems);
        
        return redirect('pointofsaleskar');
    }
}
