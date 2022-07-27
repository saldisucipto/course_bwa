<?php

namespace App\Http\Controllers\API;

use App\Classes\API\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // untuk menghandle product request
    public function all(Request $request)
    {
        // field yang digunakan
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $description = $request->input('description');
        $tags = $request->input('tags');
        $categories = $request->input('categories');

        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        // Jika Route memberikan $id parameter id
        if ($id) {
            $product = Product::with(['category', 'galleries'])->find($id);
            // jika produk ada mengembalikan response
            if ($product) {
                return ResponseFormatter::success($product, 'Data Produk Berhasil Diambil');
            } else {
                return ResponseFormatter::error(null, 'Data Produk Tidak Ada', 404);
            }
        }

        // Jika Tidak ada $id parameter Diisi kita menmapilkan Smua data
        $product = Product::with(['category', 'galleries']);

        // jika parameter nama di isi
        if ($name) {
            $product->where('name', 'like', '%' . $name . '%');
        }

        // jika parameter description di isi
        if ($description) {
            $product->where('description', 'like', '%' . $description . '%');
        }

        // jika parameter tags di isi
        if ($tags) {
            $product->where('tags', 'like', '%' . $tags . '%');
        }

        // jika parameter price between di isi
        if ($price_from) {
            $product->where('price_from', 'like', '%' . $price_from . '%');
        }
        // jika parameter price between di isi
        if ($price_to) {
            $product->where('price_to', 'like', '%' . $price_to . '%');
        }

        // jika parameter price between di isi
        if ($categories) {
            $product->where('categories', 'like', '%' . $categories . '%');
        }

        // return hasil
        return ResponseFormatter::success($product->paginate($limit), 'Data Produk Berhasil Diambil');
    }

}
