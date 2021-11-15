var historico_urls = [];
module.exports = {
    methods: {
        getFechaHora: function (value) {
            return this.$moment(value).format("D/MM/YYYY H:mm:ss");
          },
        setMyHistoryUrl(url){
            historico_urls.unshift(window.location.href);
        },
        ressetMyHistoryUrl(url){
            historico_urls = [];
        },
        goBackUrl(){
            if (historico_urls.length == 0)
                this.$inertia.get(route('dashboard'));
            else{
                const url = historico_urls[0];
                historico_urls.shift();
                this.$inertia.get(url);
            }
        }
    },
    computed:{
        getUltUrl(){
            return historico_urls[0];
        },


    }
}
