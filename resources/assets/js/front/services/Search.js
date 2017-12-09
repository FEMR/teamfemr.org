import FormField from '../models/FormField';

class Search {

    // TODO - move this to an api call? use caching?
    static form() {

        return {

            searchText: new FormField({

                hideLabel: true,
                icon: "",
                isFullWidth: false,
                label: "Search Text",
                name: "search_text",
                options: [],
                placeholder: "Enter search text",
                type: "text",
                validators: "",
                noValidation: true,
                value: ""
            }),

            location: new FormField({

                hideLabel: false,
                icon: "",
                isFullWidth: false,
                label: "Search by Location",
                name: "location",
                options: [],
                placeholder: "",
                type: "autocomplete",
                validators: "required",
                value: ""
            }),

            months: new FormField({

                hideLabel: false,
                icon: "",
                isFullWidth: false,
                label: "Months",
                name: "months",
                options: [],
                placeholder: "",
                type: "select",
                validators: "required",
                value: ""
            }),

            classes: new FormField({

                hideLabel: false,
                icon: "",
                isFullWidth: false,
                label: "Classes",
                name: "classes",
                options: [],
                placeholder: "",
                type: "select",
                validators: "required",
                value: ""
            }),

            partners: new FormField({

                hideLabel: false,
                icon: "",
                isFullWidth: false,
                label: "Partners",
                name: "partners",
                options: [],
                placeholder: "",
                type: "select",
                validators: "required",
                value: ""
            }),

            sortBy: new FormField({

                hideLabel: false,
                icon: "",
                isFullWidth: false,
                label: "Sort By",
                name: "sortBy",
                options: {

                    "default": "",
                    "name": "Name",
                    "location": "Location"
                },
                placeholder: "",
                type: "select",
                validators: "required",
                value: ""
            })
        }
    }

}

export default Search;