<div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><ion-icon name="home-sharp"></ion-icon>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('phonebook.index') }}">
                <div class="parent-icon"><ion-icon name="call-sharp"></ion-icon>
                </div>
                <div class="menu-title">Phone Book</div>
            </a>
        </li>
        @php
            $selected_device = session('device') ?? null;
        @endphp
        <li>
            <x-input-select id="device_selected" name="device">
                <option value="" selected disabled>Select Device</option>
                @foreach ($devices as $device)
                    @php
                        $status = $device->status == 1 ? 'Connected' : 'Disconnected';
                    @endphp
                    <option value="{{ $device->id }}"
                        {{ $selected_device != null ? ($selected_device->id == $device->id ? 'selected' : '') : '' }}>
                        {{ $device->number . "($status)" }}
                    </option>
                @endforeach
            </x-input-select>
        </li>
        @if ($selected_device != null)
            <li>
                <a href="javascript:;">
                    <div class="parent-icon"><ion-icon name="chatbox-ellipses-sharp"></ion-icon>
                    </div>
                    <div class="menu-title">Auto Replay</div>
                </a>
            </li>
            <li>
                <a href="{{ route('blast.index') }}">
                    <div class="parent-icon"><ion-icon name="logo-whatsapp"></ion-icon>
                    </div>
                    <div class="menu-title">Blast</div>
                </a>
            </li>
        @endif
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="albums-sharp"></ion-icon>
                </div>
                <div class="menu-title">Admin</div>
            </a>
            <ul>
                <li>
                    <a href="javascript:;">
                        <ion-icon name="ellipse-outline"></ion-icon>Setting Server
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <ion-icon name="ellipse-outline"></ion-icon>Users
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('#device_selected').on('change', function() {
                let device_id = $(this).val();
                $.ajax({
                    url: "{{ route('device.change') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        device: device_id
                    },
                    success: function(data) {
                        swal.fire({
                            text: `${data.message}`,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
