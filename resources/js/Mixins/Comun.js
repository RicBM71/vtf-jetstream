module.exports = {
    methods: {
        getFechaHora: function (value) {
            return this.$moment(value).format("D/MM/YYYY H:mm:ss");
          },
    }

}
