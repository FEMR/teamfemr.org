<template>
    <section class="section survey-papers">
        <div class="container">
            <h3 class="title">Papers</h3>
            <hr />

            <div class="columns paper-row paper-headers">

                <div class="column" v-for="field in def">
                    <label class="label">{{ field.label }}</label>
                </div>

                <div class="column button-column">

                </div>
            </div>

            <div class="columns paper-row" v-for="(paper, idx) in papers" :key="paper.id">

                <div class="column">

                    <text-field
                        v-model="paper.title"
                        :def="def.title"
                        :initialValue="paper.title"
                    ></text-field>
                </div>

                <!--<div class="column">-->
                    <!--<text-def :def="{ name: 'last name', label: 'Last Name', validators: '', icon: 'fa-user' }"></text-def>-->
                <!--</div>-->

                <div class="column">
                    <text-field
                        v-model="paper.url"
                        :def="def.url"
                        :initialValue="paper.url"
                    ></text-field>
                </div>

                <div class="column">
                    <text-field
                        v-model="paper.description"
                        :def="def.description"
                        :initialValue="paper.description"
                    ></text-field>
                </div>

                <div class="column button-column">

                    <a href="#"  class="delete-button" @click.prevent="deletePaper( idx )">
                        <span class="icon is-small is-danger">
                          <i class="fa fa-minus-circle"></i>
                        </span>
                    </a>

                </div>

            </div>

            <a href="#" class="button is-primary" @click.prevent="addEmptyPaper()">Add Paper</a>
        </div>
    </section>
</template>


<script type="text/babel">

    import Paper from '../../models/Paper';

    export default {

        model: {

            prop: 'papers',
            event: 'input'
        },

        props: {

            "papers": {

                default: function () { return []; }
            },

            "def": {

                default: function () { return []; }
            },
        },

        data() {

            return {

                count: 0
            }
        },

        watch: {

            papers: function( newPapers ) {

                if( this.papers.length === 0 ) {

                    this.papers.push( new Paper() );
                }

                this.$emit( 'input', this.papers );
            }
        },

        methods: {

            validate() {


            },

            addEmptyPaper(){

                let paper = new Paper();

                // TODO -- how to handle this with create vs update
                // this.count is necessary to give each row a unique id or vue will
                //   reuse them and potentially leave behind validation errors
                paper.id = ++this.count;
                this.papers.push( paper );
            },

            deletePaper( indexToDelete ) {

                Vue.delete( this.papers, indexToDelete );

                if( this.papers.length === 0 ) this.addEmptyPaper();
            }
        },

        mounted(){

            // add a blank paper
            this.count = this.papers.length;
            this.addEmptyPaper();
        }
    }

</script>

<style lang="scss" scopeds>

    .paper-row {

        .button-column {

            width: 25px;
            flex: 0 auto;
        }

        .label{

            padding: 0;
            margin: 0;
        }

        .delete-button {

            display: block;
            margin: 5px 0;
        }

        .columns {

            .column {
                padding: 0.5rem 0.25rem;
            }
        }
    }

    .paper-headers{

        .column{

            padding: 0.5rem 0.75rem 0;
            margin-bottom: -0.5rem;
        }
    }

</style>