<dropdown-menu v-cloak>

    <menu-item
            link="{{ route( 'admin.programs.edit', [ $school->id, $program->id ] ) }}"
    >
        <span class="icon"><i class="fa fa-pencil-square-o"></i></span>
        <span>Edit</span>
    </menu-item>

    <menu-item
            link="#"
    >
        <span class="icon"><i class="fa fa-book"></i></span>
        <span>Papers</span>
    </menu-item>

    <menu-item
            link="#"
    >
        <span class="icon"><i class="fa fa-address-card-o"></i></span>
        <span>Partner Organizations</span>
    </menu-item>

    <menu-item
            link="#"
    >
        <span class="icon"><i class="fa fa-map-marker"></i></span>
        <span>Visited Locations</span>
    </menu-item>

    <menu-item
            link="#"
    >
        <span class="icon"><i class="fa fa-envelope-o"></i></span>
        <span>Contacts</span>
    </menu-item>

    <menu-form
            method="delete"
            route="{{ route( 'admin.programs.destroy', [ $school->id, $program->id ] ) }}"
            token="{{ csrf_token() }}"
    >
        <span class="icon"><i class="fa fa-trash"></i></span>
        <span>Delete</span>
    </menu-form>

</dropdown-menu>

