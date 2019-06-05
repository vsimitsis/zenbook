<div id="multiple_choice_fields" class="module-fields d-none">
    <div class="k-separator k-separator--height-sm"></div>

    <div class="form-group row">
        <label for="mc_question" class="col-sm-3 col-md-2 col-form-label">{{ __('models.question') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-file"></i></span></div>
                <textarea type="text" id="mc_question" name="mc_question"
                          class="form-control {{ $errors->has('mc_question') ? 'is-invalid' : '' }}" placeholder="{{ __('rules.question') }}">{{ old('mc_question', $module->examinable->question) }}</textarea>
                <div class="invalid-feedback">{{ $errors->first('mc_question') }}</div>
            </div>
        </div>
    </div>

    <div class="k-separator k-separator--border-dashed"></div>
    <div class="k-separator k-separator--height-sm"></div>

    <div class="k-repeater">
        <div class="k-repeater__data-set">
            <div data-repeater-list="choices">
                <div data-repeater-item class="k-repeater__item">
                    <div class="k-repeater__close k-repeater__close--align-right form-group">
                        <button data-repeater-delete="" class="btn btn-elevate-hover btn-sm  btn-font-danger">
                            <i class="la la-close"></i> {{ __('actions.close') }}
                        </button>
                    </div>

                    <div class="form-group row">
                        <label for="choice" class="col-sm-3 col-md-2 col-form-label">{{ __('models.choice') }}:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-link"></i></span></div>
                                <input type="text" id="choice" name="choice" class="form-control"
                                       value="{{ old('choices.0.choice', $choices->first() ? $choices->first()->body : '') }}" placeholder="{{ __('rules.choice') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="grade" class="col-sm-3 col-md-2 col-form-label">{{ __('general.choice_grade') }}:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-file"></i></span></div>
                                <input type="number" id="grade" name="grade" min="-100" max="100"
                                       class="form-control" value="{{ old('choices.0.grade', $choices->first() ? $choices->first()->grade : '') }}" placeholder="{{ __('rules.grade') }}">
                            </div>
                            <span class="form-text text-muted">{{ __('messages.grade') }}</span>
                        </div>
                    </div>

                    <div class="k-separator k-separator--border-dashed"></div>
                    <div class="k-separator k-separator--height-sm"></div>
                </div>

                @include('modules.partials._multiple_choice_populate')
            </div>
        </div>

        <div class="k-repeater__add-data">
            <span data-repeater-create="" class="btn btn-outline-info btn-sm">
                <i class="la la-plus"></i> {{ __('actions.add_choice') }}
            </span>
        </div>
    </div>
</div>