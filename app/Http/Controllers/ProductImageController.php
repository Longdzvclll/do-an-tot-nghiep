<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    public function delete($id)
    {
        $image = ProductImage::findOrFail($id);

        // Xóa file ảnh nếu tồn tại
        if (File::exists(public_path('images/products/' . $image->image_name))) {
            File::delete(public_path('images/products/' . $image->image_name));
        }

        // Xóa bản ghi trong cơ sở dữ liệu
        $image->delete();

        return back()->with('success', 'Ảnh đã được xóa thành công');
    }
}

