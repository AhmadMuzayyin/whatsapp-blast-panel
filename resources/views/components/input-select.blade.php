@props(['label', 'id', 'name', 'placeholder', 'size'])
<label for="{{ $id ?? '' }}" class="form-label">{{ $label ?? '' }}</label>
<select class="form-select form-select-{{ $size ?? '' }}" id="{{ $id ?? '' }}" name="{{ $name ?? '' }}"
    aria-label="{{ $name ?? '' }}">
    {{ $slot }}
</select>
