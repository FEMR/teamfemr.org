
@extends ('layouts.admin')

@section( 'section-header' )

    <h1 class="title">
        Schools
    </h1>
    <h2 class="subtitle">All</h2>

@endsection

@section( 'section-menu' )

    @include( 'admin.schools.partials.menu' )

@endsection

@section('section-content')

    @if( $schools->count() > 0 )

        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Address</th>
                </tr>
            </thead>

            <tbody>
                @foreach( $schools as $school )
                <tr>
                    <td v-cloak>
                        <dropdown-menu>
                            <menu-item link="{{ route( 'admin.schools.edit', [ $school->id ] ) }}">
                                <span class="icon"><i class="fa fa-pencil-square-o"></i></span> Edit
                            </menu-item>
                            <menu-item link="{{ route( 'admin.programs.index', [ $school->id ] ) }}">
                                <span class="icon"><i class="fa fa-list"></i></span> Outreach Programs
                            </menu-item>
                            <menu-form
                                    method="delete"
                                    route="{{ route( 'admin.schools.destroy', $school->id ) }}"
                                    token="{{ csrf_token() }}"
                                >
                                <span class="icon"><i class="fa fa-trash"></i></span> Delete
                            </menu-form>

                        </dropdown-menu>
                    </td>
                    <td>{{ $school->name }}</td>
                    <td>{!! $school->full_address !!}</td>

                </tr>
                @endforeach
            </tbody>

        </table>

    @else

        <p>There are no schools, but you can <a href="{{ route( 'admin.schools.create' ) }}">add one</a> now.</p>

    @endif

    <script type="text/babel">
        const button = document.querySelector('.button');
        const dropdown = document.querySelector('.dropdown');

        button.addEventListener('click', () => {
            dropdown.classList.toggle('is-open');
        });

    </script>
@endsection