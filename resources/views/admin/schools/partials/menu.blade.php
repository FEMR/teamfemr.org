<div class="tabs">
    <ul>
        <li class="{{ ( Route::currentRouteName() == 'admin.schools.index' ) ? 'is-active' : '' }}">
            <a href="{{ route( 'admin.schools.index' ) }}">All Schools</a>
        </li>
        <li class="{{ ( Route::currentRouteName() == 'admin.schools.archived' ) ? 'is-active' : '' }}">
            <a href="{{ route( 'admin.schools.archived' ) }}">Archived</a>
        </li>

        @if( Route::currentRouteName() != 'admin.schools.create' )
        <li class="{{ ( Route::currentRouteName() == 'admin.schools.create' ) ? 'is-active' : '' }}">
            <a href="{{ route( 'admin.schools.create') }}">
                <span class="icon is-small">
                  <i class="fa fa-plus"></i>
                </span>
                <span>Create</span>
            </a>
        </li>
        @endif

    </ul>
</div>