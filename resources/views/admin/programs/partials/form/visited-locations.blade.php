<div class="notification content">

    <p>
        <strong>Visited Locations</strong>
        <a class="button is-small is-pulled-right">
            <span class="icon is-small"><i class="fa fa-plus"></i></span>
            <span>Create</span>
        </a>
    </p>

    @if( $program->visitedLocations->count() )

    <table class="table">

        <thead>
            <tr>
                <th>Address</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach( $program->visitedLocations as $location )
            <tr>
                <td>{{ $location->full_address }}</td>
                <td>{{ $location->start_date }}</td>
                <td>{{ $location->end_date }}</td>
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