<tr>
    <td>{{$currency->getKey()}}</td>
    <td>{{$currency->getName()}}</td>
    <td>
        <div class="btn-group btn-group-xs" role="group">
            @can('view', $currency)
            <a class="btn btn-primary" href="{{route('dashboard.admin.currencies.show', $currency)}}" role="button">
                <i class="fas fa-eye"></i>
            </a>
            @endcan
            @can('update', $currency)
            <a class="btn btn-warning" href="{{route('dashboard.admin.currencies.edit', $currency)}}" role="button">
                <i class="fas fa-edit"></i>
            </a>
            @endcan
            @can('delete', $currency)
            <a
                class="btn btn-danger delete"
                href="#"
                role="button"
                data-id="{{$currency->getKey()}}"
                data-name="{{$currency->getName()}}"
                data-url="{{route('dashboard.admin.currencies.destroy', $currency)}}"

            >
                <i class="fas fa-trash"></i>
            </a>
            @endcan
        </div>
    </td>
</tr>
