<div class="input-group mb-3">
    <input 

        id="{{$name}}"
        type="{{$type}}"
        name="{{$name}}"
        class="form-control {{ $errors->has($name) ? 'invalid' : '' }}" 
        placeholder="{{$placeholder}}"
        value="{{ old($name, $value !== '' ? $value : '') }}" 
        {{ $required ? 'required' : '' }} 
      {{ $autofocus ? 'autofocus' : '' }}>
     >
    <div class="input-group-append">
    <div class="input-group-text">
        <span class="fas fa-{{$icon}}"></span>
    </div>
    </div>
</div>



