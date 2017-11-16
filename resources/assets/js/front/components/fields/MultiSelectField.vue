<template>
    <div class="field">

        <label class="label" v-if="showLabel">{{ def.label }}</label>

        <div class="control has-icons-right">

            <div :class="{ 'is-fullwidth': def.isFullWidth, 'is-success': isSuccess, 'is-danger': isError }">

                <v-select
                    v-model="localValue"
                    :name="def.name"
                    :multiple="multiple"
                    :taggable="taggable"
                    @tag="addTag"
                    tag-placeholder="Add this as new item"
                    placeholder="Type to search or add new"
                    :label="label"
                    :track-by="trackBy"
                    :data-vv-as="def.label"
                    v-validate="def.validators"
                    @input="updateValue"
                    :options="localOptions"
                >
                    <!--<option v-if="def.placeholder.length > 0" value="" disabled>{{ def.placeholder }}</option>-->
                    <!--<option v-for="( option, value ) in def.options" :value="value">{{ option }}</option>-->
                </v-select>
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
    import vSelect from "vue-select"

    export default {

        props: {

            "def": {

                type: FormField,
                default: () => new FormField()
            },
            "value": {},
            "index": {},
            "multiple": {

                type: Boolean,
                default: () => true
            },
            "taggable": {

                type: Boolean,
                default: () => false
            },
            "label": {

                default: "label"
            },
            "trackBy": {

                default: 'value'
            },
            "showLabel": {

                type: Boolean,
                default: () => true
            }
        },

        components:{

            vSelect
        },

        watch: {

            value: {

                handler: function( newValue ) {

                    console.log( "New Value" );
                    console.log( newValue );

                    this.localValue = newValue;
                },
                deep: true
            }
        },

        data() {

            return {

                localValue: '',
                localOptions: []
            }
        },

        methods: {

            addTag ( newTag ) {

                const tag = {

                    id: _.uniqueId(),
                    value: _.slugify( newTag ) + Math.floor((Math.random() * 10000000)),
                    label: newTag,
                    name: newTag,
                    slug: _.slugify( newTag )
                };

                this.localOptions.push( tag );
                this.localValue = tag;

                this.$emit( 'valueAdded', { index: this.index, name: this.def.name, value: tag } )
            },

            updateValue: function ( value ) {

                console.log( value );

                // cleanse/format value here if needed
                this.$emit( 'input', value );
                this.$emit( 'valueChanged', { index: this.index, name: this.def.name, value: value } )
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

                return this.valueHasChanged && _.toLength( this.localValue ) > 0 &&! this.errors.has( this.def.name );
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

    .is-fullwidth,
    .v-select{

        width: 100%;
    }

</style>