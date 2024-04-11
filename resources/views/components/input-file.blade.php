@props(['name', 'id', 'label', 'required'])
<label for="{{ $id ?? '' }}">{{ $label ?? '' }}</label>
<input type="file" class="form-control @error("{{ $name ?? '' }}") is-invalid @enderror" id="{{ $id ?? '' }}"
    name="{{ $name ?? '' }}" aria-label="{{ $label ?? '' }}" {{ isset($required) ? 'required="true"' : '' }}>
@error(" {{ $name ?? '' }}")
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
