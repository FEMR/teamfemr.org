<template>
    <div class="field">

        <label class="label" v-if="showLabel">{{ def.label }}</label>

        <div class="control has-icons-right">

            <div :class="{ select: true, 'is-fullwidth': def.isFullWidth, 'is-success': isSuccess, 'is-danger': isError }">
                <multiselect
                    :value="value"
                    :name="def.name"
                    :multiple="multiple"
                    :taggable="true"
                    @tag="addTag"
                    tag-placeholder="Add this as new item"
                    placeholder="Type to search or add new"
                    label="label"
                    track-by="value"
                    :data-vv-as="def.label"
                    v-validate="def.validators"
                    @input="updateValue"
                    :options="localOptions"
                >
                    <!--<option v-if="def.placeholder.length > 0" value="" disabled>{{ def.placeholder }}</option>-->
                    <!--<option v-for="( option, value ) in def.options" :value="value">{{ option }}</option>-->
                </multiselect>
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
    import Multiselect from 'vue-multiselect'

    export default {

        props: {

            "def": {

                type: FormField,
                default: () => new FormField()
            },
            "value": {

                required: true
            },
            "multiple": {

                type: Boolean,
                default: () => true
            },
            "showLabel": {

                type: Boolean,
                default: () => true
            }
        },

        components:{

            Multiselect
        },

        data() {

            return {

                localValue: [],
                localOptions: []
            }
        },

        methods: {

            addTag ( newTag ) {

                const tag = {

                    label: newTag,
                    slug: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
                }

                this.localOptions.push( tag );
                this.value.push( tag );
            },

            updateValue: function ( value ) {

                // cleanse/format value here if needed
                this.$emit( 'input', value );
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

        created() {

            this.localOptions = this.def.options;
        }
    }

</script>

<style scoped>


</style>