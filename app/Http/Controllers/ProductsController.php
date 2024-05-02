<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\DataTables;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Product::all();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm editButton" data-toggle="modal" data-target=".bd-example-modal-lg" data-id = "' . $row->id . '">Edit</a>
                    <a href="javascript:void(0)" class="edit btn btn-danger btn-sm deleteButton" data-id = "' . $row->id . '">Delete</a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('product');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function showCreate()
    {
        return view('adminlte.create');
    }
    public function create(CheckRequest $request)
    {
        try {
            if (!auth()->user()->can('store-product')) {
                return response()->json(['message' => 'You have no Permsiion to store Product'], 403);
            } else {
                $validated = $request->validated();
                $storeProduct = Product::create([
                    'name' => $request->name,
                    'price' => $request->price,
                    'description' => $request->description,
                ]);
                $save = $storeProduct->save();
                if ($save) {
                    $imagePath = $request->file('image')->store('images', 'public');
                    $path = url($imagePath);
                    $productRelation = new Image();
                    $productRelation->product_id = $storeProduct->id;
                    $productRelation->path = $path;

                    $productRelation->save();
                }
                return response()->json("Product stored Successfully", 200);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


    public function update(Request $request)
    {
        try {
            if (!auth()->user()->can('update-product')) {
                return response()->json(['message' => 'You have no Permsiion to update Product'], 403);
            } else {
                $validated = $request->validated();

                $product = Product::findOrFail($request->Productid)->first();
                if ($product) {
                    $product->update([
                        'name' => $request->name,
                        'price' => $request->price,
                        'description' => $request->description
                    ]);
                    return response()->json("Product Updated Successfully", 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function edit($id)
    {
        try {
            if (!auth()->user()->can('edit-product')) {
                return response()->json(['message' => 'You have no Permsiion to edit Product'], 403);
            } else {
                $product = Product::where('id', $id)->first();
                return response()->json($product);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            if (!auth()->user()->can('delete-product')) {
                return response()->json(['message' => 'You have no Permsiion to delete Product'], 403);
            } else {
                $product = Product::where('id', $id)->first();
                $product->delete();
                return response()->json("Product Deleted Successfully", 200);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
