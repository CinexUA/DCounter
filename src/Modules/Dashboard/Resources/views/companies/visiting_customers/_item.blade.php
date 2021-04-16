<tr>
    <td>{{$visit->getKey()}}</td>
    <td>{{$visit->getDescription()}}</td>
    <td>{{$visit->client->getName()}}</td>
    <td>{{$visit->created_at->format('H:m d.m.Y')}}</td>
</tr>
