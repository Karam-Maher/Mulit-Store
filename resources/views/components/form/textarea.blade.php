@props([
    'name',
    'value' => '',
    'label' => false,
])
@if ($label)
    <label>{{ $label }}</label>
@endif

<textarea  name="{{ $name }}"
    {{ $attributes->class([
        'form-control', 'form-select', 'is-invalid' => $errors->has($name)])
    }}>
{{ old($name, $value) }}
</textarea>

@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
