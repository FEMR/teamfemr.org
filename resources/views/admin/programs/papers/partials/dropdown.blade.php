<dropdown-menu v-cloak>

    <menu-item
            link="{{ route( 'admin.papers.edit', [ $school->id, $program->id, $paper->id ] ) }}"
    >
        <span class="icon"><i class="fa fa-pencil-square-o"></i></span>
        <span>Edit</span>
    </menu-item>

    <menu-form
            method="delete"
            route="{{ route( 'admin.papers.destroy', [ $school->id, $program->id, $paper->id ] ) }}"
            token="{{ csrf_token() }}"
    >
        <span class="icon"><i class="fa fa-trash"></i></span>
        <span>Delete</span>
    </menu-form>

</dropdown-menu>

