<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShipmentsRequest;
use App\Http\Requests\UpdateShipment;
use App\Models\Shipment;
use App\Models\ShipmentDocuments;
use App\Traits\ImageUpload;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
class ShipmentsController extends Controller
{
    use ImageUpload, AuthorizesRequests;
    public function index()
    {
        $shipments =  Cache::remember('shipments_unassigned', 300, fn() => Shipment::unassignedshipments()->get());
        return view('shipments.index',
            [
                'shipments' => $shipments
            ]);
    }
    public function create()
    {
        $this->authorize('view', Shipment::class);
        return view('shipments.create_shipment');
    }
    public function store(ShipmentsRequest $request)
    {
        $this->authorize('create', Shipment::class);
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
        Gate::authorize('view', $shipment);
        $shipment->load('shipment_docs');
        return view('shipments.permalink_shipment', compact('shipment'));
    }
    public function edit(Shipment $shipment): View
    {
        $this->authorize('edit', Shipment::class);
        return view('shipments.edit', compact('shipment'));
    }
    public function update(UpdateShipment $request, Shipment $shipment)
    {
        $shipment->update($request->validated());
        return redirect()->back();
    }
    public function destroy(Shipment $shipments)
    {
        //
    }
    public function assignedUser(Request $request, Shipment $shipment): RedirectResponse
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        $shipment->user_id = $request->user_id;
        $shipment->status = Shipment::STATUS_STARTED;
        $shipment->save();
        return redirect()->back();
    }

}
