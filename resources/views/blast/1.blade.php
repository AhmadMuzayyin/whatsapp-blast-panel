@php
    $selected_device = session('device') ?? null;
@endphp
<div class="mt-5">
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <x-input-basic label="Device Number" id="number" name="number" readonly
                value="{{ $selected_device->number }}" />
            <x-input-basic label="Name" id="name" name="Name" placeholder="Enter Name" required />
        </div>
        <div class="col"></div>
    </div>
</div>
