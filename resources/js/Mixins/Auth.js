let user = document.head.querySelector('meta[name="user"]');

module.exports = {
    methods: {
        testMixin: function () {
            return axios.get(route('test')).then(response => response.data)
        }
    },
    computed:{
        user(){
            //return axios.get(route('test')).then(response => response.data)
            return JSON.parse(user.content);
        }
    }

}
