@props(['name', 'options', 'checked' => false])
@foreach ($options as $value => $text)
    <div class="form-check">
        <input type="radio" name="{{ $name }}" id="exampleRadios1" value="{{ $value }}"
            @checked(old($name, $checked) == $value)
            {{ $attributes->class(['form-check-input', 'form-select', 'is-invalid' => $errors->has($name)]) }}>
        
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <label class="form-check-label" for="exampleRadios1">
            {{ $text }}
        </label>
    </div>
@endforeach
