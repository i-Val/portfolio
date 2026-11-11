@php
    $switchId = ($id ?? $toggleName).'_'.$toggleName;
@endphp
<div class="d-flex justify-content-between align-items-center mb-1">
    <label for="{{ $id }}" class="form-label mb-0">{{ $label }}</label>
    <input type="hidden" name="{{ $toggleName }}" value="0">
    <div class="form-check form-switch mb-0">
        <input
            class="form-check-input"
            type="checkbox"
            role="switch"
            id="{{ $switchId }}"
            name="{{ $toggleName }}"
            value="1"
            style="cursor: pointer;"
            @checked(old($toggleName, $checked ?? true))
        >
        <label class="form-check-label small" for="{{ $switchId }}" style="cursor: pointer;">Show</label>
    </div>
</div>
