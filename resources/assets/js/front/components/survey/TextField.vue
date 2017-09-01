<template>
    <div class="field">

        <label class="label">{{ label }}</label>

        <div class="control has-icons-right">

            <input
                v-model="value"
                :class="{ 'input': true, 'is-success': isSuccess, 'is-danger': isError }"
                type="text"
                :placeholder="placeholder"
                @change="validate()"
            >

            <span :class="{ 'icon': true, 'is-small': true, 'is-right': true, 'is-success': isSuccess, 'is-danger': isError }">
              <i :class="{ 'fa': true, 'fa-check': isSuccess, 'fa-warning': isError }"></i>
            </span>

        </div>

        <p :class="{ 'help': true, 'is-success': isSuccess, 'is-danger': isError }" v-if="shouldShowMessage">{{ message }}</p>

    </div>
</template>

<script type="text/babel">

    export default {

        props: [ "field" ],

        data() {

            return {

                label: '',
                value: '',
                placeholder: '',
                isSuccess: false,
                isError: false,
                message: '',
                validators: []
            }
        },

        methods: {

            validate() {

                this.$emit( 'valueChanged', this.field.id, this.value)
            }
        },

        computed: {

            shouldShowMessage() {

                return ( this.isSuccess || this.isError ) && this.message.length > 0
            }
        },

        created(){

            this.label = this.field.label;
        }
    }

</script>

<style scoped>



</style>