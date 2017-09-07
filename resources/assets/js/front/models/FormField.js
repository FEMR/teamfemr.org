class FormField {

    constructor( formJson = {} ){

        let defaults = {

            name: '',
            label: '',
            value: '',
            icon: '',
            placeholder: '',
            validators: '',
            options: [],
            hideLabel: false,
            isFullWidth: false
        };

        Object.assign( this, defaults, formJson );

    }
}

export default FormField;