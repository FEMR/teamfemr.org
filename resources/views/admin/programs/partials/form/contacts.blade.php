<div class="notification content">

    <p>
        <strong>Contacts</strong>
        <a class="button is-small is-pulled-right">
            <span class="icon is-small"><i class="fa fa-plus"></i></span>
            <span>Create</span>
        </a>
    </p>

    @if( $program->contacts->count() )

    <table class="table">

        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Notes</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach( $program->contacts as $contact )
            <tr>
                <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->notes }}</td>
                <td>
                    <a class="button is-small">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    @else

    <p>There are no locations - <a href="#">add one</a> now.</p>

    @endif

</div>