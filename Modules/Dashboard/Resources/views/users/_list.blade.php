<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width: 55px">@sortablelink('id', '#')</th>
            <th>@lang('shared.name')</th>
            <th>@lang('shared.email')</th>
            <th>@lang('shared.roles')</th>
            <th>@lang('shared.action')</th>
        </tr>
        </thead>
        <tbody>
        @each('dashboard::users._item', $users, 'user', 'shared/_empty_table_row')
        </tbody>
    </table>
</div>
