class Partner{

    constructor() {

        this.uniqueId = _.uniqueId();;
        this.selectedPartner = '';

        this.id = '';
        this.name = '';
        this.slug ='';
        this.website = '';
    }

    populate( json ) {

        this.selectedPartner = '';

        this.id = json.id;
        this.name = json.name;
        this.slug = json.slug;
        this.website = json.website;
    }

    post() {

        return {

            "id": this.id,
            "name": this.name,
            "slug": this.slug,
            "website": this.website,
        }
    }

    store() {

        return {

            "id": this.id,
            "name": this.name,
            "slug": this.slug,
            "website": this.website,
        }
    }


    isUpdate() {

        return _.isInteger( this.id ) || this.name.length > 0;
    }
}

export default Partner;