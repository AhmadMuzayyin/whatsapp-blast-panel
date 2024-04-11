@php
    $selected_device = session('device') ?? null;
@endphp
<div class="mt-5">
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <x-input-basic type="number" label="Delay" id="delay" name="delay" placeholder="Enter Your Delay"
                :value="10" />
            <x-input-select label="Type" id="type" name="type" placeholder="Enter Your Type">
                <option value="immidiatly" selected>Immidiatly</option>
                <option value="scheduled" disabled>Scheduled</option>
            </x-input-select>
        </div>
        <div class="col"></div>
    </div>
</div>
