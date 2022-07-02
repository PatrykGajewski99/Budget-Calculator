@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Adding Expense') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('addExpense') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="expense" class="col-md-4 col-form-label text-md-right">{{ __('Type of expense') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="expense" id="expense" required autofocus>
                                        <option value="foods">Food</option>
                                        <option value="bills">Bill</option>
                                        <option value="party">Party</option>
                                    </select>
                                    @error('expense')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('Place') }}</label>

                                <div class="col-md-6">
                                    <input id="place" type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place') }}" required  >

                                    @error('place')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                                <div class="col-md-6">
                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required  >

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="details" class="col-md-4 col-form-label text-md-right">{{ __('Details') }}</label>

                                <div class="col-md-6">
                                    <textarea rows="6" cols="50" id="details" class="form-control @error('details') is-invalid @enderror" name="details" value="{{ old('details') }}" required></textarea>
                                    @error('details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('ADD') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @component('layouts.footer')
    @endcomponent
@endsection

