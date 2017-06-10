<contacts-table
        class="notification content"
        :program-id="{{ $program->id }}"
        inline-template
        v-cloak>
    <div>
        <p>
            <strong>Contacts</strong>
            <a class="button is-small is-pulled-right create-button"
                @click="newContact()">
            <span class="icon is-small"><i class="fa fa-plus"></i></span>
            <span>Create</span>
            </a>
        </p>

        <table class="table" v-if="contacts.length > 0" v-cloak>

            <thead>
            <tr>
                <th>First</th>
                <th>Last</th>
                <th>Phone</th>
                <th>Email</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="contact in contacts">
                <td>@{{ contact.first_name }}</td>
                <td>@{{ contact.last_name }}</td>
                <td>@{{ contact.phone }}</td>
                <td>@{{ contact.email }}</td>
                <td style="width: 85px;">
                    <a class="button is-small edit-button" @click="editContact(contact)">
                        <span class="icon is-small">
                          <i class="fa fa-edit"></i>
                        </span>
                    </a>
                    <a class="button is-small delete-button" @click="destroyContact(contact)">
                        <span class="icon is-small">
                          <i class="fa fa-trash"></i>
                        </span>
                    </a>
                </td>
            </tr>
            </tbody>

        </table>

        <p v-if="contacts.length == 0" v-cloak>There are no contacts - <a @click="newContact()">add one</a> now.</p>

    </div>
</contacts-table>

<contacts-form
        :program-id="{{ $program->id }}"
        inline-template
        v-cloak>
    <div>
        <div :class="{ modal: true, 'is-active': isVisible }">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Contacts</p>
                </header>
                <section class="modal-card-body">

                    @include( 'admin.programs.partials.form.contacts.fields' )

                </section>
                <footer class="modal-card-foot">
                    <a class="button is-success" :class="{ 'is-loading': isLoading }" @click="saveContact()">Save changes</a>
                    <a class="button cancel-button" @click="cancel()">Cancel</a>
                </footer>
            </div>
            <button type="button" class="modal-close" @click="cancel()"></button>
        </div>
    </div>
</contacts-form>