<tr>
    <td>{{$role->getKey()}}</td>
    <td>{{$role->getDisplayName()}}</td>
    <td>{{$role->getDescription()}}</td>
    <td>
        <div class="btn-group btn-group-xs" role="group">
            @can('view', $role)
            <a class="btn btn-primary" href="{{route('dashboard.admin.roles.show', $role)}}" role="button">
                <i class="fas fa-eye"></i>
            </a>
            @endcan
            @can('update', $role)
            <a class="btn btn-warning" href="{{route('dashboard.admin.roles.edit', $role)}}" role="button">
                <i class="fas fa-edit"></i>
            </a>
            @endcan
        </div>
    </td>
</tr>
