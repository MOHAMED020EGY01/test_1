<div class="form-group col-md- mt-1">
    <label for="{{$name}}">{{$name}}</label>
    <input type="{{$type ?? $type = 'text'}}"
    value="{{$value ?? ''}}"
    class="form-control @error('{{$name}}') is-invalid  @enderror"
    id="{{$name}}"
    name="{{$name}}"
    placeholder="@error('{{$name}}'){{$message}}@else{{$name}}@enderror">
</div>