@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.transactions_list')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('client.wallet.transactions', $client->company, $client) }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>@lang('shared.uid')</th>
                                    <th>@lang('shared.amount')</th>
                                    <th>@lang('shared.type')</th>
                                    <th>@lang('shared.description')</th>
                                    <th>@lang('shared.created_at')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($transactions as $transaction)
                                    <tr>
                                        <td>{{$transaction->uuid}}</td>
                                        <td>{{$transaction->amount / 100}}</td>
                                        <td>
                                            @if($transaction->type == \Bavix\Wallet\Models\Transaction::TYPE_DEPOSIT)
                                                <span class="badge bg-success">@lang('shared.deposit')</span>
                                            @else
                                                <span class="badge bg-danger">@lang('shared.withdrawal')</span>
                                            @endif
                                        </td>
                                        <td>{{$transaction->meta['description'] ?? ''}}</td>
                                        <td>{{$transaction->created_at->diffForHumans()}}</td>
                                    </tr>
                                @empty
                                    @include('shared._empty_table_row')
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer clearfix">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                @include('dashboard::partials._per_page')
                                &nbsp;
                                @lang('shared.show_page_from_to_total', [
                                    'first' => $transactions->firstItem(),
                                    'last' => $transactions->lastItem(),
                                    'total' => $transactions->total()
                                ])
                            </div>
                            <div class="col-12 col-sm-6">
                                {{ $transactions->appends(request()->except('page'))->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
