<p class="menu-label">
    General
</p>

<ul class="menu-list">
    <li>
        <a href="{{ route( 'admin.dashboard.index' ) }}" class="item {{ Route::currentRouteName() == 'admin.dashboard.index' ? 'is-active' : '' }}">
            Dashboard
        </a>
    </li>
    <li>
        <a href="{{ route( 'admin.schools.index' ) }}" class="item {{ str_contains( Route::currentRouteName(), 'admin.schools.' ) ? 'is-active' : '' }}">
            Schools
        </a>
    </li>
</ul>

<p class="menu-label">
    Administration
</p>
<ul class="menu-list">
    <li><a>These are not real links</a></li>
    <li>
        <a>Manage Your Team</a>
        <ul>
            <li><a>Link 1</a></li>
            <li><a>Link 2</a></li>
            <li><a>Link 3</a></li>
        </ul>
    </li>
</ul>