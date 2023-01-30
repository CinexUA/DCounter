<div class="card-header filter-area" id="filter-box" @if(app('request')->has('filter-panel-expand')) style="display: block" @endif>
    {!! Form::open(['route' => 'dashboard.admin.users.index', 'class' => 'form-horizontal', 'method' => 'GET']) !!}
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6">
            {{ Form::hidden('filter-panel-expand', true) }}
            <div class="form-group row">
                <label for="filter-by-id" class="col-sm-2 col-form-label">{{strtoupper(trans('shared.id'))}}</label>
                <div class="col-sm-10">
                    {{ Form::text('filter-by-id', app('request')->input('filter-by-id'),
                       [
                           'id' => 'filter-by-id',
                           'class' => 'form-control',
                           'placeholder' => trans('shared.id')
                       ]
                   ) }}
                </div>
            </div>
            <div class="form-group row">
                <label for="filter-by-email" class="col-sm-2 col-form-label">@lang('shared.email')</label>
                <div class="col-sm-10">
                    {{ Form::email('filter-by-email', app('request')->input('filter-by-email'),
                       [
                           'id' => 'filter-by-email',
                           'class' => 'form-control',
                           'placeholder' => trans('shared.email')
                       ]
                   ) }}
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6">
            <div class="form-group row">
                <label for="filter-by-name" class="col-sm-2 col-form-label">@lang('shared.name')</label>
                <div class="col-sm-10">
                    {{ Form::text('filter-by-name', app('request')->input('filter-by-name'),
                       [
                           'id' => 'filter-by-name',
                           'class' => 'form-control',
                           'placeholder' => trans('shared.name')
                       ]
                   ) }}
                </div>
            </div>
            <div class="form-group row">
                <label for="filter-by-name" class="col-sm-2 col-form-label">@lang('shared.roles')</label>
                <div class="col-sm-10">
                    {{ Form::select('filter-by-roles[]', $roles, app('request')->input('filter-by-roles'),
                        [
                            'id' => 'filter-by-roles',
                            'class' => 'select2bs4',
                            'multiple' => 'multiple',
                            'data-placeholder' => trans('shared.select_roles'),
                            'style' => 'width: 100%'
                        ]
                    ) }}
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="btn-group btn-group-sm">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> @lang('shared.search')
                </button>
                <a
                    href="{{route('dashboard.admin.users.index')}}"
                    class="btn btn-default btn-loader-handle"
                >
                    <i class="fas fa-undo-alt"></i> @lang('shared.reset')
                </a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/dashboard/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('inline_scripts')
    <!-- Select2 -->
    <script src="{{ asset('vendor/dashboard/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
@endpush
