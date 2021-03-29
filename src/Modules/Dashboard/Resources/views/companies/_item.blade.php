<tr>
    <td>{{$company->getKey()}}</td>
    <td>{{$company->getName()}}</td>
    <td>{{$company->getDescription()}}</td>
    <td>{{$company->organizer->getName()}}</td>
    <td>{{$company->getPricePerMonthFormatted()}}</td>
    <td>
        <div class="btn-group btn-group-xs" role="group">
            <a class="btn btn-success" href="{{route('dashboard.company.clients.index', $company)}}" role="button">
                <i class="fas fa-house-user"></i>
            </a>
            @can('view', $company)
            @if($company->visiting_clients_log)
            <a class="btn btn-primary" href="{{route('dashboard.company.visiting_customers', $company)}}" role="button">
                <i class="fas fa-shoe-prints"></i>
            </a>
            @endif
            <a class="btn btn-primary" href="{{route('dashboard.companies.show', $company)}}" role="button">
                <i class="fas fa-eye"></i>
            </a>
            @endcan
            @can('update', $company)
            <a class="btn btn-warning" href="{{route('dashboard.companies.edit', $company)}}" role="button">
                <i class="fas fa-edit"></i>
            </a>
            @endcan
            @can('delete', $company)
            <a
                class="btn btn-danger delete"
                href="#"
                role="button"
                data-id="{{$company->getKey()}}"
                data-name="{{$company->getName()}}"
                data-url="{{route('dashboard.companies.destroy', $company->id)}}"

            >
                <i class="fas fa-trash"></i>
            </a>
            @endcan
        </div>
    </td>
</tr>
