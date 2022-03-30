<?php

namespace App\Http\Controllers;

use App\Container;
use Illuminate\Http\Request;
use Redirect,Response;
Use DB;
use Carbon\Carbon;

class ContainerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_container_form()
    {  
      if( \View::exists('container.create') ){

        return view('container.create');

      }
    }

    public function submit_container_data(Request $request)
    {
      $rules = [
          'janis' => 'required',
          'dimensi_internal' => 'required',
          'door_opening' => 'required',
          'weight' => 'required',
      ];

      $errorMessage = [
          'required' => 'Enter your :attribute first.'
      ];

      $this->validate($request, $rules, $errorMessage);
      
      Container::create([
         'janis' => $request->janis,
         'dimensi_internal' => $request->dimensi_internal,
         'door_opening' =>  $request->door_opening,
         'weight' => $request->weight,
         'status' => $request->status,
      ]);

      $this->meesage('message','container created successfully!');
      return redirect()->back();

    }

 

    public function fetch_all_container()
    {
       $containers = Container::toBase()->get();
       return view('container.index',compact('containers'));
    }

    public function edit_container_form(Container $container)
    { 
       return view('container.edit',compact('container'));
    }

    public function edit_container_form_submit(Request $request, Container $container)
    {
        $rules = [
            'janis' => 'required',
            'dimensi_internal' => 'required',
            'door_opening' => 'required',
            'weight' => 'required',
        ];
  
        $errorMessage = [
            'required' => 'Enter your :attribute first.'
        ];

      $this->validate($request, $rules, $errorMessage);

      $container->update([
                    'janis' => $request->janis,
                    'dimensi_internal' => $request->dimensi_internal,
                    'door_opening' => $request->door_opening,
                    'weight' => $request->weight,
                    'status' => isset($request->status) ? 1 : 0 ,
                ]);

      $this->meesage('message','container updated successfully!');
      return redirect()->back();
    }

    public function view_single_container(Container $container)
    {
      return view('container.view',compact('container'));
    }
    public function delete_container(Container $container)
    {
      $container->delete();
      $this->meesage('message','Container deleted successfully!');
      return redirect()->back();
    }

    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
