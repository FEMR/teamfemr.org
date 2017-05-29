<papers-table
        class="notification content"
        :program-id="{{ $program->id }}"
        inline-template
        v-cloak>
    <div>
        <p>
            <strong>Papers</strong>
            <a class="button is-small is-pulled-right create-button"
                @click="newPaper()">
                <span class="icon is-small"><i class="fa fa-plus"></i></span>
                <span>Create</span>
            </a>
        </p>

        <table class="table" v-if="papers.length > 0" v-cloak>

            <thead>
                <tr>
                    <th>Title</th>
                    <th>Url</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="paper in papers">
                    <td>@{{ paper.title }}</td>
                    <td>@{{ paper.url }}</td>
                    <td>@{{ paper.description }}</td>
                    <td style="width: 85px;">
                        <a class="button is-small edit-button" @click="editPaper(paper)">
                            <span class="icon is-small">
                              <i class="fa fa-edit"></i>
                            </span>
                        </a>
                        <a class="button is-small delete-button" @click="destroyPaper(paper)">
                            <span class="icon is-small">
                              <i class="fa fa-trash"></i>
                            </span>
                        </a>
                    </td>
                </tr>
            </tbody>

        </table>

        <p v-if="papers.length == 0" v-cloak>There are no papers - <a @click="newPaper()">add one</a> now.</p>

    </div>
</papers-table>

<papers-form
        :program-id="{{ $program->id }}"
        inline-template
        v-cloak>
    <div>
        <div :class="{ modal: true, 'is-active': isVisible }">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Papers</p>
                </header>
                <section class="modal-card-body">

                    @include( 'admin.programs.partials.form.papers.fields' )

                </section>
                <footer class="modal-card-foot">
                    <a class="button is-success" :class="{ 'is-loading': isLoading }" @click="savePaper()">Save changes</a>
                    <a class="button cancel-button" @click="cancel()">Cancel</a>
                </footer>
            </div>
            <button type="button" class="modal-close" @click="cancel()"></button>
        </div>
    </div>
</papers-form>