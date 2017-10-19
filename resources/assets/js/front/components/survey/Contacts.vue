<template>
    <section class="section survey-contacts">
        <div class="container">
            <h3 class="title">Contacts</h3>
            <hr />

            <div class="columns section-row contact-row contact-headers">

                <div class="column" v-for="field in def">
                    <label class="label">{{ field.label }}</label>
                </div>

                <div class="column button-column">

                </div>
            </div>

            <div class="columns section-row contact-row" v-for="(contact, idx) in contacts" :key="contact.uniqueId">

                <div class="column">

                    <text-field
                        v-model="contact.full_name"
                        :def="def.full_name"
                        :initialValue="contact.full_name"
                    ></text-field>
                </div>

                <!--<div class="column">-->
                    <!--<text-def :def="{ name: 'last name', label: 'Last Name', validators: '', icon: 'fa-user' }"></text-def>-->
                <!--</div>-->

                <div class="column">
                    <text-field
                        v-model="contact.email"
                        :def="def.email"
                        :initialValue="contact.email"
                    ></text-field>
                </div>

                <div class="column">
                    <text-field
                        v-model="contact.phone"
                        :def="def.phone"
                        :initialValue="contact.phone"
                    ></text-field>
                </div>

                <div class="column button-column">

                    <a href="#"  class="delete-button" @click.prevent="deleteContact( idx )">
                        <span class="icon is-small is-danger">
                          <i class="fa fa-minus-circle"></i>
                        </span>
                    </a>

                </div>

            </div>

            <a href="#" class="button is-primary is-small" @click.prevent="addEmptyContact()">
                <span class="icon is-small">
                  <i class="fa fa-plus"></i>
                </span>
                <span>Add Contact</span>
            </a>
        </div>
    </section>
</template>


<script type="text/babel">

    import Contact from '../../models/Contact';

    export default {

        model: {

            prop: 'contacts',
            event: 'input'
        },

        props: {

            "contacts": {

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

            contacts: function( newContacts ) {

                if( this.contacts.length === 0 ) {

                    this.contacts.push( new Contact() );
                }

                this.$emit( 'input', newContacts );
            }
        },

        methods: {

            validate() {


            },

            addEmptyContact(){

                let contact = new Contact();
                this.contacts.push( contact );
            },

            deleteContact( indexToDelete ) {

                Vue.delete( this.contacts, indexToDelete );

                if( this.contacts.length === 0 ) this.addEmptyContact();
            }
        },

        created(){


            // add a blank contact
            this.count = this.contacts.length;
            this.addEmptyContact();
        }
    }

</script>

<style lang="scss" scoped>


</style>