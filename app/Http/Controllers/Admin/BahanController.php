<?php

namespace App\Http\Controllers\Admin;

use App\Models\Resep;
use App\Models\Product;
use App\Models\Stokbahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;


class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        // $reseps = Resep::where('product_id', $id)->get();

        if (request()->ajax()) {
            $query = Resep::with(['stokbahan'])->where('product_id', $id)->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                        <form action="' . url('delete-bahanbaku', $item->id) . '" method="get">
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findorFail($id);

        $stokbahan = Stokbahan::all();

        return view('admin.product.create', [
            'stokbahan' => $stokbahan,
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());

        $product_id = $request->product_id;
        $stokbahan_id = $request->stokbahan_id;
        $netto = $request->netto;

        for ($i=0; $i < count($product_id); $i++) { 
            $datasave = [
                'product_id' => $product_id[$i],
                'stokbahan_id' => $stokbahan_id[$i],
                'netto' => $netto[$i]
            ];
            DB::table('resep')->insert($datasave);
        }

        // foreach ($request->only(['product_id', 'stokbahan_id', 'netto']) as $key => $value) {
        //     Resep::create([
        //         "product_id" => $request->product_id[$key],
        //         "stokbahan_id" => $request->stokbahan_id[$key],
        //         "netto" => $request->netto[$key]
        //     ]);
            // $bahan = new Resep();
            // $bahan->product_id = $request->id[$key];
            // $bahan->stokbahan_id = $request->input('stokbahan_id')[$key];
            // $bahan->netto = $request->input('netto')[$key];
            // $bahan->save();


            
        // }

        return back()->with('status', "Product Berhasil Ditambah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reseps = Resep::findorFail($id);
        $reseps->delete();
        return redirect('products')->with('status',"Resep Berhasil Dihapus");
    }
}
