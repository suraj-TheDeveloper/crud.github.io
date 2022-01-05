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
    }

    /**
     * Update the specified data.
     *
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        $validates = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'sdate' => ['required'],
            'edate' => ['required']
        ]);
        $taskdetails = new Crud();
        // dd($request->all());
        // dd($request->has('status'));
        if($request->has('status')) {
            $status = 1;
        } else {
            $status = 0;
        }
        $user_id = Auth::user()->id;
        Crud::where('id', $id)->update(['name' => $request->name, 'description' => $request->description, 'status' => $status, 'sdate' => $request->sdate, 'edate' => $request->edate]);
        return redirect(route('home'));
    }

    /**
     * Delete the specific data
     *
     * @param int $id
     */
    public function destory($id)
    {
        Crud::where("id", $id)->delete();
        return redirect(route('home'));
    }

    /**
     * Update the status of specific data
     *
     * @param int $id
     */
    public function updateStatus(Request $request)
    {
        if($request->status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        Crud::where('id', $request->id)->update(['status' => $status]);
    }

}
