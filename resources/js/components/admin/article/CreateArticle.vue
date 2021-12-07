<template>
    <div id="create-article-main">
    <!--  Header  -->
        <header-index/>
    <!------------->
    <!--  Side  -->
        <side-index/>
    <!------------->

    <div class="create-article-inner">
        <create-article/>
    </div>
  
    <!--  Footer  -->
        <footer-index/>
    <!------------->
    </div>
</template>

<script>
import HeaderIndex from "../header/HeaderIndex";
import SideIndex from "../side/SideIndex";
import FooterIndex from "../footer/FooterIndex";
import CreateArticle from '../main/CreateArticle.vue';

export default {    
    name: "SearchIndex",
    components: {
        HeaderIndex,
        SideIndex,
        FooterIndex,
        CreateArticle,
    },
}
</script>
<style scoped>
.create-article-inner{
    padding: 50px 230px;
}
</style>
