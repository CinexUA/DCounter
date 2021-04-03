<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width: 55px">@sortablelink('id', '#')</th>
            <th>@lang('shared.name')</th>
            <th>@lang('shared.action')</th>
        </tr>
        </thead>
        <tbody>
        @each('dashboard::currencies._item', $currencies, 'currency', 'shared/_empty_table_row')
        </tbody>
    </table>
</div>
