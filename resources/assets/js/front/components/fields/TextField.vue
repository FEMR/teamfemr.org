<template>
    <div class="field">

        <label class="label" v-if="! def.hideLabel">{{ def.label }}</label>

        <div :class="{ control: true, 'has-icons-right': hasRightIcon, 'has-icons-left': hasLeftIcon }">

            <input
                :value="value"
                :name="def.name"
                :data-vv-as="def.label"
                v-validate.initial="def.validators"
                :class="{ 'input': true, 'is-success': isSuccess, 'is-danger': isError }"
                type="text"
                :readonly="readonly"
                :placeholder="def.placeholder"
                v-on:input="updateValue($event.target.value)"
            >

            <span v-if="hasLeftIcon" :class="{ 'icon': true, 'is-small': true, 'is-left': true }">
              <i :class="iconClasses"></i>
            </span>

            <span v-if="hasRightIcon" :class="{ 'icon': true, 'is-small': true, 'is-right': true, 'is-success': isSuccess, 'is-danger': isError }">
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

            def: {

                type: FormField,
                default: () => new FormField()
            },
            value: {

                type: String,
                default: '',
                required: true
            },
            readonly: {

                type: Boolean,
                default: false
            }

        },

        data() {

            return {

            }
        },

        methods: {

            updateValue: function (value) {

                // cleanse/format value here if needed

                this.$emit( 'input', value );
                this.$emit( 'valueChanged', this.def.name, value )
            }
        },

        computed: {

            iconClasses() {

                let classes = { 'fa': true };

                if( this.def.icon.length > 0 ) {

                    classes[ this.def.icon ] = true;
                }

                return classes;
            },

            hasLeftIcon() {

                return this.def.icon.length > 0;
            },

            hasRightIcon() {

                return this.isError || this.isSuccess;
            },

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
        }

    }

</script>

<style scoped>



</style>