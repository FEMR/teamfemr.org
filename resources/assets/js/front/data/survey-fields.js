const fields = {

    program_name: {

        name: 'program_name',
        label: 'Program Name',
        validators: ''
    },
    school_name: {

        name: 'school_name',
        label: 'School Name',
        validators: ''
    },
    uses_emr: {

        name: 'uses_emr',
        label: 'Do you use an emr?',
        placeholder: 'Please select',
        validators: 'required',
        options: {

            yes: 'Yes',
            no: 'No'
        },
        isFullWidth: true
    },
    other_schools: {

        name: 'other_schools',
        label: 'Other participating professional schools',
        placeholder: 'Separate schools with commas',
        validators: ''
    },
    contacts: [

        {
            name: 'name',
            label: 'Name',
            value: '',
            hideLabel: true,
            validators: '',
            icon: 'fa-user'
        },
        {
            value: '',
            name: 'email',
            label: 'Email',
            hideLabel: true,
            validators: 'email',
            icon: 'fa-envelope-o'
        },
        {
            value: '',
            name: 'phone',
            label: 'Phone',
            hideLabel: true,
            validators: '',
            icon: 'fa-phone'
        }
    ]


};

const SurveyFields = {

    data: fields
};

export default SurveyFields;