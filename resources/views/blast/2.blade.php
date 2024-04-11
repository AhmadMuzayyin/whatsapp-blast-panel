@php
    $selected_device = session('device') ?? null;
@endphp
<div class="mt-5">
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <x-input-select label="Select Phonebook" id="phonebook" name="phonebook">
                <option value="">Select Phonebook</option>
                @foreach ($phonebooks as $phonebook)
                    <option value="{{ $phonebook->id }}">{{ $phonebook->name }}</option>
                @endforeach
            </x-input-select>
            <x-input-textarea label="Message" id="message" name="message" placeholder="Enter Your Message"
                rows="10" />
        </div>
        <div class="col"></div>
    </div>
</div>
