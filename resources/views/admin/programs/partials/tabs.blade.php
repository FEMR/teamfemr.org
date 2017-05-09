<div class="tabs is-boxed">
    <ul>

        <li class="{{ ( Route::currentRouteName() == 'admin.programs.index' ) ? 'is-active' : '' }}">
            <a href="{{ route( 'admin.programs.index', [ $school->id ] ) }}">All Programs</a>
        </li>

        <li class="{{ ( Route::currentRouteName() == 'admin.programs.archived' ) ? 'is-active' : '' }}">
            <a href="{{ route( 'admin.programs.archived', [ $school->id ] ) }}">Archived</a>
        </li>

        <li class="{{ ( Route::currentRouteName() == 'admin.programs.create' ) ? 'is-active' : '' }}">
            <a href="{{ route( 'admin.programs.create', [ $school->id ] ) }}">
                <span class="icon is-small">
                  <i class="fa fa-plus"></i>
                </span>
                <span>Create</span>
            </a>
        </li>

    </ul>
</div>