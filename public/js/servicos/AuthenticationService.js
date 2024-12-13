
export default {
    registerToken(data){
        //debugger
        window.localStorage.setItem('token', data.token);
        console.log(data.token);
    },

    eraseToken(){
        window.localStorage.clear();
    }
}
