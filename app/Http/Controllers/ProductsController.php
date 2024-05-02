<?php
namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
class ProductsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('id','name','description','price');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // <a href="javascript:void(0)" class="edit btn btn-success btn-sm viewButton" data-id = "'.$row->id.'">View</a>

                    return '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm editButton" data-toggle="modal" data-target=".bd-example-modal-lg" data-id = "'.$row->id.'">Edit</a>
                    <a href="javascript:void(0)" class="edit btn btn-danger btn-sm deleteButton" data-id = "'.$row->id.'">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('product');
    }
    public function showCreate()
    {
        return view('adminlte.create');
    }
    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
            $storeProduct = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);
           $save= $storeProduct->save();
            if($save)
            {
                $imagePath = $request->file('image')->store('images', 'public');
                $path = url($imagePath);
                $productRelation = new Image();
                $productRelation->product_id = $storeProduct->id;
                $productRelation->path = $path;

                $productRelation->save();
            }
        return response("Product stored Successfully",200);
       
    }


        public function update(Request $request)
        {
                $validator = Validator::make($request->all(), [
                    'name'  => 'required',
                    'price' => 'required|numeric',
                    'description' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }
                $product = Product::where('id',$request->Productid)->first();
                if($product)
                {
                    $product->update([
                        'name'=>$request->name,
                        'price'=>$request->price,
                        'description'=>$request->description
                    ]);
                    return response("Product Updated Successfully",200);
            }
        }


    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json($product);
    }
    public function edit($id)
    {
        $product = Product::where('id',$id)->first();
        return $product;
    }

    public function delete($id)
    {
        $product = Product::where('id',$id)->first();
        $product->delete();
        return response("Product Deleted Successfully",200);
    }
}
