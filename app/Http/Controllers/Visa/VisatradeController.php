<?php

namespace App\Http\Controllers\Visa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visatrade;
use DB;

class VisatradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_visa_trade = Visatrade::latest() -> get(); // as latest
        return view('admin.visa.visatrade.index', compact('all_visa_trade'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.visa.visatrade.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Visatrade::create([
            'visatrade_name'   => $request->visatrade_name,
            'status'          => $request->status,
        ]);
        return redirect() -> back() -> with('message', 'Visa Trade is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $single_visaTrade = Visatrade::find($id);
        
        if ($single_visaTrade !== null) {
            return view('admin.visa.visatrade.show', compact('single_visaTrade'));
        }else{
            return redirect('/visaTrade');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visaTrade_data = Visatrade::find($id);
        
        if ($visaTrade_data !== null) {
            return view('admin.visa.visatrade.edit', compact('visaTrade_data'));
        }else{
            return redirect('/visaTrade');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validation($request);
        $visaTrade_data = Visatrade::findOrFail($id);

        $visaTrade_data->visatrade_name   = $request->visatrade_name;
        $visaTrade_data->update();              

        return back()->with('message', 'The Visa Trade is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_visaTrade = Visatrade::find($id);
        $data_visaTrade -> delete();

        return redirect() -> back() -> with('message', 'The Visa Trade is deleted successfully');
    }

    public function inactive($id)
    {

        $visatrade_inactive = Visatrade::findOrFail($id);

        $visatrade_inactive->status      = 0;
        $visatrade_inactive->update();              

        return redirect('/visaTrade')->with('message', 'The Visa Trade is Inactive Successfully');
    }
    
    public function active($id)
    {

        $visatrade_active = Visatrade::findOrFail($id);

        $visatrade_active->status    = 1;
        $visatrade_active->update();              

        return redirect('/visaTrade')->with('message', 'The Visa Trade is Active Successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'visatrade_name'       => 'required|unique:visatrades',
        ],
        [
            'visatrade_name.required' => 'Visa Trade Field must not be Empty',
            'visatrade_name.unique'   => 'The Visa Trade is already exist',
        ]);
    }
}