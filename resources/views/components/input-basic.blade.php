@props(['type', 'label', 'id', 'name', 'placeholder', 'required', 'value', 'disabled', 'readonly', 'size'])

<label for="{{ $id ?? '' }}" class="form-label">{{ $label ?? '' }}</label>
<input type="{{ $type ?? 'text' }}"
    class="form-control form-control-{{ $size ?? '' }} @error('{{ $name }}') is-invalid @enderror"
    id="{{ $id ?? '' }}" name="{{ $name ?? '' }}" {{ isset($required) ? 'required' : '' }}
    {{ isset($readonly) ? 'readonly' : '' }} {{ $disabled ?? '' }} placeholder="{{ $placeholder ?? '' }}"
    value="{{ $value ?? '' }}" autocomplete="off">
@error("{{ $name }}")
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
