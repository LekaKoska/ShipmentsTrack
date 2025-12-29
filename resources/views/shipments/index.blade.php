@php use App\Models\User; @endphp
@extends('layout')

@section('section')
    <style>
        .shipments {
            max-width: 900px;
            margin: 30px auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
            font-family: Arial, sans-serif;
        }

        .shipment {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        }

        .shipment h2 {
            margin: 0 0 10px;
            font-size: 20px;
            color: #333;
        }

        .shipment .row {
            display: flex;
            justify-content: space-between;
            margin: 6px 0;
            font-size: 14px;
            color: #555;
        }

        .shipment .label {
            font-weight: bold;
            color: #222;
        }

        .shipment .details {
            margin-top: 10px;
            font-size: 14px;
            color: #444;
            line-height: 1.5;
        }
    </style>

    <div class="shipments">
        @foreach($shipments as $shipment)
            <div class="shipment">
                <h2>{{ $shipment->title }}</h2>

                <div class="row">
                    <span class="label">From City:</span>
                    <span>{{ $shipment->from_city }}</span>
                </div>
                <div class="row">
                    <span class="label">From Country:</span>
                    <span>{{ $shipment->from_country }}</span>
                </div>
                <div class="row">
                    <span class="label">To City:</span>
                    <span>{{ $shipment->to_city }}</span>
                </div>
                <div class="row">
                    <span class="label">To Country:</span>
                    <span>{{ $shipment->to_country }}</span>
                </div>
                <div class="row">
                    <span class="label">Price:</span>
                    <span>${{ number_format($shipment->price, 2) }}</span>
                </div>
                <div class="row">
                    <span class="label">Status:</span>
                    <span>{{ ucfirst($shipment->status) }}</span>
                </div>
                <div class="row">
                    <span class="label">User ID:</span>
                    <span>{{ $shipment->user_id }}</span>
                </div>

                <div class="details">
                    <span class="label">Details:</span>
                    <p>{{ $shipment->details }}</p>
                </div>

                <a href="{{route('shipments.show', $shipment->id)}}">View</a>
                <form action="{{route('shipments.assigned', $shipment->id)}}" method="POST">
                    @csrf
                    <select name="user_id">
                        <option selected disabled>None</option>
                        @foreach(User::all() as $user)
                            <option value="{{$user->id}}">
                                {{$user->name}}
                            </option>
                        @endforeach
                    </select>
                    <button>Assigned</button>
                </form>

            </div>
        @endforeach
    </div>
    <livewire:shipments-assigned-list> </livewire:shipments-assigned-list>
@endsection
