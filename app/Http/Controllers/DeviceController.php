<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DeviceController extends Controller
{
    public function index(){
        $devices = Device::with('deviceStats')->get();
        return Inertia::render(
            'Devices',
            compact('devices'),
        );
        // return view('welcome',compact('devices'));
    }
   public function list()
   {
       $devices = Device::all();
       return response()->json($devices);
   }
}
