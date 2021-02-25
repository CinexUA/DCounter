<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width: 55px">@sortablelink('id', '#')</th>
            <th>@lang('shared.name')</th>
            <th>@lang('shared.description')</th>
            <th>@lang('shared.organizer')</th>
            <th>@lang('shared.price_per_month')</th>
            <th>@lang('shared.action')</th>
        </tr>
        </thead>
        <tbody>
        @each('dashboard::companies._item', $companies, 'company', 'shared/_empty')
        </tbody>
    </table>
</div>
