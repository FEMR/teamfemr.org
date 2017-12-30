<template>
    <div class="field">

        <label class="label" v-if="showLabel">{{ def.label }}</label>

        <div class="control has-icons-right">

            <div :class="{ 'is-fullwidth': def.isFullWidth, 'is-success': isSuccess, 'is-danger': isError }">

                <v-select
                    :value="value"
                    :name="def.name"
                    :multiple="multiple"
                    :taggable="taggable"
                    :placeholder=" taggable ? 'Type to search or add new' : ''"
                    :label="label"
                    :data-vv-as="def.label"
                    v-validate="def.validators"
                    :options="localOptions"
                    :on-change="valueChanged"
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

        },

        data() {

            return {

                localValue: '',
                localOptions: []
            }
        },

        methods: {

            valueChanged: function ( value ) {

                this.localValue = value;

                // cleanse/format value here if needed
                this.$emit( 'input', this.localValue );
                this.$emit( 'valueChanged', { index: this.index, name: this.def.name, value: this.localValue } )
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
            this.localValue = this.value[ this.label ];

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