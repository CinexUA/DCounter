<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width: 55px">id</th>
            <th>@lang('shared.description')</th>
            <th>@lang('shared.created_at')</th>
        </tr>
        </thead>
        <tbody>
        @each('dashboard::cron-logs._item', $cronLogs, 'cronLog', 'shared/_empty_table_row')
        </tbody>
    </table>
</div>
