<div class="table-responsive-sm">
    <table class="table table-striped" id="profiles-table">
        <thead>
            <tr>
                <th>Dni</th>
        <th>First Name</th>
        <th>Lastname</th>
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
                    {!! Form::open(['route' => ['profiles.destroy', $profile->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('profiles.show', [$profile->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('profiles.edit', [$profile->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>