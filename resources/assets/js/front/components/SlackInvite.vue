<template>
    <div class="slack-invite">

        <div class="invite-form">

            <div class="instructions" :show="!isSuccessful">

                <h3 class="title">Join our Slack</h3>

                <p class="subtitle">for real-time converstaion with Team fEMR</p>

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
                        <input :class="{ input: true, 'is-danger': errors.has('email') }" type="text" placeholder="" v-model="email" />
                    </p>
                    <p class="help is-danger" v-if="errors.has('email')">{{ errors.get('email') }}</p>
                </div>

                <!--<div class="columns">-->
                    <!--<div class="column">-->

                        <!--<div class="field">-->
                            <!--<label class="label">First Name</label>-->
                            <!--<p class="control">-->
                                <!--<input class="input" type="text" placeholder="Optional" v-model="first_name" />-->
                            <!--</p>-->
                            <!--<p class="help is-danger" v-if="errors.has('first_name')">{{ errors.get('first_name') }}</p>-->
                        <!--</div>-->

                    <!--</div>-->

                    <!--<div class="column">-->

                        <!--<div class="field">-->
                            <!--<label class="label">Last Name</label>-->
                            <!--<p class="control">-->
                                <!--<input class="input" type="text" placeholder="Optional" v-model="last_name" />-->
                            <!--</p>-->
                            <!--<p class="help is-danger" v-if="errors.has('last_name')">{{ errors.get('last_name') }}</p>-->
                        <!--</div>-->

                    <!--</div>-->
                <!--</div>-->

                <div class="field is-grouped">
                    <p class="control submit-button">
                        <button :class="{ button: true, 'femr-button': true, 'is-loading': isLoading  }">Invite Me</button>
                    </p>
                </div>

            </form>
        </div>

    </div>
</template>

<script type="text/babel">

    import Errors from "../../shared/errors";

    export default {

        props: [ 'link' ],
        data() {

            return {

                isLoading: false,
                isSuccessful: false,
                $errors: new Errors(),

                email: '',
                first_name: '',
                last_name: ''
            }
        },
        methods: {


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

                    })
                    .catch( ( errors ) => {

                        this.$errors.record( errors.response.data );
                        this.isSuccessful = false;
                        this.isLoading = false;
                    });
            }
        }
    }

</script>

<style scoped>

    .slack-invite{

        background-color: #444444;
    }

    .slack-invite .instructions{

        text-align: center;
        text-transform: uppercase;
        margin: 0 auto 2rem;
    }

    .slack-invite .instructions .title{

        font-size: 1.4rem;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 0.5rem;
        text-transform: none;
    }

    .slack-invite .instructions .subtitle{

        margin-top: 0;
        margin-bottom: 0;
        font-size: 0.8rem;
        color: #ffffff;
        text-transform: none;
    }

    .slack-invite .success{

        font-size: .9rem;
    }

    .slack-invite .success .notification{

        padding: .75rem 2rem .75rem 1rem;
    }

    .slack-invite .invite-form{

        text-align: left;
    }

    .slack-invite .invite-form label{

        font-size: 0.9rem;
        text-transform: uppercase;
        color: #ffffff;
    }

    .slack-invite .invite-form .control{

        margin-bottom: 1.25rem;
    }

    .slack-invite .invite-form .input{

        height: 1.75rem;
        background-color: transparent;
        border: 0;
        border-radius: 0;
        box-shadow: none;
        border-bottom: 1px solid #7f7f7f;
        padding-left: 0;
        padding-right: 0;
        color: #cfcfcf;
    }

    .slack-invite .invite-form .submit-button{

        margin: 1rem auto;
    }

    .slack-invite .invite-form .submit-button .button{

        padding: .75rem 2.5rem;
        height: auto;
        font-size: .9rem;
    }

    .slack-invite .invite-form .submit-button .button:hover{

        color: #ffffff;
    }

    .slack-invite .invite-form p.help{

        margin-top: -1rem;
        margin-bottom: 0;
    }

</style>