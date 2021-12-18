<div class="table-responsive-sm">
    <table class="table table-striped" id="profiles-table">
        <thead>
            <tr>
                <th>Dni</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Country Document</th>
        <th>Type Document</th>
        <th>Birthdate</th>
        <th>Nacionality</th>
        <th>City</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($profiles as $profile)
            <tr>
                <td>{{ $profile->dni }}</td>
            <td>{{ $profile->first_name }}</td>
            <td>{{ $profile->lastname }}</td>
            <td>{{ $profile->country_document }}</td>
            <td>{{ $profile->type_document }}</td>
            <td>{{ $profile->birthdate }}</td>
            <td>{{ $profile->nacionality }}</td>
            <td>{{ $profile->city }}</td>
                <td>
                    <div class='btn-group'>
                        <a href="{{ route('profiles.edit', [$profile->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>