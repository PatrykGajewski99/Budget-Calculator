@extends('layouts.app')

@section('content')
    <br><br><br><br><br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All users expenses') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row justify-content-center">

                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="service-item mb-5">
                                    <i class="fa fa-cutlery fa-5x" aria-hidden="true"></i>
                                    <p></p>
                                    <p>Food:  </p>
                                    <p><strong>{{$finalFoodPrice}} zł</strong></p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="service-item mb-5">
                                    <i class="fa fa-address-card-o fa-5x" aria-hidden="true"></i>
                                    <p></p>
                                    <p>Bills: </p>
                                    <p><strong>{{$finalBillsPrice}} zł</strong></p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="service-item mb-5">
                                    <i class="fa fa-glass fa-5x" aria-hidden="true"></i>
                                    <p></p>
                                    <p>Parties </p>
                                    <p><strong>{{$finalPartiesPrice}} zł</strong></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://use.fontawesome.com/a11d10b9af.js"></script>
    </div>
    @component('layouts.footer')
    @endcomponent
@endsection

