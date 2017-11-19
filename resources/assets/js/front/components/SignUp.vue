<!-- Maybe fully implement this at some point? -->

<template>
    <div class="login-box">
        <div class="container">

            <h3 class="title">Login</h3>
            <hr />

            <div class="content">

                <div class="field">
                    <label class="label">Email</label>
                    <p class="control">
                        <input name="email" class="input" type="email" required>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Password</label>
                    <p class="control">
                        <input name="password" class="input" type="password" required>
                    </p>
                </div>

                <div class="field is-grouped button-container">

                    <p class="control is-expanded forgot-password">
                        <a href="#">
                            Forgot password
                        </a>
                        <span class="sep">|</span>
                        <a href="#">
                            Register
                        </a>
                    </p>

                </div>

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