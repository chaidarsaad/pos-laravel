<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Spending;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;


class DashboardController extends Controller
{
    public function index()
    {
      
        $product = Product::count();
        $total_orders = Order::count();
        $revenue = Order::sum('total_price');
        return view('admin.index', [
            'product' => $product,
            'total_orders' => $total_orders,
            'revenue' => $revenue
        ]);
    }


    public function users()
    {
        // $users = User::all();

        if(request()->ajax()){
            $query = User::query();
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
                                    <a class="dropdown-item" href="' . url('edit-user', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . url('delete-user', $item->id) . '" method="get">
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
        return view('admin.users.index');
    }

    public function edit($id)
    {
        $district = District::all();
        $users = User::with(['district'])->findOrFail($id);
        return view('admin.users.edit', [
            'district' => $district,
            'users' => $users
        ]);
    }

    public function update(Request $request, $id){
        $users = User::find($id);
        $users->name = $request->input('name');
        $users->phone = $request->input('phone');
        $users->email = $request->input('email');
        $users->districts_id = $request->input('districts_id');
        $users->address1 = $request->input('address1');
        $users->role_as = $request->input('role_as');
        if($request->password){
            $users['password'] = bcrypt($request->password);
        } else {
            unset($users['password']);
        }
        $users->update();
        return redirect('users')->with('status',"Akun Berhasil Diupdate");
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect('users')->with('status',"Akun Berhasil Dihapus");
    }
}
