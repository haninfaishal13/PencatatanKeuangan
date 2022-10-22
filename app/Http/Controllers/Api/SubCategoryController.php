<?php

namespace App\Http\Controllers\Api;

use App\Helpers\SubCategoryHelper;
use App\Http\Controllers\Controller;
use App\Rules\SubCategory\ChangeSubCategoryValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{

    public function index($category_id)
    {
        $subcategory = SubCategoryHelper::getSubCategory($category_id);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendapatkan subkategori',
            'data' => $subcategory
        ]);
    }

    public function selectSubCategory(Request $request)
    {

        $subcategory = SubCategoryHelper::selectSubCategory($request);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendapatkan subkategori',
            'data' => $subcategory
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required']
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 102,
                'message' => $validator->errors()
            ], 422);
        }
        SubCategoryHelper::storeSubCategory($request);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menyimpan subkategori baru'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer', 'exists:sub_categories,id', new ChangeSubCategoryValidation($request->id)],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'name' => ['sometimes', 'required']
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 102,
                'message' => $validator->errors()
            ], 422);
        }
        SubCategoryHelper::updateSubCategory($request);

        return response()->json([
            'success' => true,
            'message' => 'Sukses update subkategori'
        ]);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer', 'exists:sub_categories,id', new ChangeSubCategoryValidation($request->id)]
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => true,
                'code' => 102,
                'message' => $validator->errors()
            ],422);
        }
        SubCategoryHelper::deleteSubCategory($request);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil hapus subkategori'
        ]);
    }
}
