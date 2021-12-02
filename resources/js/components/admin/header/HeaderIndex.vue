<template>
    <header role="banner">
        <h1 @click="$router.push('/')" class="title-admin-panel" >Admin Panel</h1>
        <ul class="utilities">
            <li class="users"><a href="#">My Account</a></li>
<!--            <li class="logout warn"><a href="">Log Out</a></li>-->
        </ul>
    </header>
</template>

<script>
export default {
    name: "HeaderIndex",

}
</script>

<style scoped>

header > h1 {
    cursor: pointer ;
}

</style>

