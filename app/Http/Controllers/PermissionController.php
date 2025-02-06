<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller implements HasMiddleware
{
    // method static untuk menggunakan middleware
    public static function middleware()
    {
        return [
            new Middleware('permission:permissions index', only: ['index']),
            new Middleware('permission:permissions create', only: ['create', 'store']),
            new Middleware('permission:permissions edit', only: ['edit', 'update']),
            new Middleware('permission:permissions delete', only: ['destroy']),
        ];
    }

    // method untuk menampilkan halaman permissions
    public function index(Request $request)
    {
        // mengambil data permission untuk ditampilkan dalam halaman
        $permissions = Permission::select('id', 'name')
            ->when($request->search, fn($search) => $search->where('name', 'like', '%' . $request->search . '%'))
            ->latest()
            ->paginate(6)->withQueryString();

        // render view
        return inertia('Permissions/Index', ['permissions' => $permissions, 'filters' => $request->only(['search'])]);
    }

    // method untuk menampilkan halaman tambah permission
    public function create()
    {
        // render view
        return inertia('Permissions/Create');
    }

    // method untuk menyimpan data permission ke database
    public function store(Request $request)
    {
        // validasi request form
        $request->validate(['name' => 'required|min:3|max:255|unique:permissions']);

        // menyimpan data permission
        Permission::create(['name' => $request->name]);

        // render view
        return to_route('permissions.index');
    }

    // method untuk menampilkan halaman edit
    public function edit(Permission $permission)
    {
        // render view
        return inertia('Permissions/Edit', ['permission' => $permission]);
    }

    // method untuk memperbarui data permission
    public function update(Request $request, Permission $permission)
    {
        // validasi request form
        $request->validate(['name' => 'required|min:3|max:255|unique:permissions,name,' . $permission->id]);

        // mengupdate data permission
        $permission->update(['name' => $request->name]);

        // render view
        return to_route('permissions.index');
    }

    // method untuk menghapus data permission
    public function destroy(Permission $permission)
    {
        // delete permissions data
        $permission->delete();

        // render view
        return back();
    }
}
