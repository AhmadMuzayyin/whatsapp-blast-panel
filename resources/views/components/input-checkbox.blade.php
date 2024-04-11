@props(['id', 'name', 'label'])
<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="{{ $id ?? '' }}" name="{{ $name ?? '' }}">
    <label class="form-check-label" for="{{ $id ?? '' }}">{{ $label ?? '' }}</label>
</div>
