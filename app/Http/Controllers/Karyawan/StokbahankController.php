<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stokbahan;
use Yajra\DataTables\Facades\DataTables;


class StokbahankController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $query = Stokbahan::query();

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
                                    <a class="dropdown-item" href="' . url('edit-stokbahankar', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . url('delete-stokbahankar', $item->id) . '" method="get">
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
        return view('karyawan.stokbahan.index');
    }

    public function add(){
        return view('karyawan.stokbahan.add');
    }

    public function insert(Request $request){
        $stok = new Stokbahan();
        try {
            //code...
            $stok->name = $request->input('name');
            $stok->netto = $request->input('netto');
            $stok->save();
            return redirect('stokbahankar')->with('status', "Stok bahan Berhasil Ditambah");
        } catch (\Exception $ex) {
            //throw $th;
            return redirect('add-stokbahankar')->with('status', "Gagal Menambah Stok bahan Yang Sudah Ada");
        }
    }

    public function edit($id){
        $stok = Stokbahan::find($id);
        return view('karyawan.stokbahan.edit', [
            'stok' => $stok,
        ]);
    }

    public function update(Request $request, $id){
        $stok = Stokbahan::find($id);
        try {
            //code...
            $stok->name = $request->input('name');
            $stok->netto = $request->input('netto');
            $stok->update();
            return redirect('stokbahankar')->with('status', "Stok bahan Berhasil Diupdate");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('stokbahankar')->with('status', "Tidak Dapat Mengedit, Terdapat Stok bahan Yang Sama");
        }
    }

    public function destroy($id){
        $stok = Stokbahan::find($id);
        $stok->delete();
        return redirect('stokbahankar')->with('status',"Stok bahan Berhasil Dihapus");
    }
}
