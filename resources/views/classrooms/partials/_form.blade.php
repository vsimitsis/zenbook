<div class="k-portlet__body">
    @csrf

    <div class="form-group row">
        <label for="name" class="col-sm-3 col-md-2 col-form-label">{{ __('general.name') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-file"></i></span></div>
                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $classroom->name) }}" placeholder="{{ __('rules.name') }}">
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            </div>
        </div>
    </div>
</div>