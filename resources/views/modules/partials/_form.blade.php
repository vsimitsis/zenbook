<div class="k-portlet__body">
    @csrf

    <div class="form-group row">
        <label for="name" class="col-sm-3 col-md-2 col-form-label">{{ __('general.name') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-file"></i></span></div>
                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $module->name) }}" placeholder="{{ __('rules.name') }}">
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="module_type" class="col-sm-3 col-md-2 col-form-label">{{ __('models.module_type') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-key"></i></span></div>
                <select id="module_type" name="module_type" class="form-control {{ $errors->has('module_type') ? 'is-invalid' : '' }}">
                    @foreach($moduleTypes as $moduleType)
                        <option value="{{ $moduleType->type }}" {{ old('module_type', $module->examinable_type) == $moduleType->type ? 'selected' : '' }}>
                            {{ __('models.' . $moduleType->name) }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('module_type') }}</div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="grade" class="col-sm-3 col-md-2 col-form-label">{{ __('general.module_grade') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-file"></i></span></div>
                <input type="number" id="grade" name="grade" min="-100" max="100"
                       class="form-control {{ $errors->has('grade') ? 'is-invalid' : '' }}" value="{{ old('grade', $module->grade) }}" placeholder="{{ __('rules.grade') }}">
                <div class="invalid-feedback">{{ $errors->first('grade') }}</div>
            </div>
            <span class="form-text text-muted">{{ __('messages.grade') }}</span>
        </div>
    </div>

    <div class="form-group row">
        <label for="hidden" class="col-sm-3 col-md-2 col-form-label">{{ __('general.visibility') }}:</label>
        <div class="col-sm-6">
            <div class="kt-radio-inline">
                <label class="kt-radio mr-2">
                    <input type="radio" name="visibility" value="1"
                           class="mr-1" {{ old('visibility') == null || old('visibility', $module->visibility) == '1' ? 'checked' : '' }}> {{ __('general.visible') }}
                    <span></span>
                </label>
                <label class="kt-radio">
                    <input type="radio" name="visibility" value="0"
                           class="mr-1" {{ old('visibility', $module->visibility) == '0' ? 'checked' : '' }}> {{ __('general.hidden') }}
                    <span></span>
                </label>

                @if($errors->has('visibility'))
                    <div class="text-danger">{{ $errors->first('visibility') }}</div>
                @endif
            </div>
            <span class="form-text text-muted">{{ __('messages.module_visibility') }}</span>
        </div>
    </div>

    <div class="k-separator k-separator--space-sm k-separator--border-dashed"></div>

    @include('modules.partials._question_answer_fields')
    @include('modules.partials._multiple_choice_fields')
</div>


@push('scripts')
    <script>
        $(document).ready(function () {
            let moduleTypeSelect     = $('#module_type');
            let moduleFields         = $('.module-fields');
            let questionAnswerFields = $('#question_answer_fields');
            let multipleChoiceFields = $('#multiple_choice_fields');

            function toggleModuleFields() {
                let moduleType = moduleTypeSelect.val();

                switch (moduleType) {
                    case 'App\\QuestionAnswer':
                        moduleFields.addClass('d-none');
                        questionAnswerFields.removeClass('d-none');
                        break;
                    case 'App\\MultipleChoice':
                        moduleFields.addClass('d-none');
                        multipleChoiceFields.removeClass('d-none');
                        break;
                }
            }

            toggleModuleFields();

            moduleTypeSelect.on('change', function() {
                toggleModuleFields();
            });

            $('.k-repeater').each(function(){
                $(this).repeater({
                    show: function () {
                        $(this).slideDown();
                    }
                });
            });
        });
    </script>
@endpush