@extends('layouts.app')
@section('content')
    <x-breadcumb page="Phonebook" />
    <div class="card radius-10">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="d-grid text-center">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
                            Phonebook
                        </button>
                        <x-input-basic name="search" id="search" placeholder="Search Phonebook" />
                    </div>
                    <x-modal-form route="{{ route('phonebook.store') }}" title="Add Phonebook">
                        <div class="row">
                            <div class="col-12">
                                <x-input-basic name="name" id="name" label="Name" />
                            </div>
                        </div>
                    </x-modal-form>
                    <div class="table-responsive my-2">
                        <table class="table">
                            <tbody class="table">
                                @foreach ($phonebook as $item)
                                    <tr id="tr-{{ $item->id }}">
                                        <td>
                                            <button class="alert alert-success" onclick="getContact('{{ $item->id }}')">
                                                {{ $item->name }}
                                            </button>
                                            @csrf
                                        </td>
                                        <td>
                                            <div style="margin-top: -10px">
                                                <x-table-button :view="false" :edit="false" :delete="true"
                                                    :params="$item" :route="route('phonebook.destroy', $item->id)" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="flex-grow-1 mx-xl-2 my-2 my-xl-0">
                        <div class="input-group">
                            <button class="btn btn-danger btn-sm mx-2" onclick="deleteAllContact()">
                                Delete All
                            </button>
                            <x-input-basic name="search_contact" id="search_contact" placeholder="Search Contact"
                                size="sm" />
                            <button class="btn btn-primary btn-sm mx-2" onclick="addContact()">
                                Add
                            </button>
                            <x-modal id="addContact" title="Add Contact">
                                <form action="{{ route('contact.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <x-input-basic name="name" id="name" label="Name" />
                                            </div>
                                            <div class="col-12">
                                                <x-input-basic name="number" id="number" label="Number" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </x-modal>
                            <button class="btn btn-success btn-sm mx-2" onclick="importContact()">
                                Import
                            </button>
                            <x-modal id="importContact" title="Import Contact">
                                <form action="{{ route('contact.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <x-input-file name="file" id="file" label="File (xlsx)" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </x-modal>
                            <button class="btn btn-warning btn-sm mx-2" onclick="exportContact()">
                                Export
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive mt-2">
                                <table class="table align-middle mb-0">
                                    <thead class="table">
                                        <tr>
                                            <th>Name</th>
                                            <th>Number</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let phonebook_id = null;

        function getContact(id) {
            var _token = $('input[name="_token"]').val();
            phonebook_id = id;
            $.ajax({
                url: "{{ url('/contact') }}" + `/${id}/show`,
                type: "POST",
                data: {
                    _token: _token,
                    id: id
                },
                success: function(response) {
                    let result = response.contacts;
                    var tbody = document.getElementById("tbody");
                    while (tbody.firstChild) {
                        tbody.removeChild(tbody.firstChild);
                    }
                    result.forEach(data => {
                        var tr = `<tr>
                                <td>${data.name}</td>
                                <td>${data.number}</td>
                                <td>
                                    <button type="button"  style="background: transparent; border: 0;"
                                        class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                        data-bs-original-title="Delete" aria-label="Delete" onclick="deleteContact(${data.id})">
                                        <ion-icon name="trash-sharp"></ion-icon>
                                    </button>
                                </td>
                            </tr>`;
                        tbody.innerHTML += tr;
                    });
                    let tr = document.getElementById(`tr-${id}`);
                    let trList = document.getElementsByClassName("bg-light");
                    for (let i = 0; i < trList.length; i++) {
                        trList[i].classList.remove("bg-light");
                    }
                    if (tr) {
                        tr.classList.add("bg-light");
                    }
                }
            });
        }

        function addContact() {
            if (phonebook_id == null) {
                swal.fire("Error", "Please select phonebook", "error");
                return;
            } else {
                $('#addContact').modal('show');
                $('#addContact').on('shown.bs.modal', function() {
                    $(this).find('form').on('submit', function(event) {
                        event.preventDefault();
                        var name = $(this).find('#name').val();
                        var number = $(this).find('#number').val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{ route('contact.store') }}",
                            type: "POST",
                            data: {
                                name: name,
                                number: number,
                                phonebook_id: phonebook_id,
                                _token: _token
                            },
                            success: function(response) {
                                swal.fire("success", `${response.message}`, "success")
                                getContact(phonebook_id);
                                $('#addContact').modal('hide');
                            },
                            error: function() {
                                swal.fire("Error", "An error occurred", "error");
                            }
                        });
                        $(this).off('submit'); // Clear the submit event
                    });
                });
                $('#addContact').on('hidden.bs.modal', function() {
                    $(this).find('form').off('submit'); // Clear the submit event
                    $(this).find('form').trigger('reset'); // Clear the form
                });
            }
        }

        function importContact() {
            if (phonebook_id == null) {
                swal.fire("Error", "Please select phonebook", "error");
                return;
            } else {
                $('#importContact').modal('show');
                $('#importContact').on('shown.bs.modal', function() {
                    $(this).find('form').on('submit', function(event) {
                        event.preventDefault();
                        var fileInput = $(this).find('#file').prop('files')[0];
                        var _token = $('input[name="_token"]').val();
                        var formData = new FormData();
                        formData.append('file', fileInput);
                        formData.append('phonebook_id', phonebook_id);
                        formData.append('_token', _token);
                        $.ajax({
                            url: "{{ url('/contact') }}" + `/${phonebook_id}/import`,
                            type: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            cache: false,
                            success: function(response) {
                                swal.fire("success", `${response.message}`, "success")
                                getContact(phonebook_id);
                                $('#importContact').modal('hide');
                            },
                            error: function() {
                                swal.fire("Error", "An error occurred", "error");
                            },
                        });
                        $(this).off('submit'); // Clear the submit event
                    });
                });
                $('#importContact').on('hidden.bs.modal', function() {
                    $(this).find('form').off('submit'); // Clear the submit event
                    $(this).find('form').trigger('reset'); // Clear the form
                });
            }
        }

        function exportContact() {
            if (phonebook_id == null) {
                swal.fire("Error", "Please select phonebook", "error");
                return;
            } else {
                var download = "{{ url('/contact') }}" + `/${phonebook_id}/export`;
                window.open(download, '_blank');
            }
        }

        function deleteAllContact() {
            if (phonebook_id == null) {
                swal.fire("Error", "Please select phonebook", "error");
                return;
            } else {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/contact') }}" + `/${phonebook_id}/destroy`,
                    type: "DELETE",
                    data: {
                        _token: _token,
                    },
                    success: function(response) {
                        swal.fire("success", `${response.message}`, "success")
                        var tbody = document.getElementById("tbody");
                        tbody.innerHTML = '';
                    }
                });
            }
        }

        function deleteContact(id) {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/contact') }}" + `/${id}/delete`,
                type: "DELETE",
                data: {
                    _token: _token,
                },
                success: function(response) {
                    swal.fire("success", `${response.message}`, "success")
                    getContact(phonebook_id);
                }
            });
        }
    </script>
@endpush
