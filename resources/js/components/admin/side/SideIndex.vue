<template>
    <nav role="navigation">
        <ul class="main">
            <li class="dashboard"><a @click="$router.push('/')" >Dashboard</a></li>
            <div v-if="isRouteSearch">
                <li class=""><a @click="scrollToCreateArticle">Create Article</a></li>
                <li class=""><a @click="scrollToEditArticle">Edit Article</a></li>
                <li class=""><a @click="$router.push('/search')">Search Article</a></li>
            </div>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "SideIndex",

    data(){
       return {
           isRouteSearch : true,
       }
    },

    methods: {
        scrollToCreateArticle() {
            EventBus.$emit('scrollToCreateArticle', true);
        },

        scrollToEditArticle() {
            EventBus.$emit('scrollToEditArticle', true);
        }
    },

    created() {
        if ( this.$route.name == 'search' ) {
            this.isRouteSearch = false;
        }
    }

}

</script>

<style scoped>
.main li a {
    cursor: pointer;
}
</style>
