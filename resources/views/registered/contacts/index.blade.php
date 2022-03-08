@extends('layouts.registered')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Messaggi</h1>
        </div>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="table-responsive-lg">
            <table class="table table-striped table-dark table-hover table-borderless table-sm">
                <thead>
                    <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Data</th>
                        <th scope="col">Oggetto</th>
                        <th scope="col">Messaggio</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($display as $contact)
                        <tr>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->created_at }}</td>
                            <td>{{ $contact->oggetto_mail }}</td>
                            <td>{{ $contact->message }}</td>
                            <td class='d-flex'>
                                <a href="{{ route('registered.contacts.show', $contact->id) }}"><i
                                        class="fa-solid me-3 fa-glasses"></i></a>


                                <!---------------- Delete button ---------------->
                                <button style='background: none;
                                                        color: inherit;
                                                        border: none;
                                                        padding: 0;
                                                        font: inherit;
                                                        cursor: pointer;
                                                        outline: inherit;' type="button" style='border-box:none;'
                                    class="bg-none" data-bs-toggle="modal"
                                    data-bs-target="#delete{{ $contact->id }}">
                                    <i class="text-danger ms-3 fa-solid fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="delete{{ $contact->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modal_{{ $contact->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark">Eliminare definitivamente il messaggio
                                                    numero
                                                    <strong>{{ $contact->id }}</strong>?
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-dark">
                                                Stai per eliminare definitivamente il messaggio! Sei sicuro di voler
                                                continuare?

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Annulla</button>
                                                <form action="{{ route('registered.contacts.destroy', $contact->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    <!-------------------------------------->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
