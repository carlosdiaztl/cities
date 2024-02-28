@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Busqueda de ciudad</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <select id="country">
                                <option value="">Selecciona un país</option>
                                @if (!empty($countries))
                                    
                                @foreach ($countries as $country)
                                    <option value="{{ $country['iso2'] }}">{{ $country['name'] }}</option>
                                @endforeach
                                @endif
                            </select>
    
                            <select id="state">
                                <option value="">Selecciona un estado</option>
                            </select>
    
                            <select id="city">
                                <option value="">Selecciona una ciudad</option>
                            </select>

                        </div>
                        <div id="info-city">

                        </div>
                        <form class="mt-4"  action="{{ route('city.store') }}" method="post">
                            @method('POST')
                            @csrf
                            <input type="hidden" name="country-name" id="country-name">
                            <input type="hidden" name="population" id="population">
                            <input type="hidden" name="city-name" id="city-name">
                            <button class="btn btn-primary send-button d-none" type="submit">Guardar ciudad</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#country').select2();
            $('#state').select2();
            $('#city').select2();
            $('#country').change(function() {
                var country = $(this).val();
                if (country) {
                    $.get("states/" + country, function(data) {
                        console.log(data);

                        $('#state').empty();
                        if (data.length === 0) {
                            $('#state').append('<option value="">Sin resultados</option>');
                        } else {

                            $('#state').append('<option value="">Selecciona un estado</option>');
                            
                            $.each(data, function(key, value) {
    
                                $('#state').append('<option value="' + value.iso2 + '">' + value
                                    .name +
                                    '</option>');
                            });
                        }
                        
                    });
                    $('#state').select2();
                }
            });

            $('#state').change(function() {
                var state = $(this).val();
                var country = $('#country').val();
                if (state) {
                    $.get("cities/" + country + "/" + state, function(data) {
                        console.log(data);
                        $('#city').empty();
                        if (data.length === 0) {
                            $('#city').append('<option value="">Sin resultados</option>');
                        } else {
                            $('#city').append('<option value="">Selecciona una ciudad</option>');
                            $.each(data, function(key, value) {
                                $('#city').append('<option value="' + value.name + '">' + value
                                    .name + '</option>');
                            });
                        }
                    });
                $('#city').select2();

                }
            });
            $('#city').change(function() {

                var city = $(this).val();
                if (city) {
                    $.get("city/" + city, function(data) {
                        console.log(data);
                        if (data.length === 0) {
                            $('#info-city').empty();
                            $('#info-city').append('Ciudad no encontrada...');
                        }else{
                            $('#info-city').empty();
                            $('.send-button').removeClass('d-none')
                            $('#country-name').val(data[0].country);
                            $('#population').val(data[0].population);
                            $('#city-name').val(data[0].name);
                        }
                    });
                }
            });
        });
        
    </script>
@endsection
