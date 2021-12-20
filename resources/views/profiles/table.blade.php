<div class="table-responsive-sm">
    <table class="table table-striped" id="profiles-table">
        <thead>
            <tr>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Pais Emisor</th>
        <th>Tipo de documento</th>
        <th>Fecha Nacimiento</th>
        <th>Nacionalidad</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($profiles as $profile)
            <tr>
            <td>{{ $profile->first_name }}</td>
            <td>{{ $profile->lastname }}</td>
            <td>{{ $profile->country_document }}</td>
            <td>{{ $profile->type_document }}</td>
            <td>{{ $profile->birthdate }}</td>
            <td>{{ $profile->nacionality }}</td>
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