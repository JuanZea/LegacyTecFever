<template>
    <a class="ml-auto mr-3 text-warning nd" :href="route"><i class="fas fa-shopping-cart fa-lg hvr-buzz-out"></i><b>&nbsp;&nbsp;{{ newAmount }}</b></a>
</template>

<script>
export default {
    name: "ShoppingCartLink",
    props: ['amount', 'user', 'route', 'quantity'],
    data() {
        return {
            users: ['Juan', 'Andres'],
            info: null
        }
    },
    mounted () {
    // axios
    //   .get('http://tecfever.test/api/user/'+this.user)
    //   .then(response => (this.info = response))
    },
    computed: {
    newAmount: function () {
      return this.amount + parseInt(this.quantity);
    }
  }
}

</script>

<style scoped>

</style>
