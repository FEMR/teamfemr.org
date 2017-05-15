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
    <li>
        <a href="{{ route( 'admin.programs.all' ) }}" class="item {{ str_contains( Route::currentRouteName(), 'admin.programs.all' ) ? 'is-active' : '' }}">
            Outreach Programs
        </a>
    </li>
</ul>

<p class="menu-label">
    Administration
</p>
<ul class="menu-list">
    <li><a>Users</a></li>
    <li><a>Pages</a></li>
    <li><a>News</a></li>
</ul>