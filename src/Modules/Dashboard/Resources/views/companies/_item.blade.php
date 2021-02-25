<tr>
    <td>{{$company->getKey()}}</td>
    <td>{{$company->getName()}}</td>
    <td>{{$company->getDescription()}}</td>
    <td>{{$company->organizer->getName()}}</td>
    <td>{{$company->getPricePerMonth()}}</td>
    <td>
        <div class="btn-group btn-group-xs" role="group">
            @can('view', $company)
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
