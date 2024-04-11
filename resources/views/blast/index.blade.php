@extends('layouts.app')
@section('content')
    @php
        $selected_device = session('device') ?? null;
    @endphp
    <x-breadcumb page="Create Blast" />
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h6 class="mb-0">Create Blast</h6>
                <div class="fs-5 ms-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-blast">Add Blast</button>
                </div>
            </div>
            <x-modal-form id="add-blast" title="Add Blast" :route="route('blast.store')">
                <div class="row mb-3">
                    <div class="col">
                        <x-input-basic label="Device Number" id="number" name="number" readonly
                            value="{{ $selected_device->number }}" />
                    </div>
                    <div class="col">
                        <x-input-basic label="Name" id="name" name="name" placeholder="Enter Name" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <x-input-basic label="Delay" id="delay" name="delay" placeholder="Enter Your Delay" required
                            :value="10" />
                    </div>
                    <div class="col">
                        {{-- <x-input-select label="Type" id="type" name="type" placeholder="Enter Your Type">
                            <option value="immidiatly" selected>Immidiatly</option>
                            <option value="scheduled" disabled>Scheduled</option>
                        </x-input-select> --}}
                        <x-input-select label="Select Phonebook" id="phonebook_id" name="phonebook_id">
                            <option value="" selected disabled>Select Phonebook</option>
                            @foreach ($phonebooks as $phonebook)
                                <option value="{{ $phonebook->id }}">{{ $phonebook->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>
                </div>
                <x-input-textarea label="Message" id="message" name="message" placeholder="Enter Your Message"
                    rows="10" />
            </x-modal-form>
            <div class="table-responsive mt-2">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Number</th>
                            <th>Name</th>
                            <th>Message</th>
                            <th>Delay</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blasts as $blast)
                            <tr>
                                <td>{{ $selected_device->number }}</td>
                                <td>{{ $blast->name }}</td>
                                <td>
                                    <button class="text-info border-0" style="background: transparent"data-bs-toggle="modal"
                                        data-bs-target="#view_msg"><ion-icon name="eye-sharp"></ion-icon></button>
                                    <x-modal id="view_msg" title="View Message">
                                        {{ $blast->message }}
                                    </x-modal>
                                </td>
                                <td>{{ $blast->delay }}</td>
                                <td>
                                    <span class="fw-bold">{{ ucfirst($blast->type) }}</span>
                                </td>
                                <td>
                                    <x-table-button :view="false" :edit="false" :delete="true" :params="$blast"
                                        route="{{ route('blast.destroy', $blast->id) }}" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#next').on('click', function() {
            var step = "{{ isset(request()->step) ? request()->step : 1 }}";
            if (step < 3) {
                if (step == 1) {
                    var name = $('#name').val();
                    var number = $('#number').val();
                    var _token = $('input[name="_token"]').val();
                    if (name == '') {
                        alert('Name is required');
                    } else {
                        var id = localStorage.getItem('id');
                        if (id == null || id == undefined) {
                            save({
                                _token: _token,
                                name: name,
                                step: step
                            });
                        }
                        step++;
                        window.location.href = `?step=${step}`;
                    }
                }
                if (step == 2) {
                    var phonebook = $('#phonebook').val();
                    var message = $('#message').val();
                    var _token = $('input[name="_token"]').val();
                    if (phonebook == '') {
                        alert('Phonebook is required');
                    } else if (message == '') {
                        alert('Message is required');
                    } else {
                        var id = localStorage.getItem('id');
                        save({
                            _token: _token,
                            id: id,
                            phonebook_id: phonebook,
                            message: message,
                            step: step
                        });
                        step + 1;
                        window.location.href = `?step=${step}`;
                    }
                }
                if (step == 3) {
                    var delay = $('#delay').val();
                    var type = $('#type').val();
                    var _token = $('input[name="_token"]').val();
                    if (delay == '') {
                        alert('Delay is required');
                    } else if (type == '') {
                        alert('Type is required');
                    } else {
                        var id = localStorage.getItem('id');
                        save({
                            _token: _token,
                            id: id,
                            delay: delay,
                            type: type,
                            step: step
                        });
                    }
                }
            }
        });
        $('#previous').on('click', function() {
            var step = "{{ request()->step }}";
            if (step <= 3) {
                step--;
                window.location.href = `?step=${step}`;
            }
        });

        function save(params) {
            $.ajax({
                url: "{{ route('blast.store') }}",
                type: 'post',
                data: params,
                success: function(data) {
                    localStorage.setItem('id', data.id);
                }

            })
        }
        var id = localStorage.getItem('id');
        if (id) {
            $.ajax({
                url: "{{ route('blast.index') }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    var step = "{{ isset(request()->step) ? request()->step : 1 }}";
                    if (step == 1) {
                        $('#name').val(data.name);
                    }
                    if (step == 2) {
                        $('#phonebook').val(data.phonebook_id);
                        $('#message').val(data.message);
                    }
                    if (step == 3) {
                        $('#delay').val(data.delay);
                        $('#type').val(data.type);
                    }
                }
            });
        }
    </script>
@endpush
