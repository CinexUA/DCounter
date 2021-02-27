@if(isset($company))
<div class="card-header filter-area" id="filter-box" @if(app('request')->has('filter-panel-expand')) style="display: block" @endif>
    {!! Form::open(['route' => ['dashboard.company.clients.index', $company], 'class' => 'form-horizontal', 'method' => 'GET']) !!}
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
                    href="{{route('dashboard.company.clients.index', $company)}}"
                    class="btn btn-default btn-loader-handle"
                >
                    <i class="fas fa-undo-alt"></i> @lang('shared.reset')
                </a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endif
