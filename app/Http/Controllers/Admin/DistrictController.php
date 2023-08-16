<?php

namespace App\Http\Controllers\Admin;

use App\Models\District;
use App\Models\Calculate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;


class DistrictController extends Controller{
    public function index(){
        // $districts = District::all();

        if (request()->ajax()) {
            $query = District::query();

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
                                    <a class="dropdown-item" href="' . url('edit-district', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . url('delete-district', $item->id) . '" method="get">
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
        return view('admin.district.index');
    }
    public function add(){
        return view('admin.district.add');
    }
    public function insert(Request $request){
        $districts = new District();
    	try {
            //code...
            $districts->name = $request->input('name');
            $districts->price = $request->input('price');
            $districts->save();
            return redirect('districts')->with('status', "Kecamatan Berhasil Ditambah");
        } catch (\Exception $ex) {
            //throw $th;
            return redirect('add-districts')->with('status', "Gagal Menambah Kecamatan Yang Sudah Ada");
        }   
    }
    public function edit($id){
        $districts = District::find($id);
        return view('admin.district.edit', [
            'districts' => $districts
        ]);
    }
    public function update(Request $request, $id){
        $districts = District::find($id);
	try {
            //code...
            $districts->name = $request->input('name');
            $districts->price = $request->input('price');
            $districts->update();
            return redirect('districts')->with('status', "Kecamatan Berhasil Diupdate");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('districts')->with('status', "Tidak Dapat Mengedit,Terdapat Nama Kecamatan Yang Sama");
        }
    }
    public function destroy($id){
        $districts = District::find($id);
        $districts->delete();
        return redirect('districts')->with('status',"Kecamatan Berhasil Dihapus");
    }
    public function calc(Request $request){
        $bil1 = $request->input('first');
        $harga = 1500;
        $kec = $request->input('namakec');
        $res = 0;

        $res = $bil1 * $harga;

        return redirect('districts')->with('status', "Harga Ongkir ke kecamatan $kec adalah $res");
    }
}
