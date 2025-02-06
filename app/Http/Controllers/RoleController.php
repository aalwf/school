<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller implements HasMiddleware // Implement Middleware Spatie
{
    // method static untuk menggunakan middleware
    public static function middleware()
    {
        return [
            new Middleware('permission:roles index', only: ['index']),
            new Middleware('permission:roles create', only: ['create', 'store']),
            new Middleware('permission:roles edit', only: ['edit', 'update']),
            new Middleware('permission:roles delete', only: ['destroy']),
        ];
    }

    // Menampilkan daftar roles.
    public function index(Request $request)
    {
        // mengambil data role untuk ditampilkan dalam halaman
        $roles = Role::select('id', 'name')
            ->with('permissions:id,name')
            ->when($request->search, fn($search) => $search->where('name', 'like', '%' . $request->search . '%'))
            ->latest()
            ->paginate(6);

        // render view
        return inertia('Roles/Index', ['roles' => $roles, 'filters' => $request->only(['search'])]);
    }

    // Menampilkan halaman tambah role.
    public function create()
    {
        // mengambil data permission
        // $permissions = Permission::all();
        $data = Permission::orderBy('name')->pluck('name', 'id');
        $collection = collect($data);
        $permissions = $collection->groupBy(function ($item, $key) {
            // Memecah string menjadi array kata-kata
            $words = explode(' ', $item);

            // Mengambil kata pertama
            return $words[0];
        });
        // return $permissions;
        // render view
        return inertia('Roles/Create', ['permissions' => $permissions]);
    }

    // Menyimpan data role baru.
    public function store(Request $request)
    {
        // validasi request form
        $request->validate([
            'name' => 'required|min:3|max:255|unique:roles',
            'selectedPermissions' => 'required|array|min:1',
        ]);

        // menyimpan data role ke database
        $role = Role::create(['name' => $request->name]);

        // menambahkan permission ke role
        $role->givePermissionTo($request->selectedPermissions);

        // render view
        return to_route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // Menampilkan halaman edit
    public function edit(Role $role)
    {
        // mengambil data permission
        $data = Permission::orderBy('name')->pluck('name', 'id');
        $collection = collect($data);
        $permissions = $collection->groupBy(function ($item, $key) {
            // Memecah string menjadi array kata-kata
            $words = explode(' ', $item);

            // Mengambil kata pertama
            return $words[0];
        });

        // load permissions
        $role->load('permissions');

        // render view
        return inertia('Roles/Edit', ['role' => $role, 'permissions' => $permissions]);
    }

    // Memperbarui data role
    public function update(Request $request, Role $role)
    {
        // validasi request form
        $request->validate([
            'name' => 'required|min:3|max:255|unique:roles,name,' . $role->id,
            'selectedPermissions' => 'required|array|min:1',
        ]);

        // mengupdate data role
        $role->update(['name' => $request->name]);

        // menambahkan permission ke role
        $role->syncPermissions($request->selectedPermissions);

        // render view
        return to_route('roles.index');
    }

    // Menghapus data role
    public function destroy(Role $role)
    {
        // hapus data role
        $role->delete();

        // render view
        return back();
    }
}
