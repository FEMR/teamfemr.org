class Partner{

    constructor() {

        this.uniqueId = _.uniqueId();;

        this.id = '';
        this.name = '';
        this.slug ='';
        this.url = '';
    }

    populate( json ) {

        this.id = json.id;
        this.name = json.name;
        this.slug = json.slug;
        this.website = json.website;
    }
}

export default Partner;