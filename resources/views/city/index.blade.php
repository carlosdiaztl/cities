@extends('layouts.app')

@section('content')
    <div class="container">
        @if (!count($cities))
            <h4>No tiene ciudades guardadas</h4>
            <p>
                Busque una ciudad y guardela ...
            </p>
        @else
            <h4>Listado de ciudades</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-secondary">
                        <tr>
                            <th>Nombre</th>
                            <th>Poblacion</th>
                            <th>Codigo Ciudad</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Capital</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($cities as $city)
                            <tr>
                                <td>
                                    {{ $city['city-name'] }}
                                </td>
                                <td>
                                    {{ $city->population }}

                                </td>
                                <td>
                                    {{ $city['country-name'] }}

                                </td>
                                <td>
                                    {{ $city->latitude ?? 'No registra' }}

                                </td>
                                <td>
                                    {{ $city->longitude ?? 'No registra' }}

                                </td>
                                <td>
                                    {{ $city->capital ?? 'No registra' }}

                                </td>
                                <td>
                                    <div class="d-flex mx-2">
                                        <form method="POST" action="{{ route('city.destroy', $city) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn  p-0 shadow-none "><img width="28rem"
                                                    src="https://i.fbcd.co/products/resized/resized-750-500/de18ae7d25cea00a569f391100ae56d990105791a99a2d42f35d84477a869d68.jpg"
                                                    alt="">
                                            </button>
                                        </form>
                                    </div>



                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>


            </div>
        @endif
    </div>
@endsection
