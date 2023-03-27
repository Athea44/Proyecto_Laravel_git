<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Iluminate\Support\Facades\BD;

//use App\Models\Role;



class RolController extends Controller
{
    function __Construct()
{
    $this->middleware('permission:ver-rol | crear-rol | editar-rol | borrar-rol', ['only'=>['index']]);
    $this->middleware('permission:crear-rol',['only'=>['create','store']]);
    $this->middleware('permission:editar-rol', ['only'=>['edit', 'update']]);
    $this->middleware('permission:borrar-rol',['only'=>['destroy']]);
}



    

    public function index()
    {
        $roles =Role::all();
        return view('roles.index,',['roles'=>$roles]);
    }


    public function create()
    {
        $permission=Permission::get();
        return view('roles.crear');
    }

    
    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required','permission'=>'required']);
        $role= Role::create(['name'=>$request->input('permission')]);
        $role->sycPermissions($request->input('permission'));
        return redirect()->route('roles.index');
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit($id)
    {
        $role = Role::find($id);
        $permission=Permission::get();
        $rolePermission=BD::table('role_has_permissions')->where('role_has_permissions.role_id',$id)

            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('roles.editar', compact('role','permission','rolePermissions'));
    }

    
    public function update(Request $request, $id)
    {
        $this->->validate($request, ['name'=>'required','permission'=>'required']);
        $role= Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions(request->input('permission'));
        return redirect()->route('roles.index');
    }

    
    public function destroy(string $id)
    {
        //
    }
}
