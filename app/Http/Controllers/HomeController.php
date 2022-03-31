<?php

namespace App\Http\Controllers;

use App\User;
use App\Data;
use Illuminate\Http\Request;
use Redirect,Response;
Use DB;
use Carbon\Carbon;
// use DataTables;

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
    public function json(){
        return Data::all();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
       

        $data = Data::select('status', \DB::raw("count('status') as count"))
        ->groupBy('status')
        ->get();

        $stage = Data::select('stage', \DB::raw("count('stage') as count"))
        ->groupBy('stage')
        ->orderBy('stage')
        ->get();

        $posts = Data::all();

  
        return view('home', compact('data','stage','posts'));
    
    }


    public function store(Request $request)
    {

        $request->validate([
          'category' => 'required',
        ]);

        $post = Data::updateOrCreate(['id' => $request->id], [
                  'carp_code' => 'CARP00020',
                  'category' => $request->category,
                  'initiator' => $request->initiator,
                  'initiator_div' => $request->initiator_div,
                  'initiator_branch' => $request->initiator_branch,
                  'recipient' => $request->recipient,
                  'recipient_div' => $request->recipient_div,
                  'due_date' => date('Y-m-d h:i:s'),
                  'recipient_branch' => $request->recipient_branch,
                  'date_create' => date('Y-m-d h:i:s'),
                  'status_date'=>date('Y-m-d h:i:s'),
                  'verified_by' =>'Hasan',
                  'effectiveness' =>'-',
                  'stage'=>'Open',
                  'status'=>'Open',
                ]);

        return response()->json(['code'=>200, 'message'=>'Data Created successfully','data' => $post], 200);

    }
    
    /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    
    public function show($id)
    {
        $post = Data::find($id);
        
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Data::find($id)->delete();

      return response()->json(['success'=>'Data Deleted successfully']);
    }    
}
