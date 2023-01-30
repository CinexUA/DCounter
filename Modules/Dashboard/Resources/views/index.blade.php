@extends('dashboard::layouts.app')

@section('title')
    Dashboard
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">

            @if(app()->environment('local'))
            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('dashboard.simulation.passed.day')}}" method="POST">
                        @csrf
                        <button
                            type="submit"
                            class="btn btn-sm btn-danger mb-2"
                            onclick="return confirm('To simulate running a cron task that runs every day at 00:00?')"
                        >
                            Simulation of the passed day
                        </button>
                    </form>
                </div>
            </div>
            @endif

            @role(['administrator'])
            <div class="row">
                <div class="col-lg-12">
                    <h4>
                        @lang('shared.generally')
                    </h4>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$amountAllUsers}}</h3>

                            <p>{{trans_choice('shared.users_plural', $amountAllUsers)}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$amountAllClients}}</h3>

                            <p>{{trans_choice('shared.clients_plural', $amountAllClients)}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>

            </div>
            @endrole

            <div class="row">
                <div class="col-lg-12">
                    <h4>
                        @lang('shared.user_statistics_with_name', ['name' => auth()->user()->getName()])
                    </h4>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$amountUserOwnClients}}</h3>

                            <p>{{trans_choice('shared.clients_plural', $amountUserOwnClients)}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
