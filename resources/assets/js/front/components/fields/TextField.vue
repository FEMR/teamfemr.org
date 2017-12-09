<template>
    <div class="field">

        <label class="label" v-if="! def.hideLabel">{{ def.label }}</label>

        <div :class="{ control: true, 'has-icons-right': hasRightIcon, 'has-icons-left': hasLeftIcon, 'is-loading': isLoading }">

            <input
                ref="field"
                :value="value"
                :type="def.type"
                :name="def.name"
                :class="{ 'input': true, 'is-success': isSuccess, 'is-danger': isError }"
                :data-vv-as="def.label"
                v-validate.initial="def.validators"
                :readonly="readonly"
                :disabled="disabled"
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

            "def": {

                type: FormField,
                default: () => new FormField()
            },
            "value": {

                type: String,
                default: '',
                required: true
            },
            "readonly": {

                type: Boolean,
                default: false
            },
            "disabled": {

                type: Boolean,
                default: false
            },
            "isLoading": {

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

            hasNonEmptyValue(){

                return this.value !== undefined && this.value.length > 0;
            },

            isSuccess() {

                // TODO - figure out a better way to disable validation highlighting
                if( this.def.noValidation ) return false;

                return this.valueHasChanged && this.hasNonEmptyValue && ! this.errors.has( this.def.name );
            },

            isError() {

                // TODO - figure out a better way to disable validation highlighting
                if( this.def.noValidation ) return false;

                return this.valueHasChanged && this.errors.has( this.def.name );
            },

            message() {

                return ( this.errors.has( this.def.name ) ) ? this.errors.first( this.def.name ) : '';
            },

            shouldShowMessage() {

                return ( this.isSuccess || this.isError ) && this.message.length > 0
            }
        },

        created() {

            // Fires when parent triggers validateAll
            this.$parent.$on( 'validate', ( key ) => {

                if( key === this.def.name ) {

                    this.$validator.flag( this.def.name, {
                        touched: true,
                        dirty: true,
                        pristine: false
                    });
                }
            });
        }

    }

</script>

<style scoped>

    .input[disabled] {

        border-color: #cfcfcf;
    }


</style>