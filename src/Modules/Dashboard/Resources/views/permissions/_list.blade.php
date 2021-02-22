<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width: 55px">#</th>
            <th>@lang('shared.name')</th>
            <th>@lang('shared.description')</th>
            <th>@lang('shared.action')</th>
        </tr>
        </thead>
        <tbody>
        @each('dashboard::permissions._item', $permissions, 'permission', 'shared/_empty')
        </tbody>
    </table>
</div>
