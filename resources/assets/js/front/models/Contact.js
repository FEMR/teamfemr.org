class Contact{

    constructor() {

        this.uniqueId = _.uniqueId();
        this.id = '';
        this.fullName = '';
        this.phone = '';
        this.email = '';
    }

     populate( json ) {

         this.id = json.id;

         if( json.fullName.length > 0 ) {

             this.fullName = json.fullName;
         }
         else {

             this.fullName = json.firstName + ' ' + json.lastName;
         }

         this.phone = json.phone;
         this.email = json.email;
     }
}

export default Contact;