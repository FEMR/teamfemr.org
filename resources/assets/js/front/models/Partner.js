class Partner{

    constructor() {

        this.uniqueId = _.uniqueId();;
        this.selectedPartner = '';

        this.id = '';
        this.name = '';
        this.slug ='';
        this.url = '';
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
            "name": _.isEmpty( this.name ) ? this.name : _.get( this.selectedPartner, "value" ),
            "slug": this.slug,
            "website": this.website,
        }
    }
}

export default Partner;