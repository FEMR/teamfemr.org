<template>
    <section class="section survey-papers">
        <div class="container">
            <h3 class="title">Papers</h3>
            <hr />

            <div class="columns section-row paper-row paper-headers desktop-only">

                <div class="column" v-for="field in def">
                    <label class="label">{{ field.label }}</label>
                </div>

                <div class="column button-column">

                </div>
            </div>

            <div class="columns section-row paper-row" v-for="(paper, idx) in papers" :key="paper.uniqueId">

                <div class="column">

                    <label class="label mobile-only">{{ def.title.label }}</label>
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

                    <label class="label mobile-only">{{ def.url.label }}</label>
                    <text-field
                        v-model="paper.url"
                        :def="def.url"
                        :initialValue="paper.url"
                    ></text-field>

                </div>

                <div class="column">


                    <label class="label mobile-only">{{ def.description.label }}</label>
                    <text-field
                        v-model="paper.description"
                        :def="def.description"
                        :initialValue="paper.description"
                    ></text-field>

                </div>

                <div class="column button-column">

                    <a href="#"  class="delete-button desktop-only" @click.prevent="deletePaper( idx )">
                        <span class="icon is-small is-danger">
                          <i class="fa fa-minus-circle"></i>
                        </span>
                    </a>

                    <a href="#" class="button is-danger is-small delete-button mobile-only" @click.prevent="deletePaper( idx )">
                        <span class="icon is-small">
                          <i class="fa fa-minus"></i>
                        </span>
                        <span>Remove Paper</span>
                    </a>

                </div>

            </div>

            <a href="#" class="button is-primary is-small" @click.prevent="addEmptyPaper()">
                <span class="icon is-small">
                  <i class="fa fa-plus"></i>
                </span>
                <span>Add Paper</span>
            </a>
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

<style lang="scss" scoped>

    @media only screen and ( max-width: 767px ) {

        .survey-container .paper-row {

            margin-bottom: 35px;
        }
    }

    .survey-container .paper-headers{

        margin-bottom: 0;
    }

</style>