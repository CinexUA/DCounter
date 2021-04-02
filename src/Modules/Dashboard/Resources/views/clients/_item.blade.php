<tr>
    <td>{{$client->getKey()}}</td>
    <td>{{$client->getName()}}</td>
    <td>{{$client->getEmail()}}</td>
    <td>{{$client->getPhone()}}</td>
    <td>{!! $client->getStatusAsBadge() !!}</td>
    <td>{{$client->wallet->balanceFloat}}</td>
    <td>{{$client->getLeftDaysTransVariant()}}</td>
    <td>
        <div class="btn-group btn-group-xs" role="group">
            <a class="btn btn-success" href="{{route('dashboard.client-wallet.edit', $client)}}" role="button">
                <i class="fas fa-hand-holding-usd"></i>
            </a>
            @can('view', $client)
            <a class="btn btn-primary" href="{{route('dashboard.company.clients.show', [$company, $client])}}" role="button">
                <i class="fas fa-eye"></i>
            </a>
            @endcan
            @can('update', $client)
            <a class="btn btn-warning" href="{{route('dashboard.company.clients.edit', [$company, $client])}}" role="button">
                <i class="fas fa-edit"></i>
            </a>
            @endcan
            @can('delete', $client)
            <a
                class="btn btn-danger delete"
                href="#"
                role="button"
                data-id="{{$client->getKey()}}"
                data-name="{{$client->getName()}}"
                data-url="{{route('dashboard.company.clients.destroy', [$company, $client])}}"
            >
                <i class="fas fa-trash"></i>
            </a>
            @endcan
        </div>
    </td>
</tr>
