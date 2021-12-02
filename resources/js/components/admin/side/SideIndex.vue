<template>
    <nav role="navigation">
        <ul class="main">
            <li class=""><a @click="$router.push('/')"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a></li>
            <div v-if="isRouteSearch" class="side-navbar">
                <li><a @click="scrollToCreateArticle"><i class="fa fa-plus" aria-hidden="true"></i> Create Article</a></li>
                <li><a @click="scrollToEditArticle"><i class="fa fa-pencil" aria-hidden="true"></i>Edit Article</a></li>
                <li><a @click="$router.push('/search')"><i class="fa fa-search" aria-hidden="true"></i>Search Article</a></li>
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
i {
    padding: 5px !important;
}
</style>
