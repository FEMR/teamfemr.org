<partners-table
        class="notification content"
        :program-id="{{ $program->id }}"
        inline-template
        v-cloak>
    <div>
        <p>
            <strong>Partners</strong>
            <a class="button is-small is-pulled-right create-button"
            @click="newPartner()">
            <span class="icon is-small"><i class="fa fa-plus"></i></span>
            <span>Create</span>
            </a>
        </p>

        <table class="table" v-if="partners.length > 0" v-cloak>

            <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Website</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="partner in partners">
                <td>@{{ partner.name }}</td>
                <td>@{{ partner.slug  }}</td>
                <td>@{{ partner.website }}</td>
                <td style="width: 85px;">
                    <a class="button is-small edit-button" @click="editPartner(partner)">
                    <span class="icon is-small">
                              <i class="fa fa-edit"></i>
                            </span>
                    </a>
                    <a class="button is-small delete-button" @click="destroyPartner(partner)">
                    <span class="icon is-small">
                              <i class="fa fa-trash"></i>
                            </span>
                    </a>
                </td>
            </tr>
            </tbody>

        </table>

        <p v-if="partners.length == 0" v-cloak>There are no partners - <a @click="newPartner()">add one</a> now.</p>

    </div>
</partners-table>

<partners-form
        :program-id="{{ $program->id }}"
        inline-template
        v-cloak>
    <div>
        <div :class="{ modal: true, 'is-active': isVisible }">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Partners</p>
                </header>
                <section class="modal-card-body">

                    @include( 'admin.programs.partials.form.partners.fields' )

                </section>
                <footer class="modal-card-foot">
                    <a class="button is-success" :class="{ 'is-loading': isLoading }" @click="savePartner()">Save changes</a>
                    <a class="button cancel-button" @click="cancel()">Cancel</a>
                </footer>
            </div>
            <button type="button" class="modal-close" @click="cancel()"></button>
        </div>
    </div>
</partners-form>