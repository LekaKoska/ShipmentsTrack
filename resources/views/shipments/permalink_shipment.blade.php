{{-- resources/views/shipments/permalink_shipment.blade.php --}}
@extends('layout')

@section('section')
    <style>
        .shipment-container {
            max-width: 700px;
            margin: 40px auto;
            background: #fefefe;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            font-family: Arial, sans-serif;
        }

        .shipment-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .shipment-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .shipment-row:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
            color: #555;
        }

        .details {
            margin-top: 15px;
            font-size: 14px;
            color: #444;
            line-height: 1.5;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background-color: #6366f1;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .back-btn:hover {
            background-color: #4f46e5;
        }
    </style>

    <div class="shipment-container">
        <h1>{{ $shipment->title }}</h1>

        <div class="shipment-row">
            <span class="label">From City:</span>
            <span>{{ $shipment->from_city }}</span>
        </div>
        <div class="shipment-row">
            <span class="label">From Country:</span>
            <span>{{ $shipment->from_country }}</span>
        </div>
        <div class="shipment-row">
            <span class="label">To City:</span>
            <span>{{ $shipment->to_city }}</span>
        </div>
        <div class="shipment-row">
            <span class="label">To Country:</span>
            <span>{{ $shipment->to_country }}</span>
        </div>
        <div class="shipment-row">
            <span class="label">Price:</span>
            <span>${{ number_format($shipment->price, 2) }}</span>
        </div>
        <div class="shipment-row">
            <span class="label">Status:</span>
            <span>{{ ucfirst($shipment->status) }}</span>
        </div>
        <div class="shipment-row">
            <span class="label">User ID:</span>
            <span>{{ $shipment->user_id }}</span>
        </div>

        <div class="details">
            <span class="label">Details:</span>
            <p>{{ $shipment->details }}</p>
        </div>

        <a href="{{ route('shipments.index') }}" class="back-btn">Back to Shipments</a>
    </div>
    <div class="documents">
        <span class="label">Documents:</span>

        @foreach($shipment->shipment_docs as $document)
            <a target="_blank" href="/storage/documents/{{$document->shipment_document}}"> {{$document->shipment_document}}</a>
        @endforeach


    </div>
@endsection
