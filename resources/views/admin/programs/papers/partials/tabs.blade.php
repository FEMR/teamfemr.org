<div class="tabs is-boxed">
    <ul>

        <li class="{{ ( Route::currentRouteName() == 'admin.papers.index' ) ? 'is-active' : '' }}">
            <a href="{{ route( 'admin.papers.index', [ $school->id, $program->id ] ) }}">All Papers</a>
        </li>

        <li class="{{ ( Route::currentRouteName() == 'admin.papers.archived' ) ? 'is-active' : '' }}">
            <a href="{{ route( 'admin.papers.archived', [ $school->id, $program->id ] ) }}">Archived</a>
        </li>

        <li class="{{ ( Route::currentRouteName() == 'admin.papers.create' ) ? 'is-active' : '' }}">
            <a href="{{ route( 'admin.papers.create', [ $school->id, $program->id ] ) }}">
                <span class="icon is-small">
                  <i class="fa fa-plus"></i>
                </span>
                <span>Create</span>
            </a>
        </li>

    </ul>
</div>