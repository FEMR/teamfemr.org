<template>
    <section class="section survey-partners">
        <div class="container">
            <h3 class="title">NGO/Partner organizations</h3>
            <hr />

            <div class="columns partner-row partner-headers">

                <div class="column" v-for="field in def">
                    <label class="label">{{ field.label }}</label>
                </div>

                <div class="column button-column">

                </div>
            </div>

            <div class="columns partner-row" v-for="(partner, idx) in partners" :key="partner.id">

                <div class="column">

                    <text-field
                            v-model="partner.name"
                            :def="def.name"
                            :initialValue="partner.name"
                    ></text-field>
                </div>

                <!--<div class="column">-->
                <!--<text-def :def="{ name: 'last name', label: 'Last Name', validators: '', icon: 'fa-user' }"></text-def>-->
                <!--</div>-->

                <div class="column">
                    <text-field
                            v-model="partner.url"
                            :def="def.url"
                            :initialValue="partner.url"
                    ></text-field>
                </div>


                <div class="column button-column">

                    <a href="#"  class="delete-button" @click.prevent="deletePartner( idx )">
                        <span class="icon is-small is-danger">
                          <i class="fa fa-minus-circle"></i>
                        </span>
                    </a>

                </div>

            </div>

            <a href="#" class="button is-primary" @click.prevent="addEmptyPartner()">Add Partner</a>
        </div>
    </section>
</template>


<script type="text/babel">

    import Partner from '../../models/Partner';

    export default {

        model: {

            prop: 'partners',
            event: 'input'
        },

        props: {

            "partners": {

                default: function () { return []; }
            },

            "def": {

                default: function () { return []; }
            }
        },

        data() {

            return {

                count: 0
            }
        },

        watch: {

            partners: function( newPartners ) {

                this.$emit( 'input', newPartners );
            }
        },

        methods: {

            validate() {


            },

            addEmptyPartner(){

                let partner = new Partner();

                // TODO -- how to handle this with create vs update
                // this.count is necessary to give each row a unique id or vue will
                //   reuse them and potentially leave behind validation errors
                partner.id = ++this.count;
                this.partners.push( partner );
            },

            deletePartner( indexToDelete ) {

                Vue.delete( this.partners, indexToDelete );

                if( this.partners.length === 0 ) this.addEmptyPartner();
            }
        },

        created(){

            // add a blank partner
            this.count = this.partners.length;
            this.addEmptyPartner();
        }
    }

</script>

<style lang="scss" scopeds>

    .partner-row {

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

    .partner-headers{

        .column{

            padding: 0.5rem 0.75rem 0;
            margin-bottom: -0.5rem;
        }
    }

</style>