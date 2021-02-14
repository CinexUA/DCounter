<div class="row">
    <div class="col-12 col-sm-6 col-md-6">
        <div class="card card-info">
            <div class="card-body">

                <div class="form-group">
                    <label for="input-name">{{__('Username')}}</label>
                    {{ Form::text('name', null,
                        [
                            'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                            'placeholder' => __('Username'),
                            'id' => 'input-name'
                        ]
                    ) }}
                    @error("name")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-email">{{__('Email')}}</label>
                    {{ Form::email('email', null,
                        [
                            'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                            'placeholder' => __('Email'),
                            'id' => 'input-email'
                        ]
                    ) }}
                    @error("email")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-password">{{__('Password')}}</label>
                    {{ Form::password('password',
                        [
                            'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                            'placeholder' => __('Password'),
                            'id' => 'input-password'
                        ]
                    ) }}
                    @error("password")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-password-confirmed">{{__('Password confirmation')}}</label>
                    {{ Form::password('password_confirmation',
                        [
                            'class' => 'form-control' . ($errors->has('password-confirmation') ? ' is-invalid' : ''),
                            'placeholder' => __('Password confirmation'),
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
                    <label>{{__('Roles')}}</label>
                    {{ Form::select('roles[]', $roles, null,
                        [
                            'class' => 'select2bs4' . ($errors->has('roles') ? ' is-invalid' : ''),
                            'multiple' => 'multiple',
                            'data-placeholder' => __('Select roles'),
                            'style' => 'width: 100%'
                        ]
                    ) }}
                    @error("roles")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-avatar">{{__('Avatar')}}</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input
                                name="avatar"
                                type="file"
                                accept="image/*"
                                class="custom-file-input"
                                id="input-avatar"
                            />
                            <label class="custom-file-label" for="input-avatar">{{__('Choose avatar')}}</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">{{__("Upload")}}</span>
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
