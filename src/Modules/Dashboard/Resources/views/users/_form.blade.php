<div class="row">
    <div class="col-12 col-sm-6 col-md-6">
        <div class="card card-info">
            <div class="card-body">

                <div class="form-group">
                    <label for="input-name">@lang('shared.username')</label>
                    {{ Form::text('name', null,
                        [
                            'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.username'),
                            'id' => 'input-name'
                        ]
                    ) }}
                    @error("name")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-email">@lang('shared.email')</label>
                    {{ Form::email('email', null,
                        [
                            'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.email'),
                            'id' => 'input-email'
                        ]
                    ) }}
                    @error("email")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-password">@lang('shared.password')</label>
                    {{ Form::password('password',
                        [
                            'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.password'),
                            'id' => 'input-password'
                        ]
                    ) }}
                    @error("password")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-password-confirmed">@lang('shared.password_confirmation')</label>
                    {{ Form::password('password_confirmation',
                        [
                            'class' => 'form-control' . ($errors->has('password-confirmation') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.password_confirmation'),
                            'id' => 'input-password-confirmed'
                        ]
                    ) }}
                </div>

            </div>

        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-6">
        <div class="card card-info">
            <div class="card-body">

                <div class="form-group">
                    <label>@lang('shared.roles')</label>
                    {{ Form::select('roles[]', $roles, null,
                        [
                            'class' => 'select2bs4' . ($errors->has('roles') ? ' is-invalid' : ''),
                            'multiple' => 'multiple',
                            'data-placeholder' => trans('shared.select_roles'),
                            'style' => 'width: 100%'
                        ]
                    ) }}
                    @error("roles")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-avatar">@lang('shared.avatar')</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input
                                name="avatar"
                                type="file"
                                accept="image/*"
                                class="custom-file-input"
                                id="input-avatar"
                            />
                            <label class="custom-file-label" for="input-avatar">@lang('shared.choose_avatar')</label>
                        </div>
                    </div>
                    <div class="mt-2">
                        @if(isset($user) && $user->hasMedia('avatar'))
                            <a href="{{$user->getFirstMediaUrl('avatar')}}">
                                <img
                                    width="128"
                                    height="128"
                                    src="{{$user->getFirstMediaUrl('avatar', 'thumb')}}"
                                    alt="avatar"
                                >
                            </a>
                        @else
                            <img width="100" src="{{asset('images/no-image.jpg')}}" alt="no-image">
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/dashboard/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('inline_scripts')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('vendor/dashboard/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('vendor/dashboard/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
@endpush
