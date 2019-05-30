<div class="k-portlet__body">
    @csrf

    <div class="form-group row">
        <label for="name" class="col-sm-3 col-md-2 col-form-label">{{ __('general.name') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-file"></i></span></div>
                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $exam->name) }}" placeholder="{{ __('rules.name') }}">
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            </div>
            <span class="form-text text-muted">{{ __('messages.exam_name') }}</span>
        </div>
    </div>

    <div class="form-group row">
        <label for="status" class="col-sm-3 col-md-2 col-form-label">{{ __('general.visibility') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-key"></i></span></div>
                <select id="status" name="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <option value="1" {{ old('status', $exam->status) == null || old('access', $exam->status) == 1 ? 'selected' : '' }}>{{ __('general.open') }}</option>
                    <option value="2" {{ old('status', $exam->status) == '2' ? 'selected' : '' }}>{{ __('general.closed') }}</option>
                </select>
                <div class="invalid-feedback">{{ $errors->first('status') }}</div>
            </div>
            <span class="form-text text-muted">{{ __('messages.exam_status') }}</span>
        </div>
    </div>
</div>