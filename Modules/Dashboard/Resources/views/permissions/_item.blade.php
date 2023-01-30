<tr>
    <td>{{$permission->getKey()}}</td>
    <td>{{$permission->getDisplayName()}}</td>
    <td>{{$permission->getDescription()}}</td>
    <td>
        <div class="btn-group btn-group-xs" role="group">
            @can('view', $permission)
            <a class="btn btn-primary" href="{{route('dashboard.admin.permissions.show', $permission)}}" role="button">
                <i class="fas fa-eye"></i>
            </a>
            @endcan
            @can('update', $permission)
            <a class="btn btn-warning" href="{{route('dashboard.admin.permissions.edit', $permission)}}" role="button">
                <i class="fas fa-edit"></i>
            </a>
            @endcan
        </div>
    </td>
</tr>
