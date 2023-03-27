<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategory;


class CategorytController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(5);
        return view('dashboard.category.index',['categories'=>$categories]);

        return $this->sucessResponse(Category::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.category.create', ['category' => new Category()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategory $request)
    {
        $request->validate([
            'name'=>'required|min:3|max:100',
            'description'=>'required|min:5'
        ]);

        $category=new Category();
        $category->name=$request->input('name');
        $category->description=$request->input('description');  
        $category->save();  

        return view("dashboard.category.message", ['msg'=>"la categoria ha sido creada con ex"]);


        //Category::create($request->validated());
        //return back()->with('status', 'Categoria ha sido creada con éxito');



    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.category.show',["category" => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit',["category" => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategory $request, Category $category)
    {
        
        $category->update($request->validated());
        return back()->with('status', 'Category fue modificado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('status', 'Category eliminado exitosamente');
    }

    public function all()
    {
        return $this->sucessResponse(Category::all());
    }

    public function __construct()
    {
        $this->middleware('auth');
    }



}
