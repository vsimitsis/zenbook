<div class="k-portlet__body">
    @csrf

    <div class="form-group row">
        <label for="name" class="col-sm-3 col-md-2 col-form-label">{{ __('general.name') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-file"></i></span></div>
                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $document->name) }}" placeholder="{{ __('rules.name') }}">
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            </div>
            <span class="form-text text-muted">{{ __('rules.file_name_optional') }}</span>
        </div>
    </div>

    <div class="form-group row">
        <label for="access" class="col-sm-3 col-md-2 col-form-label">{{ __('general.access') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-key"></i></span></div>
                <select id="access" name="access" class="form-control {{ $errors->has('access_rights') ? 'is-invalid' : '' }}">
                    <option value="3" {{ old('access') == null || old('access') == 3 ? 'selected' : '' }}>{{ __('general.private') }}</option>
                    <option value="1" {{ old('access') == '1' ? 'selected' : '' }}>{{ __('general.public') }}</option>
                    <option value="2" {{ old('access') == '2' ? 'selected' : '' }}>{{ __('general.shared') }}</option>
                </select>
                <div class="invalid-feedback">{{ $errors->first('access') }}</div>
            </div>
            <span class="form-text text-muted">{{ __('rules.file_access_rights') }}</span>
        </div>
    </div>

    <div id="user_access_field" class="form-group row {{ old('access') == '2' ? '' : 'd-none' }}">
        <label class="col-sm-3 col-md-2 col-form-label">{{ __('general.access_rights') }}:</label>
        <div class="col-sm-6">
            <div class="kt-checkbox-inline">
                @foreach($currentCompany->users as $user)
                    <label class="kt-checkbox mr-1">
                        <input type="checkbox" name="user_access[]" value="{{ $user->id }}"
                               class="mr-1" {{ old('user_access') && in_array($user->id, old('user_access')) ? 'checked' : '' }}>{{ $user->fullName() }}
                        <span></span>
                    </label>
                @endforeach
            </div>
            <span class="form-text text-muted">{{ __('actions.select_user_access') }}</span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-md-2 col-form-label">{{ __('models.documents') }}:</label>
        <div class="col-sm-6">
            <div class="custom-file">
                <input type="file" name="document" class="custom-file-input">
                <label class="custom-file-label" for="file">{{ __('actions.choose_file') }}</label>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('#access').on('change', function () {
            if ($(this).val() === '2') {
                $('#user_access_field').removeClass('d-none');
            } else {
                $('#user_access_field').addClass('d-none');
            }
        });
    </script>
@endpush
