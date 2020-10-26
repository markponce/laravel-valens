<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\PaintJob;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PaintJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paintJobsInProgress = PaintJob::whereNull('completed_at')->with('currentColor', 'targetColor')->orderBy('created_at', 'asc')->take(5)->get();
        $paintQueues = PaintJob::whereNull('completed_at')->with('currentColor', 'targetColor')->orderBy('created_at', 'asc')->offset(5)->limit(10)->get();
        $paintJobCount = PaintJob::whereNotNull('completed_at')->count();
        $colors = Color::all();
        // return $colors->paintJobs->count();
        // return $colors;
        // $colors = 
        // return $paintJobs;
        return view('paint_job.index', compact(
            'paintJobsInProgress', 
            'paintQueues',
            'paintJobCount',
            'colors',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $colors = Color::all();        
        return view('paint_job.create', compact('colors'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'plate_number' => 'required|unique:paint_jobs,plate_number|max:10',
            'current_color' => 'required|exists:colors,id',
            'target_color' => 'required|exists:colors,id|different:current_color'
        ]);
        
        PaintJob::create($validatedData);
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaintJob  $paintJob
     * @return \Illuminate\Http\Response
     */
    public function show(PaintJob $paintJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaintJob  $paintJob
     * @return \Illuminate\Http\Response
     */
    public function edit(PaintJob $paintJob)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaintJob  $paintJob
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaintJob $paintJob)
    {

        $paintJob = PaintJob::find($request->id);

        $paintJob->completed_at = Carbon::now();

        $paintJob->save();

        return redirect('paint-jobs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaintJob  $paintJob
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaintJob $paintJob)
    {
        //
    }
}
