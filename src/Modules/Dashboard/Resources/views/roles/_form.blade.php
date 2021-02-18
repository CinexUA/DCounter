<div class="row">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-body">

                <div class="form-group">
                    <label for="input-name">@lang('dashboard::shared.role_name_code')</label>
                    {{ Form::text('name', null,
                        [
                            'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                            'placeholder' => trans('dashboard::shared.role_name_code'),
                            'id' => 'input-name',
                            'disabled'
                        ]
                    ) }}
                    @error("name")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-display-name">@lang('shared.display_name')</label>
                    {{ Form::text('display_name', null,
                        [
                            'class' => 'form-control' . ($errors->has('display_name') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.display_name'),
                            'id' => 'input-display-name'
                        ]
                    ) }}
                    @error("display_name")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-description">@lang('shared.description')</label>
                    {{ Form::text('description', null,
                        [
                            'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.description'),
                            'id' => 'input-description'
                        ]
                    ) }}
                    @error("description")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            </div>

        </div>
    </div>

    <div class="col-12">
        <div class="card card-info">
            <div class="card-body">
                <div class="form-group">
                    <label for="duallistbox">@lang('shared.permissions')</label>
                    {{Form::select('permissions[]', $permissions, $selectedPermissions, [
                                        'multiple',
                                        'class' => 'duallistbox',
                                        'id' => 'duallistbox'
                                    ])}}
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('vendor/dashboard/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endpush

@push('inline_scripts')
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('vendor/dashboard/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script>
        $(function () {
            //Bootstrap Duallistbox
            $('#duallistbox').bootstrapDualListbox({
                moveOnSelect: false,
                removeAllLabel: '{{trans('shared.remove_all')}}',
                removeSelectedLabel: '{{trans('shared.remove_selected')}}',
                moveSelectedLabel: '{{trans('shared.move_selected')}}',
                filterPlaceHolder: '{{trans('shared.filter')}}',
                filterTextClear: '{{trans('shared.show_all')}}',
                moveAllLabel: '{{trans('shared.move_all')}}',
                infoText: '{{trans('dashboard::shared.showing_all_0')}}',
                infoTextFiltered: '{!! trans('dashboard::shared.filtered_0_from_1') !!}',
                infoTextEmpty: '{{trans('shared.empty_list')}}',
                selectedListLabel: '{{trans('dashboard::shared.selected_permissions')}}',
                nonSelectedListLabel: '{{trans('dashboard::shared.available_permissions')}}',
            });
        });
    </script>
@endpush
