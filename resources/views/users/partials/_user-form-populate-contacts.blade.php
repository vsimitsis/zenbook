@if(old('contact-list'))
    @foreach(array_slice(old('contact-list'), 1, null, true) as $key => $value)
        <div data-repeater-item class="k-repeater__item">
            <div class="k-repeater__close k-repeater__close--align-right form-group">
                <button data-repeater-delete="" class="btn btn-elevate-hover btn-sm  btn-font-danger">
                    <i class="la la-close"></i> Close
                </button>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Email Address:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-link"></i></span></div>
                        <input type="email" name="contact-list[{{$key}}][email]" class="form-control" value="{{ $value['email'] }}" placeholder="Enter email address">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Mobile Number:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-mobile-phone"></i></span></div>
                        <input type="text" name="contact-list[{{ $key }}][mobile]" class="form-control" value="{{ $value['mobile'] }}" placeholder="Enter phone number">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Landline Number:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                        <input type="text" name="contact-list[{{ $key }}][landline]" class="form-control" value="{{ $value['landline'] }}" placeholder="Enter landline number">
                    </div>
                </div>
            </div>
            <div class="k-separator k-separator--border-dashed"></div>
            <div class="k-separator k-separator--height-sm"></div>
        </div>
    @endforeach
@else
    @foreach($contacts->slice(1) as $key => $value)
        <div data-repeater-item class="k-repeater__item">
            <div class="k-repeater__close k-repeater__close--align-right form-group">
                <button data-repeater-delete="" class="btn btn-elevate-hover btn-sm  btn-font-danger">
                    <i class="la la-close"></i> Close
                </button>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Email Address:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-link"></i></span></div>
                        <input type="email" name="contact-list[{{ $key }}][email]" class="form-control" value="{{ $value->email }}" placeholder="Enter email address">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Mobile Number:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-mobile-phone"></i></span></div>
                        <input type="text" name="contact-list[{{ $key }}][mobile]" class="form-control" value="{{ $value->mobile }}" placeholder="Enter phone number">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Landline Number:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                        <input type="text" name="contact-list[{{ $key }}][landline]" class="form-control" value="{{ $value->landline }}" placeholder="Enter landline number">
                    </div>
                </div>
            </div>
            <div class="k-separator k-separator--border-dashed"></div>
            <div class="k-separator k-separator--height-sm"></div>
        </div>
    @endforeach
@endif