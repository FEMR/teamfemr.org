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

    post() {

        return {

            "id": this.id,
            "title": this.title,
            "url": this.url,
            "description": this.description,
        }
    }

    store() {

        return {

            "id": this.id,
            "title": this.title,
            "url": this.url,
            "description": this.description,
        }
    }
}

export default Paper;