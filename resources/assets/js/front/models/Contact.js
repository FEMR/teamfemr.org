class Contact{

    constructor( json ) {


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

    post() {

        return {

            "id": this.id,
            "full_name": this.fullName,
            "phone": this.phone,
            "email": this.email,
        }
    }
}

export default Contact;