<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh Sách Tài Khoản";
        $role = request('role');

        $query = User::query();

        if ($role) {
            $query->where('role', $role);
        }
        $listUser = $query->orderByDesc('id')->get();

        return view('admins.taikhoans.index',compact('title','listUser'));
    }

    public function create()
    {
        $title = "Thêm Tài Khoản Khách Hàng";
        return view('admins.taikhoans.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            // 'email_verified_at' => 'boolean',
            'role' => 'required|in:user,admin',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Không mã hóa mật khẩu
            'phone' => $request->phone,
            'address' => $request->address,
            // 'email_verified_at' => $request->email_verified_at ? now() : null,
            'role' => $request->role,
        ]);
    
        return redirect()->route('admins.taikhoans.index')->with('success', 'Tài khoản khách hàng đã được thêm thành công.');
    }
    




    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
        {
            $title = "Chỉnh Sửa Tài Khoản Khách Hàng";
            $user = User::findOrFail($id);
            return view('admins.taikhoans.edit', compact('title', 'user'));
        }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8', // Mật khẩu tùy chọn
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email_verified_at' => 'boolean',
            'role' => 'required|in:User,Admin', // Kiểm tra role phải là User hoặc Admin
        ]);

        $User = User::findOrFail($id);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'email_verified_at' => $request->email_verified_at ? now() : null,
            'role' => $request->role, // Thêm trường role vào dữ liệu

        ];
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }


        if ($User->update($data)) {
            return redirect()->route('admins.taikhoans.index')->with('success', 'Tài khoản khách hàng đã được cập nhật thành công.');
        } else {
            return redirect()->back()->with('error', 'Cập nhật không thành công. Vui lòng thử lại.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

            $User = User::findOrFail($id);
            $User->delete();

            return redirect()->route('admins.taikhoans.index')->with('success', 'Tài khoản đã được xóa thành công.');

    }
}
