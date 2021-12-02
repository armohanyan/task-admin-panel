<template>
    <main role="main">
        <section class="panel important">
            <h2>Welcome to Admin Dashboard </h2>
            <ul>
                <li>Important panel that will always be really wide Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
            </ul>
        </section>
<!--  Create - Article  -->
    <create-article/>
<!----------------------->
<!--  Article - Table  -->
    <article-table/>
<!----------------------->

    </main>
</template>

<script>
;
import CreateArticle from "./CreateArticle";
import ArticleTable from "./ArticleTable";
export default {
    name: "MainIndex",
    components: {ArticleTable, CreateArticle}
}
</script>

<style scoped>

</style>
