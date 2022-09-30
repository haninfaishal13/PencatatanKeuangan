<?php

namespace App\Http\Controllers\Api;

use App\Helpers\CategoryHelper;
use App\Http\Controllers\Controller;
use App\Rules\Category\ChangeCategoryValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $category = CategoryHelper::getCategory($request);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendapatkan kategori',
            'data' => $category
        ]);
    }

    public function show($id)
    {
        $category = CategoryHelper::showCategory($id);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data kategori',
            'data' => $category
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required']
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 101,
                'message' => $validator->errors(),
            ], 422);
        }
        CategoryHelper::storeCategory($request);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambah kategori baru'
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', new ChangeCategoryValidation($request->id)],
            'name' => ['required']
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 101,
                'message' => $validator->errors(),
            ], 422);
        }
        $category = CategoryHelper::updateCategory($request);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil update kategori'
        ]);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->only('id'), [
            'id' => ['required', 'integer', 'exists:categories,id', new ChangeCategoryValidation($request->id)]
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 101,
                'message' => $validator->errors()
            ], 422);
        }
        CategoryHelper::deleteCategory($request->id);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus kategori'
        ]);

    }
}
