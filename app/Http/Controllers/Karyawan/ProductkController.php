<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Resep;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

use Yajra\DataTables\Facades\DataTables;

class ProductkController extends Controller
{
    public function index()
    {
        // $products = Product::all();

        if (request()->ajax()) {
            $query = Product::query();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" 
                                    type="button" id="action' .  $item->id . '"
                                        data-toggle="dropdown" 
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <a class="dropdown-item" href="' . url('edit-productkar', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . url('delete-productkar', $item->id) . '" method="get">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('karyawan.product.index');
    }

    public function add()
    {
        $products = Product::all();
        return view('karyawan.product.add', [
            'products' => $products,
        ]);
    }

    public function insert(Request $request)
    {
        $products = new Product();
        try {
            
            $products->name = $request->input('name');
            $products->price = $request->input('price');
            $products->qty = $request->input('qty');
            $products->save();

            return redirect('productskar')->with('status', "Product Berhasil Ditambah");
        } catch (\Exception $ex) {
            return redirect('add-productskar')->with('status', "Gagal Menambah Produk Yang Sudah Ada");
        }
    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('karyawan.product.edit', [
            'products' => $products
        ]);
    }

    public function update(Request $request, $id)
    {
        $products = Product::find($id);
        try {
            $products->name = $request->input('name');
            $products->price = $request->input('price');
            $products->qty = $request->input('qty');
            $products->update();
            return redirect('productskar')->with('status', "Product Berhasil Diupdate");
        } catch (\Throwable $th) {
            return redirect('productskar')->with('status', "Tidak Dapat Mengedit,Terdapat Nama Produk Yang Sama");
        }
    }

    public function destroy($id)
    {
        $products = Product::find($id);
        $products->delete();
        return redirect('productskar')->with('status',"Product Berhasil Dihapus");
    }
}
