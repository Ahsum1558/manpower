<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\Cmspage;
use App\Models\TravelCmspage;
use Illuminate\Support\Facades\DB;

class TravelCmspageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_travelmeta = TravelCmspage::latest() -> get(); // as latest
        return view('super.travelmeta.index', compact('all_travelmeta'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super.travelmeta.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        TravelCmspage::create([
            'title'             => $request->title,
            'meta_title'        => $request->meta_title,
            'description'       => $request->description,
            'meta_description'  => $request->meta_description,
            'url'               => $request->url,
            'meta_keywords'     => $request->meta_keywords,
            'status'            => $request->status,
        ]);
        return redirect() -> back() -> with('message', 'Travel Meta added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $single_travelmeta_data = TravelCmspage::find($id);
        if ($single_travelmeta_data !== null) {
            return view('super.travelmeta.show', compact('single_travelmeta_data'));
        }else{
            return redirect('/super/travelmeta');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $travelmeta_data = TravelCmspage::find($id);

        if ($travelmeta_data !== null) {
            return view('super.travelmeta.edit', compact('travelmeta_data'));
        }else{
            return redirect('/super/travelmeta');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validation($request);

        $travelmeta_data = TravelCmspage::findOrFail($id);

        $travelmeta_data->title            = $request->title;
        $travelmeta_data->meta_title       = $request->meta_title;
        $travelmeta_data->description      = $request->description;
        $travelmeta_data->meta_description = $request->meta_description;
        $travelmeta_data->meta_keywords    = $request->meta_keywords;
        $travelmeta_data->status           = $request->status;
        $travelmeta_data->update();              

        return back()->with('message', 'Travel Meta Information is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $travel_data = TravelCmspage::find($id);
        $travel_data -> delete();

        return redirect() -> back() -> with('message', 'Travel Meta data deleted successfully');
    }

    public function inactive($id)
    {

        $travelmeta_inactive = TravelCmspage::findOrFail($id);

        $travelmeta_inactive->status       = 0;
        $travelmeta_inactive->update();              

        return redirect('/super/travelmeta')->with('message', 'The Travel Meta Info is Inactive Successfully');
    }
    
    public function active($id)
    {

        $travelmeta_active = TravelCmspage::findOrFail($id);

        $travelmeta_active->status       = 1;
        $travelmeta_active->update();              

        return redirect('/super/travelmeta')->with('message', 'The Travel Meta Info is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'title'         => 'required',
            'description'   => 'required',
            'url'           => 'required',
            'meta_keywords' => 'required',
            'status'        => 'required|in:1,0',
        ],
        [
            'title.required'         => 'Title Field must not be Empty',
            'description.required'   => 'Description Field must not be Empty',
            'url.required'           => 'URL Field is required',
            'meta_keywords.required' => 'Travel Meta Keywords Field is required',
            'status.required'        => 'Status Field is required',
            'status.in'              => 'Invalid status option selected',
        ]);
    }
}