class Paper{

    constructor() {

        this.uniqueId = _.uniqueId();

        this.id = '';
        this.title = '';
        this.url = '';
        this.description = '';
    }

    populate( json ) {

        this.id = json.id;
        this.title = json.title;
        this.url = json.url;
        this.description = json.description;
    }
}

export default Paper;