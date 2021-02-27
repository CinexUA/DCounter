@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.client_wallet')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('client.wallet.edit', $client->company, $client) }}
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::model($client,
            [
                'method' => 'PATCH',
                'files' => true,
                'route' => ['dashboard.client-wallet.update', $client]
            ]
        ) !!}

        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card card-info">
                    <div class="card-body">

                        <strong>@lang('shared.name')</strong>
                        <p class="text-muted">
                            {{$client->getName()}}
                        </p>
                        <hr>

                        <div class="form-group">
                            <label for="input-amount">@lang('shared.amount')</label>
                            {{ Form::number('amount', null,
                                [
                                    'class' => 'form-control' . ($errors->has('amount') ? ' is-invalid' : ''),
                                    'placeholder' => trans('shared.amount'),
                                    'step' => '0.01',
                                    'id' => 'input-amount'
                                ]
                            ) }}
                            @error("amount")
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

                        <div class="form-group">
                            <label for="input-operation-type">@lang('shared.operation_type')</label>
                            <p class="mb-0">
                                <input
                                    id="input-operation-type"
                                    type="checkbox"
                                    name="is_deposit"
                                    value="1"
                                    checked
                                    data-bootstrap-switch
                                    data-inverse="true"
                                    data-indeterminate="true"
                                    data-on-color="success"
                                    data-off-color="danger"
                                    data-off-text="@lang('shared.withdrawal')"
                                    data-on-text="@lang('shared.deposit')"
                                />
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.company.clients.show', [$client->company, $client])}}"
                   class="btn btn-secondary">@lang('shared.back')</a>
                {{Form::submit(trans('shared.charge'), ['class' => 'btn btn-success float-right'])}}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@push('styles')
    <!-- Bootstrap Switch -->
    <link rel="stylesheet" href="{{ asset('vendor/dashboard/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}">
@endpush

@push('inline_scripts')
    <!-- Bootstrap Switch -->
    <script src="{{ asset('vendor/dashboard/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $(function () {
            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
        });
    </script>
@endpush
