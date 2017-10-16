class Contact{

    constructor() {

        this.uniqueId = _.uniqueId();;
        this.id = '';
        this.full_name = '';
        this.phone = '';
        this.email = '';
    }

     populate( json ) {

         this.id = json.id;

         if( json.full_name.length > 0 ) {

             this.full_name = json.full_name;
         }
         else {

             this.full_name = json.first_name + ' ' + json.last_name;
         }

         this.phone = json.phone;
         this.email = json.email;
     }
}

export default Contact;