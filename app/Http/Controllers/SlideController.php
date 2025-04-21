<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Facades\File;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('order', 'asc')->get();
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Tạo đường dẫn lưu ảnh
        $destinationPath = 'images/slides';
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Di chuyển ảnh đến thư mục public/images/slides
        $image->move(public_path($destinationPath), $imageName);

        // Lưu thông tin vào cơ sở dữ liệu
        Slide::create([
            'image' =>  $imageName,
            'order' => $request->input('order', 0),
            'status' => $request->input('status', 1),
        ]);

        return redirect()->route('slides.index')->with('success', 'Slide đã được thêm thành công.');
    }

    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Xử lý cập nhật ảnh nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu tồn tại
            if (File::exists(public_path($slide->image))) {
                File::delete(public_path($slide->image));
            }

            // Tạo đường dẫn lưu ảnh mới
            $destinationPath = 'images/slides';
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Di chuyển ảnh đến thư mục public/images/slides
            $image->move(public_path($destinationPath), $imageName);

            // Cập nhật đường dẫn ảnh trong cơ sở dữ liệu
            $slide->image =  $imageName;
        }

        // Cập nhật các thông tin khác
        $slide->update([
            'order' => $request->input('order', 0),
            'status' => $request->input('status', 1),
        ]);

        return redirect()->route('slides.index')->with('success', 'Slide đã được cập nhật.');
    }

    public function destroy(Slide $slide)
    {
        // Xóa ảnh khỏi thư mục public nếu tồn tại
        if (File::exists(public_path($slide->image))) {
            File::delete(public_path($slide->image));
        }

        $slide->delete();
        return redirect()->route('slides.index')->with('success', 'Slide đã được xóa.');
    }
}
