<dropdown-menu v-cloak>

    <menu-item
            link="{{ route( 'admin.schools.edit', [ $school->id ] ) }}"
        >
        <span class="icon"><i class="fa fa-pencil-square-o"></i></span> Edit
    </menu-item>

    <menu-item
            link="{{ route( 'admin.programs.index', [ $school->id ] ) }}"
        >
        <span class="icon"><i class="fa fa-medkit"></i></span> Outreach Programs
    </menu-item>

    <menu-item
            link="#"
    >
        <span class="icon"><i class="fa fa-address-card-o"></i></span> Contacts
    </menu-item>

    <menu-form
            method="delete"
            route="{{ route( 'admin.schools.destroy', $school->id ) }}"
            token="{{ csrf_token() }}"
        >
        <span class="icon"><i class="fa fa-trash"></i></span> Delete
    </menu-form>

</dropdown-menu>