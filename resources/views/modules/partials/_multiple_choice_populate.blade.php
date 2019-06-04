@if(old('choices'))
    @foreach(array_slice(old('choices'), 0, null, true) as $key => $value)
        <div data-repeater-item class="k-repeater__item">
            <div class="k-repeater__close k-repeater__close--align-right form-group">
                <button data-repeater-delete="" class="btn btn-elevate-hover btn-sm  btn-font-danger">
                    <i class="la la-close"></i> Close
                </button>
            </div>

            <div class="form-group row">
                <label for="choice" class="col-sm-3 col-md-2 col-form-label">{{ __('models.choice') }}:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-link"></i></span></div>
                        <input type="text" id="choice" name="choices[{{ $key }}][choice]" class="form-control"
                               value="{{ $value['choice'] }}" placeholder="{{ __('rules.choice') }}">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="grade" class="col-sm-3 col-md-2 col-form-label">{{ __('general.choice_grade') }}:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-file"></i></span></div>
                        <input type="number" id="grade" name="choices[{{ $key }}][grade]" min="-100" max="100"
                               class="form-control" value="{{ $value['grade'] }}" placeholder="{{ __('rules.grade') }}">
                    </div>
                    <span class="form-text text-muted">{{ __('messages.grade') }}</span>
                </div>
            </div>

            <div class="k-separator k-separator--border-dashed"></div>
            <div class="k-separator k-separator--height-sm"></div>
        </div>
    @endforeach
@else
    @if($choices->isNotEmpty())
        @foreach($choices->slice(0) as $key => $value)
            <div data-repeater-item class="k-repeater__item">
                <div class="k-repeater__close k-repeater__close--align-right form-group">
                    <button data-repeater-delete="" class="btn btn-elevate-hover btn-sm  btn-font-danger">
                        <i class="la la-close"></i> Close
                    </button>
                </div>

                <div class="form-group row">
                    <label for="choice" class="col-sm-3 col-md-2 col-form-label">{{ __('models.choice') }}:</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-link"></i></span></div>
                            <input type="text" id="choice" name="choices[{{ $key }}][choice]" class="form-control"
                                   value="{{ $value->choice }}" placeholder="{{ __('rules.choice') }}">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="grade" class="col-sm-3 col-md-2 col-form-label">{{ __('general.choice_grade') }}:</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-file"></i></span></div>
                            <input type="number" id="grade" name="choices[{{ $key }}][grade]" min="-100" max="100"
                                   class="form-control" value="{{ $value->grade }}" placeholder="{{ __('rules.grade') }}">
                        </div>
                        <span class="form-text text-muted">{{ __('messages.grade') }}</span>
                    </div>
                </div>
                <div class="k-separator k-separator--border-dashed"></div>
                <div class="k-separator k-separator--height-sm"></div>
            </div>
        @endforeach
    @endif
@endif