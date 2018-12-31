<div class="k-portlet__body">
    <h3 class="k-heading k-heading--md k-heading--no-top-margin">1. Customer Info:</h3>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Full Name:</label>
        <div class="col-lg-8">
            <input type="email" class="form-control" placeholder="Enter full name">
            {{--<span class="form-text text-muted">Please enter your full name</span>--}}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Email address:</label>
        <div class="col-lg-8">
            <div class="input-group">
                <div class="k-repeater">
                    <div class="k-repeater__data-set">
                        <div data-repeater-list="email-list">
                            <div data-repeater-item class="k-repeater__item">
                                <div class="k-repeater__row">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Enter email">
                                        <div class="input-group-append">
                                            <button data-repeater-delete="" class="btn btn-icon btn-font-danger">
                                                <i class="la la-close k-font-danger"></i>
                                            </button>
                                        </div>
                                        <span class="form-text text-muted"></span>
                                    </div>
                                </div>
                                <div class="k-separator k-separator--space-sm"></div>
                            </div>
                        </div>
                    </div>
                    <div class="k-repeater__add-data ">
					    <span data-repeater-create="" class="btn btn-info btn-sm ">
					    	<i class="la la-plus k-font-light"></i> Add Email
					    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="k-separator k-separator--space-sm k-separator--border-dashed"></div>
    <h3 class="k-heading k-heading--md">2. Customer Account:</h3>
    <div class="k-repeater">
        <div class="k-repeater__data-set">
            <div data-repeater-list="demo3-list2">
                <div data-repeater-item class="k-repeater__item">
                    <div class="k-repeater__close k-repeater__close--align-right form-group">
                        <button data-repeater-delete="" class="btn btn-elevate-hover btn-sm  btn-font-danger">
                            <i class="la la-close"></i> Close
                        </button>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Holder:</label>
                        <div class="col-lg-6">
                            <input type="email" class="form-control" placeholder="Enter full name">
                            <span class="form-text text-muted">Please enter your account holder</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Contact</label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-chain"></i></span></div>
                                <input type="text" class="form-control" placeholder="Phone number">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Communication:</label>
                        <div class="col-lg-6">
                            <div class="k-checkbox-inline">
                                <label class="k-checkbox">
                                    <input type="checkbox"> Email
                                    <span></span>
                                </label>
                                <label class="k-checkbox">
                                    <input type="checkbox"> SMS
                                    <span></span>
                                </label>
                                <label class="k-checkbox">
                                    <input type="checkbox"> Phone
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="k-separator k-separator--border-dashed"></div>
                    <div class="k-separator k-separator--height-sm"></div>
                </div>
            </div>
        </div>
        <div class="k-repeater__add-data">
														<span data-repeater-create="" class="btn btn-info btn-sm">
															<i class="la la-plus"></i> Add Customer Account
														</span>
        </div>
    </div>
</div>