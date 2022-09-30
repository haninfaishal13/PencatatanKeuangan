<?php
namespace App\Helpers;

use App\Models\Category;

class CategoryHelper
{
    public static function getCategory($request) {
        $response = [];
        if(is_null($request->category_id)) {
            $categories = Category::with('sub_category')->get();
            foreach($categories as $category) {
                $sub_response = [];
                $tmp['id'] = $category->id;
                $tmp['name'] = $category->name;
                foreach($category->sub_category as $sub_category) {
                    $sub_tmp['id'] = $sub_category->id;
                    $sub_tmp['name'] = $sub_category->name;
                    array_push($sub_response, $sub_tmp);
                }
                $tmp['sub_category'] = $sub_response;
                array_push($response, $tmp);
            }
        } else {
            $sub_response = [];
            $category = Category::with('sub_category')->find($request->category_id);
            $response['id'] = $category->id;
            $response['name'] = $category->name;
            foreach($category->sub_category as $sub_category) {
                $sub_tmp['id'] = $sub_category->id;
                $sub_tmp['name'] = $sub_category->name;
                array_push($sub_response, $sub_tmp);
            }
            $response['sub_category'] = $sub_response;
        }

        return $response;
    }

    public static function showCategory($id)
    {
        $category = Category::find($id);
        return $category;
    }

    public static function storeCategory($request) {
        $category = Category::create([
            'name' => $request->name
        ]);
        return $category;
    }

    public static function updateCategory($request) {
        $category = Category::with('sub_category')->find($request->id);
        $category->update($request->only('name'));
        return $category;
    }

    public static function deleteCategory($id) {
        $category = Category::with('sub_category')->find($id);
        $category->delete();
        return true;
    }
}
?>
