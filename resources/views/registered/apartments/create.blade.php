@extends('layouts.registered')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Elementi</h1>
        </div>
        <h2>Inserisci un nuovo appartamento</h2>

        <div class="apartments">
            {{-- @include('partials.error') --}}
            <form action="{{ route('registered.apartments.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo*</label>
                    <input type="text" class="form-control" name="title" id="title"
                        class="form-control @error('title') is-invalid @enderror" aria-describedby="titleHelper"
                        placeholder="Inserisci un titolo descrittivo" value="{{ old('title') }}" maxlength="255" required>
                    <small id="titleHelper" class="form-text text-muted">Scrivi un titolo descrittivo per l'appartamento, max
                        255 caratteri</small>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <input-address-create></input-address-create>
                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('latitude')
                    <div class="alert alert-danger"> Indirizzo non valido </div>
                @enderror

                <div class="mb-3">
                    <label for="image" class="form-label">Immagine*</label>
                    <input type="file" class="form-control" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror" aria-describedby="imageHelper"
                        accept=".jpg, .png, .jpeg, .svg" required>
                    <small id="imageHelper" class="form-text text-muted">Scegli un immagine di max 500 KB</small>
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- --------------------   n.bagni   ok , n.camere  ok , n.letti ,  n.metri   -------------------------- -->
                <div class='d-flex flex-wrap'>
                    <div style='max-width:70px' class="mx-2 mb-3">
                        <label for="n_rooms" class="form-label">Camere*</label>
                        <input type="number" min="0" max="200" class="form-control" name="n_rooms" id="n_rooms"
                            class="form-control @error('n_rooms') is-invalid @enderror" aria-describedby="n_roomsHelper"
                            placeholder="0" value="{{ old('n_rooms') }}" required>
                    </div>
                    <div style='max-width:70px' class="mx-2 mb-3">
                        <label for="n_bathroom" class="form-label">Bagni*</label>
                        <input type="number" min="0" max="200" class="form-control" name="n_bathroom" id="n_bathroom"
                            class="form-control @error('n_bathroom') is-invalid @enderror"
                            aria-describedby="n_bathroomHelper" placeholder="0" value="{{ old('n_bathroom') }}" required>
                    </div>
                    <div style='max-width:70px' class="mx-2 mb-3">
                        <label for="n_bed" class="form-label">Letti*</label>
                        <input type="number" min="0" max="200" class="form-control" name="n_bed" id="n_bed"
                            class="form-control @error('n_bed') is-invalid @enderror" aria-describedby="n_bedHelper"
                            placeholder="0" value="{{ old('n_bed') }}" required>
                    </div>
                    <div style='max-width:70px' class="mx-2 mb-3">
                        <label for="square_meters" class="form-label">Mq*</label>
                        <input type="number" min="0" max="5000" class="form-control" name="square_meters"
                            id="square_meters" class="form-control @error('square_meters') is-invalid @enderror"
                            aria-describedby="square_metersHelper" placeholder="0" value="{{ old('square_meters') }}"
                            required>
                    </div>
                </div>
                @error('n_rooms')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('n_bathroom')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('n_bed')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('square_meters')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- ----------------------------------------------- -->

                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea placeholder="Inserisci la descrizione"
                        class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                        rows="5" maxlength="65535">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <div class="mb-3">
                    <div class="form-check py-2">
                        <p>Seleziona un servizio aggiuntivo:</p>
                        @foreach ($services as $service)
                            <input type="checkbox" class="form-check-input mx-2" name="services[]" id="services"
                                value="{{ $service->id }}">
                            <label class="form-check-label d-block " for="services">

                                {{ $service->name }}
                            </label>
                        @endforeach
                    </div>
                    @error('services')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="mb-3">
                    <label for="services" class="form-label">Servizi*</label>
                    <select class="form-control" name="services[]" id="services" multiple required>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}"> {{ $service->name }}</option>
                        @endforeach
                    </select>
                    <small id="serviceHelper" class="form-text text-muted">Seleziona uno o più servizi aggiuntivi</small>
                </div>
                @error('services')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="toggle-wrapper mt-5 ">
                    <div class="toggle checkcross">
                        <p class="me-3">Pubblico</p>
                        <input id="checkcross" class="@error('visibility') is-invalid @enderror" type="checkbox" value="0"
                            name="visibility" />
                        <label class="toggle-item d-flex align-items-center" for="checkcross">
                            <div class="check"></div>
                        </label>
                        <p class="ms-3">Privato</p>
                    </div>
                </div>
                @error('visibility')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <small class="form-text text-muted py-5 d-block">I campi contrassegnati con * sono obbligatori.</small>


                <div class="text-center pb-5">
                    <button type="submit" class="btn btn-success w-25">Salva</button>
                </div>
            </form>
        </div>
    </div>
@endsection
