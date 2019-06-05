<div id="question_answer_fields" class="module-fields">
    <div class="form-group row">
        <label for="qa_question" class="col-sm-3 col-md-2 col-form-label">{{ __('models.question') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-file"></i></span></div>
                <textarea type="text" id="qa_question" name="qa_question"
                          class="form-control {{ $errors->has('qa_question') ? 'is-invalid' : '' }}" placeholder="{{ __('rules.question') }}">{{ old('qa_question', $module->examinable->question) }}</textarea>
                <div class="invalid-feedback">{{ $errors->first('qa_question') }}</div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="max_answer_length" class="col-sm-3 col-md-2 col-form-label">{{ __('general.max_answer_length') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-file"></i></span></div>
                <input type="number" id="max_answer_length" name="max_answer_length" min="0"
                       class="form-control {{ $errors->has('max_answer_length') ? 'is-invalid' : '' }}"
                       value="{{ old('max_answer_length', $module->examinable->max_answer_length) }}" placeholder="{{ __('rules.max_answer_length') }}">
                <div class="invalid-feedback">{{ $errors->first('max_answer_length') }}</div>
            </div>
            <span class="form-text text-muted">{{ __('messages.max_answer_length') }}</span>
        </div>
    </div>
</div>