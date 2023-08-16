<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Stokbahan;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;

class BahanbakuController extends Controller
{
    Public function index(){
        if (request()->ajax()) {
            $query = Resep::with(['product', 'stokbahan']);

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
                                    <a class="dropdown-item" href="' . url('edit-resep', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . url('delete-resep', $item->id) . '" method="get">
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
        return view('admin.bahanbaku.index');
    }

    public function add(){
        $stokbahan = Stokbahan::all();
        $product = Product::all();
        return view('admin.bahanbaku.add', [
            'product' => $product,
            'stokbahan' => $stokbahan
        ]);
    }

    public function insert(Request $request)
    {
        $reseps = new Resep();
        $reseps->product_id = $request->input('product_id');
        $reseps->stokbahan_id = $request->input('stokbahan_id');
        // $reseps->netto = $request->input('netto');
        $reseps->save();
        return redirect('bahanbaku')->with('status',"Resep Berhasil Ditambah");
    }

    public function edit($id){
        $stokbahan = Stokbahan::all();
        $product = Product::all();
        $reseps = Resep::with(['product', 'stokbahan'])->findOrFail($id);
        return view('admin.stokbahan.edit', [
            'product' => $product,
            'reseps' => $reseps,
            'stokbahan' => $stokbahan
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $reseps = Resep::find($id);
        
        $reseps->netto = $request->input('netto');
        $reseps->stokbahan_id = $request->input('stokbahan_id');
        $reseps->product_id = $request->input('product_id');
        $reseps->update();
        return redirect('bahanbaku')->with('status',"Resep Berhasil Diupdate");
    }

    public function destroy($id)
    {
        $reseps = Resep::findorFail($id);
        $reseps->delete();
        return redirect('bahanbaku')->with('status',"Resep Berhasil Dihapus");
    }
}
