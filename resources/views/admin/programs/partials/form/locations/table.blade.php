<locations-table
        class="notification content"
        :program-id="{{ $program->id }}"
        inline-template
        v-cloak>
    <div>
        <p>
            <strong>Locations</strong>
            <a class="button is-small is-pulled-right create-button"
            @click="newLocation()">
            <span class="icon is-small"><i class="fa fa-plus"></i></span>
            <span>Create</span>
            </a>
        </p>

        <table class="table" v-if="locations.length > 0" v-cloak>

            <thead>
            <tr>
                <th>Address</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="location in locations">
                <td>@{{ location.address }}</td>
                <td>@{{ location.start_date }}</td>
                <td>@{{ location.end_date }}</td>
                <td style="width: 85px;">
                    <a class="button is-small edit-button" @click="editLocation(location)">
                            <span class="icon is-small">
                              <i class="fa fa-edit"></i>
                            </span>
                    </a>
                    <a class="button is-small delete-button" @click="destroyLocation(location)">
                            <span class="icon is-small">
                              <i class="fa fa-trash"></i>
                            </span>
                    </a>
                </td>
            </tr>
            </tbody>

        </table>

        <p v-if="locations.length == 0" v-cloak>There are no locations - <a @click="newLocation()">add one</a> now.</p>

    </div>
</locations-table>

<locations-form
        :program-id="{{ $program->id }}"
        inline-template
        v-cloak>
    <div class="location-container">
        <div :class="{ modal: true, 'location-modal': true, 'is-active': isVisible }">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Locations</p>
                </header>
                <section class="modal-card-body">

                    <div class="columns">

                        <div class="column column-map">

                            <femr-map></femr-map>

                        </div>

                        <div class="column">

                            @include( 'admin.programs.partials.form.locations.fields' )

                        </div>

                    </div>

                </section>
                <footer class="modal-card-foot">
                    <a class="button is-success" :class="{ 'is-loading': isLoading }" @click="saveLocation()">Save changes</a>
                    <a class="button cancel-button" @click="cancel()">Cancel</a>
                </footer>
            </div>
            <button type="button" class="modal-close" @click="cancel()"></button>
        </div>
    </div>
</locations-form>