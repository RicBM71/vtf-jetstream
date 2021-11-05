let user = document.head.querySelector('meta[name="user"]');

axios.get(route('test')).then((response) => { console.log(response); });

module.exports = {
    methods: {


    },
    computed:{
        user(){

           // return JSON.parse(user.content);
        }
    }

}
