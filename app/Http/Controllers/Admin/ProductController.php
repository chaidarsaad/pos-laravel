<?php

namespace App\Http\Controllers\Admin;

use App\Models\Resep;
use App\Models\Product;
use App\Models\Stokbahan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
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
                                    <a class="dropdown-item" href="' . url('edit-product', $item->id) . '">
                                        Sunting
                                    </a>
                                    <a class="dropdown-item" href="' . url('bahanbaku-product', $item->id) . '">
                                        Lihat Bahan Baku
                                    </a>
                                    <form action="' . url('delete-product', $item->id) . '" method="get">
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
        return view('admin.product.index');
    }

    public function add()
    {
        $products = Product::all();
        return view('admin.product.add', [
            'products' => $products
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

            return redirect('products')->with('status', "Product Berhasil Ditambah");
        } catch (\Exception $ex) {
            return redirect('add-products')->with('status', "Gagal Menambah Produk Yang Sudah Ada");
        }
    }

    public function edit($id)
    {

        $products = Product::findOrFail($id);
        return view('admin.product.edit', [
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
            return redirect('products')->with('status', "Product Berhasil Diupdate");
        } catch (\Throwable $th) {
            return redirect('products')->with('status', "Tidak Dapat Mengedit,Terdapat Nama Produk Yang Sama");
        }
    }

    public function destroy($id)
    {
        $products = Product::find($id);
        $products->delete();
        return redirect('products')->with('status', "Product Berhasil Dihapus");
    }

    public function bahanbaku($id)
    {
        $product = Product::findOrFail($id);
        // $reseps = Resep::where('product_id', $id)->get();

        if (request()->ajax()) {
            $query = Resep::with(['stokbahan'])->where('product_id', $id)->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                        <form action="' . url('delete-product', $item->id) . '" method="get">
                        ' . method_field('delete') . csrf_field() . '
                        <button type="submit" class="btn btn-danger">
                            Hapus
                        </button>
                    </form>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.product.bahanbaku', [
            'product' => $product
        ]);
    }

    public function insertbahanbaku($request, $id)
    {
        $product = Product::findOrFail($id);

        $stokbahan = Stokbahan::all();

        return view('admin.product.create', [
            'stokbahan' => $stokbahan,
            'product' => $product
        ]);
    }

    public function addbahanbaku(Request $request, $id)
    {
        $bahan = new Resep();
        $bahan->product_id = $request->id;
        $bahan->stokbahan_id = $request->input('stokbahan_id');
        $bahan->netto = $request->input('netto');
        $bahan->save();

        return redirect('products')->with('status', "Product Berhasil Ditambah");
    }
}
