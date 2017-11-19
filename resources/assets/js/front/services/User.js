class User {

    static isLoggedIn() {

        return window.FEMR.userToken !== 'guest';
    }

}

export default User;