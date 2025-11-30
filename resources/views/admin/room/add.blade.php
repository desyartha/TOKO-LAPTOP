@extends('layouts.adminlte')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">ROOM ADD</h3>
        <div class="card-tools">
            {{-- Tambahan tools kalau diperlukan --}}
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('room.store') }}" method="post">
            @csrf
            <div class="row">
                <!-- Room Type -->
                <div class="form-group col-md-6">
                    <label for="type_id">Type</label>
                    <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror" required>
                        <option disabled selected>Select Type of Room...</option>
                        @foreach ($typeRooms as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('type_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Room Number -->
                <div class="form-group col-md-6">
                    <label for="number">Number</label>
                    <input id="number" name="number" type="text" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') }}" required>
                    @error('number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- Room Status -->
                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option disabled selected>Select Status...</option>
                        <option value="v">Available</option>
                        <option value="o">Occupied</option>
                        <option value="r">Reserved</option>
                        <option value="os">Out of Service</option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-group float-right row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Post') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
