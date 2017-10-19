<template>
    <section class="section survey-partners">
        <div class="container">
            <h3 class="title">NGO/Partner organizations</h3>
            <hr />

            <div class="columns section-row partner-row partner-headers">

                <div class="column" v-for="field in def">
                    <label class="label">{{ field.label }}</label>
                </div>

                <div class="column button-column">

                </div>
            </div>

            <div class="columns section-row partner-row" v-for="(partner, idx) in partners" :key="partner.uniqueId">

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



</style>