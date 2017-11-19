<p class="menu-label">
    General
</p>

<ul class="menu-list">
    <li>
        <a href="{{ route( 'admin.dashboard.index' ) }}" class="item {{ str_contains( Route::currentRouteName(),'admin.dashboard' ) ? 'is-active' : '' }}">
            Dashboard
        </a>
    </li>
    <li>
        <a href="{{ route( 'admin.programs.index' ) }}" class="item {{ str_contains( Route::currentRouteName(), 'admin.programs' ) ? 'is-active' : '' }}">
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
    <li><a>Publications</a></li>
</ul>