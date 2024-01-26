<?php

namespace App\Http\Controllers;

use App\Helpers\Traits\RowIndex;
use App\Models\Brand;
use App\Models\Origin;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class OriginController extends Controller
{
    use RowIndex;
    public function index(){
        $pageTitle = 'Product Brands';

        if (request()->ajax()) {
            $data = Origin::orderBy('id', 'DESC');

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('origin', function ($row) {
                    return $row->name;
                })
                ->addColumn('action', function ($row) {
                    $btn1 = '<button onclick="edit('.$row->id.');" type="button" class="btn btn-sm btn-primary me-2"><i class="bx bx-edit"></i></button>';
                    $btn2 = '<button onclick="destroy('. $row->id .')" type="button" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>';
                    return $btn1.$btn2;
                })
                ->rawColumns(['action', 'brand', 'sl'])
                ->make(true);
        }
        return view('admin.pages.origin', compact('pageTitle'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => ['required', 'min: 3', 'max:80']
        ]);

        $data = new Origin();
        $data->name = $request->name;
        $data->slug = Str::slug($request->name, '-').'-'.rand(1,500).rand(1,900);
        $data->save();

        return response()->json($data);
    }

    public function edit($id){
        $data = Origin::findOrFail($id);
        return response()->json($data);
    }
    public function update(Request $request, $id){
        $data = $request->validate([
            'id' => ['required'],
            'name' => ['required', 'min: 3', 'max:80']
        ]);

        $data = Origin::findOrFail($id);
        $data->name = $request->name;
        $data->save();
        return response()->json($data);
    }

    public function destroy($id){
        $check = Product::where('origin_id', $id)->first();
        if($check == false){
            $origin = Origin::findOrFail($id);
            if($origin == true){
                $origin->delete();
            }
            return response()->json($origin);
        }
        else{
            return response()->json('data_have');
        }
    }
}