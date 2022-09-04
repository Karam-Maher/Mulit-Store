@props([
    'type' => 'text',
    'name',
    'value' => '',
    'label' => false,
])
@if ($label)
    <label>{{ $label }}</label>
@endif
<input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
    {{ $attributes->class(['form-control', 'form-select', 'is-invalid' => $errors->has($name)]) }}>

@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
