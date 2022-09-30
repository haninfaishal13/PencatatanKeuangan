<?php
namespace App\Helpers;

use App\Models\SubCategory;

class SubCategoryHelper
{
    public static function getSubCategoryAll()
    {
        $subcategory = SubCategory::select('id', 'category_id', 'name')->orderBy('category_id', 'asc')->get();
        return $subcategory;
    }

    public static function selectSubcategory($request)
    {
        if($request->search == null) {
            $subcategories = self::getSubCategoryAll();
        } else {
            $subcategories = self::getSubCategoryAll()->where("name", "like", "%{$request->search}%");
        }

        $response = [];
        foreach($subcategories as $subcategory) {
            array_push($response, array(
                'id' => $subcategory->id,
                'text' => $subcategory->name
            ));
        }
        return $response;
    }

    public static function getSubCategory($id)
    {
        $subcategory = self::getSubCategoryAll()->where('category_id', $id);
        return $subcategory;
    }

    public static function storeSubCategory($request)
    {
        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name
        ]);

        return true;
    }

    public static function updateSubCategory($request)
    {
        $sub_category = SubCategory::find($request->id);
        $req['name'] = $request->name == null ? $sub_category->name : $request->name;
        $req['category_id'] = $request->category_id == null ? $sub_category->category_id : $request->category_id;
        $sub_category->update($req);

        return true;
    }

    public static function deleteSubCategory($request)
    {
        SubCategory::find($request->id)->delete();
        return true;
    }
}
?>
