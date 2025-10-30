@php use App\Models\Shipment; @endphp

{{-- resources/views/shipments/create.blade.php --}}
@extends('layout')

@section('section')
    <style>
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background: #f9f9f9;
            padding: 20px 25px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input,
        .form-group textarea {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #6366f1;
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #6366f1;
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .submit-btn:hover {
            background-color: #4f46e5;
        }

        .error {
            color: #ef4444;
            font-size: 13px;
            margin-top: 3px;
        }
    </style>

    <div class="form-container">
        <h1>Create Shipment</h1>
        <form action="{{ route('shipments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Enter a title">
                @error('title')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="from_city">From City</label>
                <input type="text" name="from_city" id="from_city" value="{{ old('from_city') }}"
                       placeholder="Enter from city">
                @error('from_city')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="from_country">From Country</label>
                <input type="text" name="from_country" id="from_country" value="{{ old('from_country') }}"
                       placeholder="Enter from country">
                @error('from_country')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="to_city">To City</label>
                <input type="text" name="to_city" id="to_city" value="{{ old('to_city') }}" placeholder="Enter to city">
                @error('to_city')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="to_country">To Country</label>
                <input type="text" name="to_country" id="to_country" value="{{ old('to_country') }}"
                       placeholder="Enter to country">
                @error('to_country')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" placeholder="Enter price">
                @error('price')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status">
                    @foreach(Shipment::ALLOWED_STATUS as $status)
                        <option value="{{$status}}">{{$status}}</option>
                    @endforeach
                </select>
                @error('status')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="details">Details</label>
                <textarea name="details" id="details" placeholder="Enter details">{{ old('details') }}</textarea>
                @error('details')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="user_id">User_id</label>
                <input type="text" name="user_id" id="user_id" value="{{ old('user_id') }}" placeholder="Enter user_id">
                @error('user_Id')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="document">Document</label>
                <input type="file" name="documents[]" multiple required>
            </div>

            <button type="submit" class="submit-btn">Create Shipment</button>
        </form>
    </div>
@endsection
