<!-- Maybe fully implement this at some point? -->

<template>

    <div class="login-box">

        <!--<h3 class="title">Register</h3>-->
        <!--<hr>-->

        <div class="content">

            <div class="field">
                <label class="label">Name</label>
                <p class="control">
                    <input name="name" class="input" type="text" required>
                </p>
            </div>

            <div class="field">
                <label class="label">E-mail</label>
                <p class="control">
                    <input name="email" class="input" type="text" required>
                </p>
            </div>

            <div class="field">
                <label class="label">Password</label>
                <p class="control">
                    <input name="password" class="input" type="password" required>
                </p>
            </div>
            <!--@include('auth.components.form-errors', ['field' => 'password', 'type' => 'horizontal'])-->

            <div class="field">
                <label class="label">Confirm password</label>
                <p class="control">
                    <input name="password_confirmation" class="input" type="password" required>
                </p>
            </div>
            <!--@include('auth.components.form-errors', ['field' => 'password-confirm', 'type' => 'horizontal'])-->

            <div class="field is-grouped button-container">
                <!--<p class="control">-->
                    <!--<button class="button is-primary">Register</button>-->
                <!--</p>-->

                <p class="control is-expanded forgot-password">
                    <a href="/login">
                        Already have an account?
                    </a>
                </p>

            </div>

        </div>
    </div>

</template>

<script type="text/babel">


    export default {

        data() {

            return {

            }
        },

        computed: {


        },

        methods: {


        }
    }

</script>

<style scoped>


</style>