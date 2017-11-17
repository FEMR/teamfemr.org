<template>
    <section class="section survey-partners">
        <div class="container">
            <h3 class="title">NGO/In Country Partners</h3>
            <hr />

            <div class="columns section-row partner-row partner-headers desktop-only">

                <div class="column" v-for="field in def">
                    <label class="label">{{ field.label }}</label>
                </div>

                <div class="column button-column">

                </div>
            </div>

            <div class="columns section-row partner-row" v-for="(partner, idx) in partners" :key="partner.uniqueId">

                <div class="column">

                    <label class="label mobile-only">{{ def.name.label }}</label>

                    <multi-select-field
                        v-if="! partner.isUpdate()"
                        :index="idx"
                        :def="def.name"
                        :value="partner"
                        label="name"
                        :multiple="false"
                        :taggable="true"
                        :show-label="false"
                        v-on:valueChanged="partnerChanged"
                    ></multi-select-field>

                    <text-field
                        v-else
                        :def="def.name"
                        :value="partner.name"
                        :initialValue="partner.name"
                        :disabled="partner.isUpdate()"
                    ></text-field>

                </div>

                <div class="column">

                    <label class="label mobile-only">{{ def.website.label }}</label>
                    <text-field
                        v-model="partner.website"
                        :def="def.website"
                        :initialValue="partner.website"
                        :disabled="partner.isUpdate()"
                    ></text-field>

                </div>

                <div class="column button-column">

                    <a href="#"  class="delete-button desktop-only" @click.prevent="deletePartner( idx )">
                        <span class="icon is-small is-danger">
                          <i class="fa fa-minus-circle"></i>
                        </span>
                    </a>

                    <a href="#" class="button is-danger is-small delete-button mobile-only" @click.prevent="deletePartner( idx )">
                        <span class="icon is-small">
                          <i class="fa fa-minus"></i>
                        </span>
                        <span>Remove Partner</span>
                    </a>

                </div>

            </div>

            <a href="#" class="button is-primary is-small" @click.prevent="addEmptyPartner()">
                <span class="icon is-small">
                  <i class="fa fa-plus"></i>
                </span>
                <span>Add Partner</span>
            </a>
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

                if( this.partners.length === 0 ) {

                    this.partners.push( new Partner() );
                }

                this.$emit( 'input', newPartners );
            }
        },

        methods: {

            validate() {


            },

            addEmptyPartner(){

                let partner = new Partner();
                this.partners.push( partner );
            },

            deletePartner( indexToDelete ) {

                Vue.delete( this.partners, indexToDelete );

                if( this.partners.length === 0 ) this.addEmptyPartner();
            },

            partnerChanged( { index, name, value } ) {

                console.log( "partnerChanged" );
                console.log( index );
                console.log( name );
                console.log( value );

                let partner = this.partners[index];
                _.assign( partner, value );

                if( _.isInteger( partner.id ) ) {

                    this.website = value.website;
                }
                else {

                    partner.slug = _.slugify( partner.name );
                }
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

    @media only screen and ( max-width: 767px ) {

        .survey-container .partner-row {

            margin-bottom: 35px;
        }
    }

    .survey-container .partner-headers{

        margin-bottom: 0;
    }

</style>