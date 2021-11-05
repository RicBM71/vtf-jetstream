let appname = document.head.querySelector('meta[name="appname"]');

module.exports = {
    computed:{
        appname(){
            return appname.content;
        }
    }
}
