<template>
    <div class="slack-modal">

        <div class="invite-form" v-show="isVisible">

            <div class="instructions" :show="! isSuccessful">

                <h3>Slack Registration</h3>

                <p></p>

            </div>

            <div class="success" v-show="isSuccessful">
                <div class="notification is-success">
                    Invitation Sent!
                </div>
            </div>

            <form method="post" v-on:submit.prevent="submitForm">

                <div class="field">
                    <label class="label">Email Address</label>
                    <p class="control">
                        <input class="input" type="text" placeholder="" v-model="email" />
                    </p>
                    <p class="help is-danger" v-if="errors.has('email')">{{ errors.get('email') }}</p>
                </div>

                <div class="columns">
                    <div class="column">

                        <div class="field">
                            <label class="label">First Name</label>
                            <p class="control">
                                <input class="input" type="text" placeholder="Optional" v-model="first_name" />
                            </p>
                            <p class="help is-danger" v-if="errors.has('first_name')">{{ errors.get('first_name') }}</p>
                        </div>

                    </div>

                    <div class="column">

                        <div class="field">
                            <label class="label">Last Name</label>
                            <p class="control">
                                <input class="input" type="text" placeholder="Optional" v-model="last_name" />
                            </p>
                            <p class="help is-danger" v-if="errors.has('last_name')">{{ errors.get('last_name') }}</p>
                        </div>

                    </div>
                </div>

                <div class="field is-grouped">
                    <p class="control submit-button">
                        <button :class="{ button: true, 'is-primary': true, 'is-loading': isLoading  }">Send me an invite!</button>
                    </p>
                </div>

            </form>

        </div>

    </div>
</template>

<script type="text/babel">

    import Errors from "../shared/errors";

    export default {

        props: [ 'link' ],
        data() {

            return {

                isVisible: false,
                isLoading: false,
                isSuccessful: false,
                errors: new Errors(),

                email: '',
                first_name: '',
                last_name: ''
            }
        },
        methods: {

            showForm() {

                this.isLoading = false;
                this.isSuccessful = false;
                this.errors.clear();

                this.isVisible = true;
            },

            submitForm() {

                this.isLoading = true;

                axios.post('/api/slack/invite', {

                        email: this.email,
                        first_name: this.first_name,
                        last_name: this.last_name
                    })
                    .then( ( response ) => {

                        // TODO - expand upon this if there are errors
                        // Maybe message to send email requesting invite as a fallback?
                        //if( response.ok == true )

                        console.log(response);

                        this.email = '';
                        this.first_name = '';
                        this.last_name = '';

                        this.isSuccessful = true;
                        this.isLoading = false;

                        // Close window after 2 seconds
                        setTimeout( () => {

                            this.isVisible = false;

                        }, 2000 );
                    })
                    .catch( ( errors ) => {

                        this.errors.record( errors.response.data );
                        this.isSuccessful = false;
                        this.isLoading = false;
                    });
            }
        }
    }

</script>

<style scoped>

    .slack-modal{

        position: relative;
        width: 450px;
        margin: 15px auto;

        z-index: 1000;
        color: #333333;
    }

    .slack-modal .invite-form{

        position: absolute;
        top: 110%;
        left: 0;

        width: 100%;
        padding: 15px;

        background-color: #efefef;
        text-align: left;
    }

    .slack-modal .invite-form .submit-button{

        margin: 0 auto;
    }

    .slack-modal .instructions{

        text-align: center;
        margin: 0 auto 10px;
    }


    .slack-modal .instructions p{

    }

    .slack-modal .instructions h3{

        font-size: 1.4em;
        font-weight: bold;
        color: #c30712;
    }

</style>