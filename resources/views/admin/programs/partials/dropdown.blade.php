<dropdown-menu v-cloak>

    <menu-item
        link="{{ route( 'admin.programs.edit', [ $program->id ] ) }}"
    >
        <span class="icon"><i class="fa fa-pencil-square-o"></i></span>
        <span>Edit</span>
    </menu-item>

    @if( $program->is_approved )
    <menu-form
        method="delete"
        route="{{ route( 'admin.programs.approve.destroy', [ $program->id ] ) }}"
        token="{{ csrf_token() }}"
    >
        <span class="icon"><i class="fa fa-thumbs-o-down"></i></span>
        <span>Unapprove</span>
    </menu-form>
    @else
    <menu-form
        method="post"
        route="{{ route( 'admin.programs.approve.store', [ $program->id ] ) }}"
        token="{{ csrf_token() }}"
    >
        <span class="icon"><i class="fa fa-thumbs-o-up"></i></span>
        <span>Approve</span>
    </menu-form>
@endif

    <menu-form
        method="delete"
        route="{{ route( 'admin.programs.destroy', [ $program->id ] ) }}"
        token="{{ csrf_token() }}"
    >
        <span class="icon"><i class="fa fa-trash"></i></span>
        <span>Delete</span>
    </menu-form>

</dropdown-menu>

