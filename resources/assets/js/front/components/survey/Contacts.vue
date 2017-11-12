<template>
    <section class="section survey-contacts">
        <div class="container">
            <h3 class="title">Contacts</h3>
            <hr />

            <div class="columns section-row contact-row contact-headers desktop-only">

                <div class="column" v-for="field in def">
                    <label class="label">{{ field.label }}</label>
                </div>

                <div class="column button-column">

                </div>
            </div>

            <div class="columns section-row contact-row" v-for="(contact, idx) in contacts" :key="contact.uniqueId">

                <div class="column">

                    <label class="label mobile-only">{{ def.fullName.label }}</label>
                    <text-field
                        v-model="contact.fullName"
                        :def="def.fullName"
                        :initialValue="contact.fullName"
                    ></text-field>

                </div>

                <!--<div class="column">-->
                    <!--<text-def :def="{ name: 'last name', label: 'Last Name', validators: '', icon: 'fa-user' }"></text-def>-->
                <!--</div>-->

                <div class="column">

                    <label class="label mobile-only">{{ def.email.label }}</label>
                    <text-field
                        v-model="contact.email"
                        :def="def.email"
                        :initialValue="contact.email"
                    ></text-field>
                </div>

                <div class="column">

                    <label class="label mobile-only">{{ def.phone.label }}</label>
                    <text-field
                        v-model="contact.phone"
                        :def="def.phone"
                        :initialValue="contact.phone"
                    ></text-field>

                </div>

                <div class="column button-column">

                    <a href="#" class="delete-button desktop-only" @click.prevent="deleteContact( idx )">
                        <span class="icon is-small is-danger">
                          <i class="fa fa-minus-circle"></i>
                        </span>
                    </a>

                    <a href="#" class="button is-danger is-small delete-button mobile-only" @click.prevent="deleteContact( idx )">
                        <span class="icon is-small">
                          <i class="fa fa-minus"></i>
                        </span>
                        <span>Remove Contact</span>
                    </a>

                </div>

            </div>

            <a href="#" class="button is-primary is-small add-button" @click.prevent="addEmptyContact()">
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

    .survey-container .contact-row{

        margin-bottom: 35px;
    }

    .survey-container .contact-headers{

        margin-bottom: 0;
    }

</style>