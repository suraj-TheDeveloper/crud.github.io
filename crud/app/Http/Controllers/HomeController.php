<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $showdata = Crud::where("user_id", $user_id)->get();
        return view('home', compact('showdata'));
    }

    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validates = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'sdate' => ['required'],
            'edate' => ['required']
        ]);
        $user_id = Auth::user()->id;
        $status = 0;
        $task = Crud::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $status,
            'sdate' => $request->sdate,
            'edate' => $request->edate,
        ]);
        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //show all task
        $showtask = Crud::where("id", $id)->get();
        return view('show', compact('showtask'));
        // return view('show');
    }

}
