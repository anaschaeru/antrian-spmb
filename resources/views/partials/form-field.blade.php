<div class="form-floating mb-3">
    <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror {{ $class ?? '' }}"
        id="{{ $name }}" placeholder="{{ $label }}" name="{{ $name }}" value="{{ old($name) }}"
        {{ $attributes ?? '' }} required>
    <label for="{{ $name }}">{{ $label }}</label>
    @error($name)
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
</div>
