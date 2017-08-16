<div class="tabs is-boxed">
    <ul>

        <li class="{{ ( Route::currentRouteName() == 'admin.programs.index' ) ? 'is-active' : '' }}">
            <a href="{{ route( 'admin.programs.index' ) }}">All Programs</a>
        </li>

        @if( isset( $school ) )
        <li class="{{ ( Route::currentRouteName() == 'admin.programs.archived' ) ? 'is-active' : '' }}">
            <a href="{{ route( 'admin.programs.archived', [ $school->id ] ) }}">Archived</a>
        </li>
        @endif

        <li class="{{ ( Route::currentRouteName() == 'admin.programs.create' ) ? 'is-active' : '' }}">
            <a href="{{ route( 'admin.programs.create' ) }}">
                <span class="icon is-small">
                  <i class="fa fa-plus"></i>
                </span>
                <span>Create</span>
            </a>
        </li>

    </ul>
</div>