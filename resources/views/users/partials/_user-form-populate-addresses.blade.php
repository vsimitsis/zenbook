@if(old('address-list'))
    @foreach(array_slice(old('address-list'), 1, null, true) as $key => $value)
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
                        <input type="text" name="address-list[{{ $key }}][building_name]" value="{{ $value['building_name'] }}" class="form-control" placeholder="Enter building number">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Address 1:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                        <input type="text" name="address-list[{{ $key }}][address1]" value="{{ $value['address1'] }}" class="form-control" placeholder="Enter address 1">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Address 2:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                        <input type="text" name="address-list[{{ $key }}][address2]" value="{{ $value['address2'] }}" class="form-control" placeholder="Enter address 2">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Postcode:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                        <input type="text" name="address-list[{{ $key }}][postcode]" value="{{ $value['postcode'] }}" class="form-control" placeholder="Enter postcode">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">City:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                        <input type="text" name="address-list[{{ $key }}][city]" value="{{ $value['city'] }}" class="form-control" placeholder="Enter city">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Country:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-flag"></i></span></div>
                        <select name="address-list[{{ $key }}][country]" class="form-control">
                            <option value="0">Select country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ isset($value['country']) && $value['country'] == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="k-separator k-separator--border-dashed"></div>
            <div class="k-separator k-separator--height-sm"></div>
        </div>
    @endforeach
@else
    @foreach($addresses->slice(1) as $key => $value)
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
                        <input type="text" name="address-list[{{ $key }}][building_name]" value="{{ $value->building_name }}" class="form-control" placeholder="Enter building number">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Address 1:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                        <input type="text" name="address-list[{{ $key }}][address1]" value="{{ $value->address1 }}" class="form-control" placeholder="Enter address 1">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Address 2:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                        <input type="text" name="address-list[{{ $key }}][address2]" value="{{ $value->address2 }}" class="form-control" placeholder="Enter address 2">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Postcode:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                        <input type="text" name="address-list[{{ $key }}][postcode]" value="{{ $value->postcode }}" class="form-control" placeholder="Enter postcode">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">City:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-road"></i></span></div>
                        <input type="text" name="address-list[{{ $key }}][city]" value="{{ $value->city }}" class="form-control" placeholder="Enter city">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-2 col-form-label">Country:</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-flag"></i></span></div>
                        <select name="address-list[{{ $key }}][country]" class="form-control">
                            <option value="0">Select country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ $value->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="k-separator k-separator--border-dashed"></div>
            <div class="k-separator k-separator--height-sm"></div>
        </div>
    @endforeach
@endif