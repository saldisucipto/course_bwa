<?php

namespace App\Http\Controllers\API;

use App\Classes\API\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{

    public function all(Request $request)
    {
        // filed parameter
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $show_product = $request->input('show_product');

        // jika id diisi
        if ($id) {
            $productCat = ProductCategory::with('products')->find($id);
            // jika produk ada mengembalikan response
            if ($productCat) {
                return ResponseFormatter::success($productCat, 'Data Kategori Produk Berhasil Diambil');
            } else {
                return ResponseFormatter::error(null, 'Data Kategori Produk Tidak Ada', 404);
            }
        }

        // memberikan relasi dengan query kosong
        $productCat = ProductCategory::query();

        // jika parameter nama di isi
        if ($name) {
            $productCat->where('name', 'like', '%' . $name . '%');
        }

        // jika parameter price between di isi
        if ($show_product) {
            $productCat->with('products');
        }

        // return hasil
        return ResponseFormatter::success($productCat->paginate($limit), 'Data Kategori Produk Berhasil Diambil');

    }

}
