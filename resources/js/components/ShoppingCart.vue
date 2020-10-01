<template>
    <a class="ml-auto mr-3 text-warning" href="#"><b>{{ count }}</b><i class="fas fa-shopping-cart fa-lg"></i></a>
</template>

<script>
export default {
name: "ShoppingCart",
    props: {
        count: String,
    }
}
</script>

<style scoped>

</style>
