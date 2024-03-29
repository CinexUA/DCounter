<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width: 55px">@sortablelink('id', '#')</th>
            <th>@lang('shared.name')</th>
            <th>@lang('shared.email')</th>
            <th>@lang('shared.phone')</th>
            <th>@lang('shared.status')</th>
            <th>@lang('shared.balance')</th>
            <th>@lang('shared.left_days')</th>
            <th>@lang('shared.action')</th>
        </tr>
        </thead>
        <tbody>
        @forelse($clients as $client)
            @include('dashboard::clients._item', ['company' => $company, 'client' => $client])
        @empty
            @include('shared._empty_table_row')
        @endforelse
        </tbody>
    </table>
</div>
