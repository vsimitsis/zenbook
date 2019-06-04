<div class="k-portlet__body">
    @csrf

    <div class="form-group row">
        <label for="name" class="col-sm-3 col-md-2 col-form-label">{{ __('general.name') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-file"></i></span></div>
                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $section->name) }}" placeholder="{{ __('rules.name') }}">
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="description" class="col-sm-3 col-md-2 col-form-label">{{ __('general.description') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-file"></i></span></div>
                <textarea type="text" id="description" name="description"
                          class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="{{ __('rules.description') }}">{{ old('description', $section->description) }}</textarea>
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="hidden" class="col-sm-3 col-md-2 col-form-label">{{ __('general.visibility') }}:</label>
        <div class="col-sm-6">
            <div class="kt-radio-inline">
                <label class="kt-radio mr-2">
                    <input type="radio" name="visibility" value="1"
                           class="mr-1" {{ old('visibility') == null || old('hidden', $section->visibility) == '1' ? 'checked' : '' }}> {{ __('general.visible') }}
                    <span></span>
                </label>
                <label class="kt-radio">
                    <input type="radio" name="visibility" value="0"
                           class="mr-1" {{ old('visibility', $section->visibility) == '0' ? 'checked' : '' }}> {{ __('general.hidden') }}
                    <span></span>
                </label>

                @if($errors->has('visibility'))
                    <div class="text-danger">{{ $errors->first('visibility') }}</div>
                @endif
            </div>
            <span class="form-text text-muted">{{ __('messages.exam_section_visibility') }}</span>
        </div>
    </div>
</div>
