<div class="k-portlet__body">
    <h3 class="k-heading k-heading--md k-heading--no-top-margin">1. Details:</h3>
    <div class="form-group row">
        <label class="col-sm-3 col-md-2 col-form-label">Full Name:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                <input type="text" class="form-control" value="{{ old('name', $user->name) }}" placeholder="Enter full name">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-md-2 col-form-label">Email:</label>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-link"></i></span></div>
                <input type="email" class="form-control" value="{{ old('email', $user->email) }}" placeholder="Enter email">
            </div>
        </div>
    </div>


    <div class="k-separator k-separator--space-sm k-separator--border-dashed"></div>
    <h3 class="k-heading k-heading--md">2. Contact:</h3>
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
                                <input type="email" name="email" class="form-control" placeholder="Enter email address">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-md-2 col-form-label">Mobile Number:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-mobile-phone"></i></span></div>
                                <input type="text" name="mobile" class="form-control" placeholder="Enter phone number">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-md-2 col-form-label">Landline Number:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                <input type="text" name="landline" class="form-control" placeholder="Enter landline number">
                            </div>
                        </div>
                    </div>
                    <div class="k-separator k-separator--border-dashed"></div>
                    <div class="k-separator k-separator--height-sm"></div>

                    @foreach($contacts as $contact)
                        <div class="k-repeater__item">
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
                                        <input type="email" name="email" class="form-control" placeholder="Enter email address">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-md-2 col-form-label">Mobile Number:</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-mobile-phone"></i></span></div>
                                        <input type="text" name="mobile" class="form-control" placeholder="Enter phone number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-md-2 col-form-label">Landline Number:</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                        <input type="text" name="landline" class="form-control" placeholder="Enter landline number">
                                    </div>
                                </div>
                            </div>
                            <div class="k-separator k-separator--border-dashed"></div>
                            <div class="k-separator k-separator--height-sm"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="k-repeater__add-data">
		    <span data-repeater-create="" class="btn btn-info btn-sm">
		    	<i class="la la-plus"></i> Add Alternative Contact
		    </span>
        </div>
    </div>

    <div class="k-separator k-separator--space-sm k-separator--border-dashed"></div>
    <h3 class="k-heading k-heading--md">2. Address:</h3>
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
                        <label class="col-sm-3 col-md-2 col-form-label">Building Name:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-home"></i></span></div>
                                <input type="text" name="building_name" class="form-control" placeholder="Enter building number">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-md-2 col-form-label">Address 1:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                                <input type="text" name="address1" class="form-control" placeholder="Enter address 1">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-md-2 col-form-label">Address 2:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                                <input type="text" name="address2" class="form-control" placeholder="Enter address 2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-md-2 col-form-label">Postcode:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                                <input type="text" name="postcode" class="form-control" placeholder="Enter postcode">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-md-2 col-form-label">City:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                                <input type="text" name="city" class="form-control" placeholder="Enter city">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-md-2 col-form-label">Country:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-flag"></i></span></div>
                                <select name="country" class="form-control">
                                    @foreach($countries as $country)
                                        <option></option>
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="k-separator k-separator--border-dashed"></div>
                    <div class="k-separator k-separator--height-sm"></div>

                    @foreach($contacts as $contact)
                        <div class="k-repeater__item">
                            <div class="k-repeater__close k-repeater__close--align-right form-group">
                                <button data-repeater-delete="" class="btn btn-elevate-hover btn-sm  btn-font-danger">
                                    <i class="la la-close"></i> Close
                                </button>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-md-2 col-form-label">Building Name:</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-home"></i></span></div>
                                        <input type="text" name="building_name" class="form-control" placeholder="Enter building number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-md-2 col-form-label">Address 1:</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                                        <input type="text" name="address1" class="form-control" placeholder="Enter address 1">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-md-2 col-form-label">Address 2:</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                                        <input type="text" name="address2" class="form-control" placeholder="Enter address 2">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-md-2 col-form-label">Postcode:</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                                        <input type="text" name="postcode" class="form-control" placeholder="Enter postcode">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-md-2 col-form-label">City:</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                                        <input type="text" name="city" class="form-control" placeholder="Enter city">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-md-2 col-form-label">Country:</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-flag"></i></span></div>
                                        <select name="country" class="form-control">
                                            <option>Select country</option>
                                            @foreach($countries as $country)
                                                <option></option>
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="k-separator k-separator--border-dashed"></div>
                            <div class="k-separator k-separator--height-sm"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="k-repeater__add-data">
	        <span data-repeater-create="" class="btn btn-info btn-sm">
	        	<i class="la la-plus"></i> Add Alternative Address
	        </span>
        </div>
    </div>
</div>

<div class="k-portlet__foot">
    <div class="k-form__actions">
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>