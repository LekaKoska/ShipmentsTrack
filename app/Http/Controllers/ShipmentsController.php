<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShipmentsRequest;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShipmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipments =  Cache::remember('shipments_unassigned', 300, fn() => Shipment::where('status', Shipment::STATUS_UNASSIGNED)->get());
        return view('shipments.index',
            [
                'shipments' => $shipments
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('shipments.create_shipment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShipmentsRequest $request)
    {
       Shipment::create($request->validated());
       Cache::forget('shipments_unassigned');
       return redirect()->route('shipments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {


        return view('shipments.permalink_shipment', compact('shipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipments)
    {
        //
    }

}
