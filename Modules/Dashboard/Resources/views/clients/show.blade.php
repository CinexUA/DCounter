@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.detail_client')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('company.clients.show', $company, $client) }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card card-info">
                    <div class="card-body">

                        <strong>@lang('shared.name')</strong>
                        <p class="text-muted">
                            {{$client->getName()}}
                        </p>
                        <hr>

                        <strong>@lang('shared.email')</strong>
                        <p class="text-muted">
                            {{$client->getEmail()}}
                        </p>
                        <hr>

                        @if($client->getPhone())
                        <strong>@lang('shared.phone')</strong>
                        <p class="text-muted">
                            {{$client->getPhone()}}
                        </p>
                        <hr>
                        @endif

                        <strong>@lang('shared.company')</strong>
                        <p class="text-muted">
                            {{$company->getName()}}
                        </p>
                        <hr>

                        <strong>@lang('shared.status')</strong>
                        <p class="text-muted">
                            {!! $client->getStatusAsBadge() !!}
                        </p>
                        <hr>

                        @if($client->preferred_language)
                        <strong>@lang('shared.language_client_spoken')</strong>
                        <p class="text-muted">
                            {{ $languageClientSpoken }}
                        </p>
                        <hr>
                        @endif

                        <strong>@lang('dashboard::shared.payment_will_be_charged_via')</strong>
                        <p class="text-muted">
                            {{$client->getLeftDaysTransVariant()}}
                            <br />
                            <a id="calculate_days_for_next_month" href="#">
                                @lang('dashboard::shared.calculate_days_for_next_month')
                            </a>
                        </p>
                        <hr>

                        <strong>@lang('shared.next_payment')</strong>
                        <p class="text-muted">
                            {{$nextPaymentAsString}}
                        </p>
                        <hr>

                        <strong>@lang('shared.balance')</strong>
                        <p class="text-muted">
                            {{$client->balanceFloat}}{{$company->currency->getName()}}
                        </p>

                    </div>

                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('shared.latest_transactions')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>@lang('shared.uid')</th>
                                <th>@lang('shared.amount')</th>
                                <th>@lang('shared.type')</th>
                                <th>@lang('shared.created_at')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($latestTransactions as $transaction)
                            <tr>
                                <td>{{Str::limit($transaction->uuid, 8)}}</td>
                                <td>{{$transaction->amount / 100}}{{$company->currency->getName()}}</td>
                                <td>
                                    @if($transaction->type == \Bavix\Wallet\Models\Transaction::TYPE_DEPOSIT)
                                        <span class="badge bg-success">@lang('shared.deposit')</span>
                                    @else
                                        <span class="badge bg-danger">@lang('shared.withdrawal')</span>
                                    @endif
                                </td>
                                <td>{{$transaction->created_at->format('H:m d.m.Y')}}</td>
                            </tr>
                            @empty
                                @include('shared._empty_table_row')
                            @endforelse
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    @if($latestTransactions->count())
                    <div class="card-footer clearfix">
                        <a href="{{route('dashboard.client-wallet.transactions', [$company, $client])}}">
                            @lang('shared.show_all_transactions')
                        </a>
                    </div>
                     @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.company.clients.index', $company)}}"
                   class="btn btn-secondary">@lang('shared.back')</a>
                <div class="btn-group float-right">
                    <a
                        href="{{route('dashboard.client-wallet.edit', $client)}}"
                        class="btn btn-warning"
                    >
                        @lang('shared.deposit_withdrawal')
                    </a>
                    @can('update', $company)
                    <a
                        href="{{route('dashboard.company.clients.edit', [$company, $client])}}"
                        class="btn btn-success"
                    >
                        @lang('shared.edit')
                    </a>
                    @endcan
                </div>

            </div>
        </div>
    </div>
@endsection

@push('inline_scripts')
    <script>
        const calculate_days = document.getElementById('calculate_days_for_next_month');
        if(calculate_days){
            calculate_days.addEventListener('click', function (e) {
                e.preventDefault();

                if(confirm('{{trans('dashboard::shared.calculate_days_for_next_month_and_update')}}')){
                    $.ajax({
                        url: '{{route('dashboard.client.calculateDaysForNextMonth', $client)}}',
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: { "_method": "PUT" },
                        beforeSend: function( xhr ) {
                            showLoader();
                        },
                        success: function(response){
                            document.location.reload();
                        },
                        error:function(response, success, failure) {
                            document.location.reload();
                        },
                        complete: function () {
                            hideLoader();
                        }
                    });
                }
            });
        }
    </script>
@endpush
