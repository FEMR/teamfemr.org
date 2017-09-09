<template>
    <div class="field">

        <label class="label">{{ def.label }}</label>

        <div class="control has-icons-right">

            <div :class="{ select: true, 'is-fullwidth': def.isFullWidth, 'is-success': isSuccess, 'is-danger': isError }">
                <select
                    :value="value"
                    :name="def.name"
                    :data-vv-as="def.label"
                    v-validate="def.validators"
                    v-on:input="updateValue($event.target.value)"
                >
                    <option v-if="def.placeholder.length > 0" value="" disabled>{{ def.placeholder }}</option>
                    <option v-for="( option, value ) in def.options" :value="value">{{ option }}</option>
                </select>
            </div>

            <span :class="{ 'icon': true, 'is-small': true, 'is-right': true, 'is-success': isSuccess, 'is-danger': isError }">
              <i :class="{ 'fa': true, 'fa-check': isSuccess, 'fa-warning': isError }"></i>
            </span>

        </div>

        <p :class="{ 'help': true, 'is-success': isSuccess, 'is-danger': isError }" v-if="shouldShowMessage">{{ message }}</p>

    </div>
</template>

<script type="text/babel">


    import FormField from '../../models/FormField';

    export default {

        props: {

            "def": {

                type: FormField,
                default: () => new FormField()
            },
            "value": {

                type: String,
                default: '',
                required: true
            }
        },

        data() {

            return {

                localValue: ''
            }
        },

        methods: {

            updateValue: function (value) {

                // cleanse/format value here if needed

                this.$emit('input', value );
                this.$emit( 'valueChanged', this.def.name, value )
            }
        },

        computed: {

            valueHasChanged() {

                if( _.has( this.fields, this.def.name ) ) {

                    return ! this.fields[ this.def.name ].pristine;
                }
                else return false;
            },

            isSuccess() {

                return this.valueHasChanged && ! this.errors.has( this.def.name );
            },

            isError() {

                return this.valueHasChanged && this.errors.has( this.def.name );
            },

            message() {

                return ( this.errors.has( this.def.name ) ) ? this.errors.first( this.def.name ) : '';
            },

            shouldShowMessage() {

                return ( this.isSuccess || this.isError ) && this.message.length > 0
            }
        },

        created(){

        }
    }

</script>

<style scoped>



</style>