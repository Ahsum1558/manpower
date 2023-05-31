<?php

namespace App\Http\Controllers\Locaton;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Issue;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_issue = $this->getInfo();
        return view('admin.location.issue.index', compact('all_issue'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $issue_create = Issue::latest() -> get(); // as latest
        $all_country = Country::latest() -> get(); // as latest

        return view('admin.location.issue.create', [
            'issue_create'=>$issue_create,
            'all_country'=>$all_country
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $issue_create = new Issue();

        $issue_create->issuePlace  = $request->issuePlace; 
        $issue_create->countryId   = $request->countryId;
        $issue_create->status      = $request->status;
        $issue_create->save();

        return redirect() -> back() -> with('message', 'Issue Place is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $issue_single_data = $this->getDetails($id);
        
        if($issue_single_data->count() > 0){
            return view('admin.location.issue.show', compact('issue_single_data'));
        }else{
            return redirect('/issue');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $issue_data = $this->getDetails($id);
        
        if($issue_data->count() > 0){
            return view('admin.location.issue.edit', compact('issue_data'));
        }else{
            return redirect('/issue');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validation($request);

        $issue_data = Issue::findOrFail($id);

        $issue_data->issuePlace  = $request->issuePlace; 
        $issue_data->update();

        return redirect() -> back() -> with('message', 'Issue Place Name is Updated successfully');
    }

    public function editInfo($id)
    {
        $issue_data_info = $this->getDetails($id);
        $all_country = Country::latest() -> get();
        
        if($issue_data_info->count() > 0){
            return view('admin.location.issue.editInfo', [
            'issue_data_info'=>$issue_data_info,
            'all_country'=>$all_country
        ]);
        }else{
            return redirect('/issue');
        }
    }

    public function updateInfo(Request $request, $id)
    {
        $issue_data_info = Issue::findOrFail($id);

        $issue_data_info->countryId     = $request->countryId;
        $issue_data_info->status        = $request->status;
        $issue_data_info->update();

        return redirect() -> back() -> with('message', 'Issue Place Info is Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_issue = Issue::find($id);
        $data_issue -> delete();

        return redirect() -> back() -> with('message', 'The Issue Place is deleted successfully');
    }

    public function inactive(Request $request, $id)
    {

        $issue_inactive = Issue::findOrFail($id);

        $issue_inactive->issuePlace  = $request->issuePlace;
        $issue_inactive->status      = 0;
        $issue_inactive->update();              

        return redirect('/issue')->with('message', 'The Issue Place is Inactive Successfully');
    }
    
    public function active(Request $request, $id)
    {

        $issue_active = Issue::findOrFail($id);

        $issue_active->issuePlace  = $request->issuePlace;
        $issue_active->status      = 1;
        $issue_active->update();              

        return redirect('/issue')->with('message', 'The Issue Place is Active Successfully');
    }

    protected function getDetails($id){
        $data_details = Issue::leftJoin('countries','issues.countryId','=','countries.id')
        ->where('issues.id', $id)
        ->select('issues.*', 'countries.countryname', 'countries.nationality')->get();
        return $data_details;
    }

    protected function getInfo(){
        $data_info = Issue::leftJoin('countries','issues.countryId','=','countries.id')
        ->select('issues.*', 'countries.countryname', 'countries.nationality')
        ->orderBy('countries.countryname')
        ->orderBy('issues.issuePlace')
        ->get();
        return $data_info;
    }

    protected function validation($request){
        $this -> validate($request, [
            'issuePlace'       => 'required|unique:issues',
        ],
        [
            'issuePlace.required' => 'Issue Place Name Field must not be Empty',
            'issuePlace.unique'   => 'The Issue Place Name is already exist',
        ]);
    }
}
