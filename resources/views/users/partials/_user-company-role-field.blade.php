@can('administrate', $company)
    @if($currentUser->is($user))
        <div class="form-group row">
            <label class="col-sm-3 col-md-2 col-form-label">Company Role:</label>
            <div class="col-sm-6">
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-key"></i></span></div>
                    <select class="form-control" disabled>
                        <option selected>{{ $user->userRole->name }}</option>
                    </select>
                </div>
                <span class="form-text text-muted">You can't change your own company role.</span>
            </div>
        </div>
        <input type="hidden" name="company_role" value="{{ $user->user_role_id }}">
    @else
        <div class="form-group row">
            <label class="col-sm-3 col-md-2 col-form-label">Company Role:</label>
            <div class="col-sm-6">
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-key"></i></span></div>
                    <select name="company_role" class="form-control {{ $errors->has('company_role') ? 'is-invalid' : '' }}">
                        <option value="0" selected>Select Role</option>
                        @foreach($userRoles as $role)
                            <option value="{{ $role->id }}" {{ old('company_role', $user->user_role_id) == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">{{ $errors->first('company_role') }}</div>
                </div>
                <span class="form-text text-muted">Be cautious for whom you give administration privileges.</span>
            </div>
        </div>
    @endif
@endcan