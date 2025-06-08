<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     */
        
    //     public function index()
    //     {
    //         $title = 'Danh Mục Sản Phẩm';
    //         $listDanhMuc = DanhMuc::orderByDesc('trang_thai')->get();
    // $listDanhMuc = DanhMuc::paginate(8);
    //         return view('admins.danhmucs.index', compact('title', 'listDanhMuc'));   
    //     }

    public function index(Request $request)
{
    $title = 'Danh Mục Sản Phẩm';
    $keyword = $request->input('keyword');

    $listDanhMuc = Category::query()
        ->when($keyword, function ($query, $keyword) {
            $query->where('name', 'like', "%$keyword%");
        })
        ->orderByDesc('trang_thai')
        ->paginate(6);

    return view('admins.categories.index', compact('title', 'listDanhMuc', 'keyword'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm Danh Mục Sản Phẩm';

       
        return view('admins.categories.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        if($request->isMethod('POST')){
            $params = $request->except('_token');
            if($request->hasFile('hinh_anh')){
                $filepath = $request->file('hinh_anh')->store('uploads/categories','public');
            }else{
                $filepath = null;
            }
        $params['hinh_anh'] = $filepath;
        Category::create($params);

        return redirect()->route('admins.categories.index')->with('success', 'Thêm danh mục thành công');
            // dd('đã vào store');
        }
    
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Chỉnh Sửa Danh Mục Sản Phẩm';
        $Category = Category::findOrFail($id);
        return view('admins.categories.edit', compact('title','Category'));
    }

    

    /** 
     * Update the specified resource in storage.
     */
    // public function update(DanhMucRequest $request, string $id)
    // {
    //     if ($request->isMethod('PUT')) {
    //         $params = $request->except('_token', '_method');
    //         $danhMuc = DanhMuc::findOrFail($id);
            
    //         if ($request->hasFile('hinh_anh')) {
    //             // Xóa hình ảnh cũ nếu tồn tại
    //             if ($danhMuc->hinh_anh && Storage::disk('public')->exists($danhMuc->hinh_anh)) {
    //                 Storage::disk('public')->delete($danhMuc->hinh_anh);
    //             }
                
    //             // Lưu hình ảnh mới
    //             $file = $request->file('hinh_anh')->store('uploads/danhmucs', 'public');
    //             $params['hinh_anh'] = $file;
    //         } 
    
    //         // Cập nhật dữ liệu
    //         $danhMuc->update($params);
    
    //         return redirect()->route('admins.danhmucs.index')->with('success', 'Cập nhật danh mục thành công');
    //     }
    // }
    
public function update(CategoryRequest $request, string $id)
{
    $Category = Category::findOrFail($id);
    $params = $request->except('_token', '_method');

    if ($request->hasFile('hinh_anh')) {
        // Xóa ảnh cũ nếu có
        if ($Category->hinh_anh && Storage::disk('public')->exists($Category->hinh_anh)) {
            Storage::disk('public')->delete($Category->hinh_anh);
        }

        $filepath = $request->file('hinh_anh')->store('uploads/danhmucs', 'public');
        $params['hinh_anh'] = $filepath;
    }

    $Category->update($params);

    return redirect()->route('admins.categories.index')->with('success', 'Cập nhật danh mục thành công');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Category = Category::findOrFail($id);

        if($Category){
            $Category->delete();
            if ($Category->hinh_anh && Storage::disk('public')->exists($Category->hinh_anh)) {
                Storage::disk('public')->delete($Category->hinh_anh);
            }
        }
        return redirect()->route('admins.categories.index')->with('success', 'Xoá danh mục thành công');

    }
}
