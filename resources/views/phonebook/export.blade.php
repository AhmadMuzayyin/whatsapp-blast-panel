<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Link</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contacts as $value)
            <tr>
                <td>{{ $value->name }}</td>
                <td>{{ $value->number }}</td>
                <td>{{ 'https://wa.me/' . $value->number }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
