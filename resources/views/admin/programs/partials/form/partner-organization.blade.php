<div class="notification content">

    <p>
        <strong>Partner Organizations</strong>
        <a class="button is-small is-pulled-right">
            <span class="icon is-small"><i class="fa fa-plus"></i></span>
            <span>Create</span>
        </a>
    </p>

    @if( $program->partnerOrganizations->count() )

        <table class="table">

            <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Website</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach( $program->partnerOrganizations as $partner )
                <tr>
                    <td>{{ $partner->name }}</td>
                    <td>{{ $partner->slug }}</td>
                    <td>{{ $partner->website }}</td>
                    <td>
                        <a class="button is-small">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>

    @else

        <p>There are no partner organizations - <a href="#">add one</a> now.</p>

    @endif

</div>