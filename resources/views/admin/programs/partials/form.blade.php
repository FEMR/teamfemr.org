@if( isset( $program ) )
    <div class="level">
        <div class="level-right">

            <div class="level-item">&nbsp;</div>

            <div class="level-item">
                <a class="button is-small" href="{{ route( 'admin.papers.index', [ $school->id, $program->id ]) }}">
                    <span class="icon is-small"><i class="fa fa-book"></i></span>
                    <span>Papers</span>
                </a>
            </div>

            <div class="level-item">
                <a class="button is-small" href="#">
                    <span class="icon is-small"><i class="fa fa-address-card-o"></i></span>
                    <span>Partner Organizations</span>
                </a>
            </div>

            <div class="level-item">
                <a class="button is-small" href="#">
                    <span class="icon is-small"><i class="fa fa-map-marker"></i></span>
                    <span>Visited Locations</span>
                </a>
            </div>

            <div class="level-item">
                <a class="button is-small" href="#">
                    <span class="icon is-small"><i class="fa fa-envelope-o"></i></span>
                    <span>Contacts</span>
                </a>
            </div>

        </div>
    </div>
@endif

<div class="columns">

    <div class="column is-half">

        <div class="notification ">
            @include( 'admin.programs.partials.form.base-fields' )
        </div>

    </div>

    <div class="column is-half">


        <div class="notification ">
            @include( 'admin.programs.partials.form.other-fields' )
        </div>

    </div>

</div>

