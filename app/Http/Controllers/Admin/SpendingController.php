<?php

namespace App\Http\Controllers\Admin;

use App\Models\Spending;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;


class SpendingController extends Controller{
    public function index(){
        $spendings = Spending::all();
        return view('admin.spending.index', [
            'spendings' => $spendings
        ]);
    }
    public function add(){
        return view('admin.spending.add');
    }
    public function insert(Request $request){
        $spendings = new Spending();
        $spendings->description = $request->input('description');
        $spendings->total_spending = $request->input('total_spending');
        $spendings->save();
        return redirect('spendings')->with('status',"Pengeluaran Berhasil Ditambah");
    }
    public function edit($id){
        $spendings = Spending::find($id);
        return view('admin.spending.edit', [
            'spendings' => $spendings
        ]);
    }
    public function update(Request $request, $id){
        $spendings = Spending::find($id);
        $spendings->description = $request->input('description');
        $spendings->total_spending = $request->input('total_spending');
        $spendings->update();
        return redirect('spendings')->with('status',"Pengeluaran Berhasil Diupdate");
    }
    public function destroy($id){
        $spendings = Spending::find($id);
        $spendings->delete();
        return redirect('spendings')->with('status',"Pengeluaran Berhasil Dihapus");
    }
    public function deletespendings(){
        Spending::truncate();
        return redirect('spendings')->with('status',"Semua Data Berhasil Dihapus");
    }
    public function exportPdf(){
        $spendings = Spending::all();
        $total = Spending::sum('total_spending');
        $pdf = Pdf::loadView('admin.spending.export', [
            'spendings' => $spendings,
            'total' => $total
        ]);
        return $pdf->download('pengeluaran.pdf');
    }
}
