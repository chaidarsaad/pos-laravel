<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stokbahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;


class StokbahanController extends Controller
{
    public function index()
    {
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
                                    <a class="dropdown-item" href="' . url('edit-stokbahan', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . url('delete-stokbahan', $item->id) . '" method="get">
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
        return view('admin.stokbahan.index');
    }
    public function add()
    {
        return view('admin.stokbahan.add');
    }
    public function insert(Request $request)
    {
        // dd($request->all());

        $name = $request->name;
        $netto = $request->netto;

        for ($i = 0; $i < count($name); $i++) {
            $datasave = [
                'name'  => $name[$i],
                'netto' => $netto[$i]
            ];
            DB::table('stokbahan')->insert($datasave);
        }
        //code...
        // $stok->name = $request->input('name');
        // $stok->netto = $request->input('netto');
        // $stok->save();
        return redirect('stokbahan')->with('status', "Stok bahan Berhasil Ditambah");

        // $stok = new Stokbahan();
        // try {
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return redirect('add-stokbahan')->with('status', "Gagal Menambah Stok bahan Yang Sudah Ada");
        // }
    }
    public function edit($id)
    {
        $stok = Stokbahan::find($id);
        return view('admin.stokbahan.edit', [
            'stok' => $stok,
        ]);
    }
    public function update(Request $request, $id)
    {
        $stok = Stokbahan::find($id);
        try {
            //code...
            $stok->name = $request->input('name');
            $stok->netto = $request->input('netto');
            $stok->update();
            return redirect('stokbahan')->with('status', "Stok bahan Berhasil Diupdate");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('stokbahan')->with('status', "Tidak Dapat Mengedit, Terdapat Stok bahan Yang Sama");
        }
    }
    public function destroy($id)
    {
        $stok = Stokbahan::find($id);
        $stok->delete();
        return redirect('stokbahan')->with('status', "Stok bahan Berhasil Dihapus");
    }
}
