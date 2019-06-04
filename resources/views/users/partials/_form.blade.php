<div class="k-portlet__body">
    {{ csrf_field() }}

    <h3 class="k-heading k-heading--md k-heading--no-top-margin">1. {{ __('general.information') }}:</h3>
    <div class="form-group row">
        <label for="first_name" class="col-sm-3 col-md-2 col-form-label">{{ __('general.first_name') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                <input type="text" id="first_name" name="first_name"
                       class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" value="{{ old('first_name', $user->first_name) }}" placeholder="Enter the first name">
                <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
            </div>
            <span class="form-text text-muted">Please enter the first name.</span>
        </div>
    </div>

    <div class="form-group row">
        <label for="last_name" class="col-sm-3 col-md-2 col-form-label">{{ __('general.last_name') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                <input type="text" id="last_name" name="last_name"
                       class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" value="{{ old('last_name', $user->last_name) }}" placeholder="Enter the last name">
                <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
            </div>
            <span class="form-text text-muted">Please enter the last name.</span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-md-2 col-form-label">{{ __('general.email_address') }}:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-link"></i></span></div>
                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email', $user->email) }}" placeholder="Enter email">
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            </div>
            <span class="form-text text-muted">This is the primary email address.</span>
        </div>
    </div>

    @include('users.partials._user-role-field')

    <div class="k-separator k-separator--space-sm k-separator--border-dashed"></div>
    <h3 class="k-heading k-heading--md">2. Contacts:</h3>

    @if($errors->has('contact-list.*'))
        <p class="text-danger">{{ $errors->first('contact-list.*') }}</p>
    @endif

    <div class="k-repeater">
        <div class="k-repeater__data-set">
            <div data-repeater-list="contact-list">
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
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('contact-list.0.email', $contacts->first() ? $contacts->first()->email : '') }}" placeholder="Enter email address">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-md-2 col-form-label">Mobile Number:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-mobile-phone"></i></span></div>
                                <input type="text" name="mobile" class="form-control"
                                       value="{{ old('contact-list.0.mobile', $contacts->first() ? $contacts->first()->mobile : '') }}" placeholder="Enter phone number">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-md-2 col-form-label">Landline Number:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                <input type="text" name="landline" class="form-control"
                                       value="{{ old('contact-list.0.landline', $contacts->first() ? $contacts->first()->landline : '') }}" placeholder="Enter landline number">
                            </div>
                        </div>
                    </div>
                    <div class="k-separator k-separator--border-dashed"></div>
                    <div class="k-separator k-separator--height-sm"></div>
                </div>

                @include('users.partials._user-form-populate-contacts')
            </div>
        </div>
        <div class="k-repeater__add-data">
            <span data-repeater-create="" class="btn btn-outline-info btn-sm">
                <i class="la la-plus"></i> Add Alternative Contact
            </span>
        </div>
    </div>

    <div class="k-separator k-separator--space-sm k-separator--border-dashed"></div>
    <h3 class="k-heading k-heading--md">2. Addresses:</h3>

    @if($errors->has('address-list.*'))
        <p class="text-danger">{{ $errors->first('address-list.*') }}</p>
    @endif

    <div class="k-repeater">
        <div class="k-repeater__data-set">
            <div data-repeater-list="address-list">
                <div data-repeater-item class="k-repeater__item">
                    <div class="k-repeater__close k-repeater__close--align-right form-group">
                        <button data-repeater-delete="" class="btn btn-elevate-hover btn-sm  btn-font-danger">
                            <i class="la la-close"></i> Close
                        </button>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-md-2 col-form-label">Address 1:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-home"></i></span></div>
                                <input type="text" name="address1" class="form-control"
                                       value="{{ old('address-list.0.address1', $addresses->first() ? $addresses->first()->address1 : '') }}" placeholder="Enter address 1">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-md-2 col-form-label">Address 2:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                                <input type="text" name="address2" class="form-control"
                                       value="{{ old('address-list.0.address2', $addresses->first() ? $addresses->first()->address2 : '') }}" placeholder="Enter address 2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-md-2 col-form-label">Postcode:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                                <input type="text" name="postcode" class="form-control"
                                       value="{{ old('address-list.0.postcode', $addresses->first() ? $addresses->first()->postcode : '') }}" placeholder="Enter postcode">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-md-2 col-form-label">City:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                                <input type="text" name="city" class="form-control"
                                       value="{{ old('address-list.0.city', $addresses->first() ? $addresses->first()->city : '') }}" placeholder="Enter city">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="country" class="col-sm-3 col-md-2 col-form-label">Country:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-flag"></i></span></div>
                                <select id="country" name="country" class="form-control">
                                    <option value="0" selected>Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('address-list.0.country', $addresses->first() ? $addresses->first()->country_id : '') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="k-separator k-separator--border-dashed"></div>
                    <div class="k-separator k-separator--height-sm"></div>
                </div>

                @include('users.partials._user-form-populate-addresses')
            </div>
        </div>
        <div class="k-repeater__add-data">
            <span data-repeater-create="" class="btn btn-outline-info btn-sm">
                <i class="la la-plus"></i> Add Alternative Address
            </span>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
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
