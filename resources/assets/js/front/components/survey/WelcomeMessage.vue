<template>
    <div class="content">

        <template v-if="! isEdit">
            <p>Fill out this survey to list your program in our [directory?].</p>
        </template>
        <template v-else-if="isLoggedIn && ! isEdit">
            <p>You are logged in!</p>
            <p>After you submit the survey you will be able to come back and make edits later.</p>
        </template>
        <template v-else-if="isEdit">

            <p>You are editing a survey - try to distinguish between "just created" and edit</p>

        </template>
        <template v-else>
            <p><strong><a href="/login">Sign in</a></strong> or <strong><a href="/register">register</a></strong> before submitting the survey if you'd like to be able to make edits later.</p>
        </template>

    </div>
</template>

<script type="text/babel">

    import User from '../../services/User';

    export default {

        components: {},

        props: {
            'programId': {

                default: null
            }
        },

        data() {

            return {}
        },

        computed: {

            isEdit: function() {

                return Number.isInteger( this.programId );
            },

            isLoggedIn: function() {

                return User.isLoggedIn();
            }
        },

        methods: {},

        created() {

        }
    }

</script>

<style scoped>


</style>