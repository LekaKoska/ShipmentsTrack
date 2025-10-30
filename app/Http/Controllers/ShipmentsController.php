<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShipmentsRequest;
use App\Models\Shipment;
use App\Models\ShipmentDocuments;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShipmentsController extends Controller
{
    use ImageUpload;
    public function index()
    {
        $shipments =  Cache::remember('shipments_unassigned', 300, fn() => Shipment::where('status', Shipment::STATUS_UNASSIGNED)->get());
        return view('shipments.index',
            [
                'shipments' => $shipments
            ]);
    }
    public function create()
    {
        return view('shipments.create_shipment');
    }
    public function store(ShipmentsRequest $request)
    {
       $shipment = Shipment::create($request->validated());
        foreach ($request->file('documents') as $document) {
            $fileTypes = [
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ];
            if (str_starts_with($document->getMimeType(), 'image')) {

             $name = $this->imageUpload($document, "documents/$shipment->id");
             $name = $shipment->id."/".$name;
             ShipmentDocuments::create([
                 'shipment_id' => $shipment->id,
                 'shipment_document' => $name
             ]);
            }

            elseif(in_array($document->getMimeType(), $fileTypes)) {
                $extension = $document->getClientOriginalExtension();
                $filename = uniqid().".".$extension;
                $path = $document->storeAs("documents/{$shipment->id}", $filename, 'public');
                $path = str_replace('documents/', "", $path);
                ShipmentDocuments::create([
                    'shipment_id' => $shipment->id,
                    'shipment_document' => $path
                ]);

            }
        }
       return redirect()->route('shipments.index');
    }
    public function show(Shipment $shipment)
    {
        $shipment->load('shipment_docs');
        return view('shipments.permalink_shipment', compact('shipment'));
    }
    public function edit(Shipment $shipments)
    {
        //
    }
    public function update(Request $request, Shipment $shipments)
    {
        //
    }
    public function destroy(Shipment $shipments)
    {
        //
    }

}
