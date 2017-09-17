<template>
    <section class="section survey-contacts">
        <div class="container">
            <h3 class="title">Contacts</h3>
            <hr />

            <div class="columns contact-row contact-headers">

                <div class="column" v-for="field in def">
                    <label class="label">{{ field.label }}</label>
                </div>

                <div class="column button-column">

                </div>
            </div>

            <div class="columns contact-row" v-for="(contact, idx) in contacts" :key="contact.id">

                <div class="column">

                    <text-field
                        v-model="contact.name"
                        :def="def.name"
                        :initialValue="contact.name"
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

            <a href="#" class="button is-primary" @click.prevent="addEmptyContact()">Add Contact</a>
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

                this.$emit( 'input', newContacts );
            }
        },

        methods: {

            validate() {


            },

            addEmptyContact(){

                let contact = new Contact();

                // TODO -- how to handle this with create vs update
                // this.count is necessary to give each row a unique id or vue will
                //   reuse them and potentially leave behind validation errors
                contact.id = ++this.count;
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

<style lang="scss" scopeds>

    .contact-row {

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

    .contact-headers{

        .column{

            padding: 0.5rem 0.75rem 0;
            margin-bottom: -0.5rem;
        }
    }

</style>