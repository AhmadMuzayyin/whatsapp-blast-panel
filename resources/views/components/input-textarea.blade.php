@props(['name', 'id', 'label', 'placeholder', 'required', 'value', 'rows' => 3])
<label for="{{ $id ?? '' }}" class="form-label">{{ $label ?? '' }}</label>
<textarea class="form-control @error("{{ $name ?? '' }}") is-invalid @enderror" id="{{ $id ?? '' }}"
    name="{{ $name ?? '' }}" placeholder="{{ $placeholder ?? '' }}" {{ isset($required) ? 'required' : '' }}
    rows="{{ $rows ?? '' }}">{!! $value ?? '' !!}</textarea>
@error("{{ $name ?? '' }}")
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
