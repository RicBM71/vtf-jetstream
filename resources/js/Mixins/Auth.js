module.exports = {
    methods: {
        hasRole: function (role) {
            return this.$page.props.roles.indexOf(role);
          },
        hasPermiso: function (permiso) {
            return this.$page.props.permisos.indexOf(permiso);
          },
    },
    computed:{
        currentUser(){
            return "aaa";
           // return JSON.parse(user.content);
        }
    }

}
