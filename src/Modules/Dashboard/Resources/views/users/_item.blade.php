<tr>
    <td>{{$user->getKey()}}</td>
    <td>{{$user->getName()}}</td>
    <td>{{$user->getEmail()}}</td>
    <td>{!! $user->getUserRolesAsStringWrap() !!}</td>
    <td>
        <div class="btn-group btn-group-xs" role="group">
            @can('view', $user)
            <a class="btn btn-primary" href="{{route('dashboard.admin.users.show', $user)}}" role="button">
                <i class="fas fa-eye"></i>
            </a>
            @endcan
            @can('update', $user)
            <a class="btn btn-warning" href="{{route('dashboard.admin.users.edit', $user)}}" role="button">
                <i class="fas fa-edit"></i>
            </a>
            @endcan
            @can('delete', $user)
            <a
                class="btn btn-danger delete"
                href="#"
                role="button"
                data-id="{{$user->getKey()}}"
                data-name="{{$user->getName()}}"
                data-url="{{route('dashboard.admin.users.destroy', $user->id)}}"

            >
                <i class="fas fa-trash"></i>
            </a>
            @endcan
        </div>
    </td>
</tr>
