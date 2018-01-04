<template>
    <div class="content">

        <h1 class="title">Survey</h1>
        <p class="subtitle">International Medical Outreach Programs: Where Do We Go?</p>

        <p>Each year, teams from medical schools and other organizations organize medical relief trips to areas around the globe. Each program is at a different stage of development and vary in their organization. Additionally, a significant amount of resources are spent on these activities.</p>

        <p>This website is a forum for information and data sharing to work towards collaborating and discussing best practices. Completing this survey will add your program to our directory of international medical outreach programs.</p>

        <template v-if="!isLoggedIn">
            <hr>
            <p>Please <strong><a href="/login">Login</a></strong> or <strong><a href="/register">Register</a></strong> before starting the survey if you'd like to be able to make edits later.</p>
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