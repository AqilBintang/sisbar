<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('type')->orderBy('price')->get();
        return view('barbershop.services', compact('services'));
    }

    public function getServices()
    {
        $services = Service::active()->orderBy('type')->orderBy('price')->get();
        return response()->json($services);
    }
}