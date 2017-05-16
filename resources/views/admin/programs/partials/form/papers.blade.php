<div class="notification content">

    <p>
        <strong>Papers</strong>
        <a class="button is-small is-pulled-right">
            <span class="icon is-small"><i class="fa fa-plus"></i></span>
            <span>Create</span>
        </a>
    </p>

    @if( $program->papers->count() )

    <table class="table">

        <thead>
            <tr>
                <th>Title</th>
                <th>Url</th>
                <th>Description</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach( $program->papers as $paper )
            <tr>
                <td>{{ $paper->title }}</td>
                <td>{{ $paper->url }}</td>
                <td>{{ $paper->description }}</td>
                <td>
                    <a class="button is-small">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    @else

    <p>There are no papers - a href="#">add one</a> now.</p>

    @endif

</div>