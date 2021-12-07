<template>
    <nav role="navigation">
        <ul class="main">
            <li class=""><a @click="$router.push('/dashboard').catch(()=>{})"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a></li>
            <div class="side-navbar">
                <li><a @click="$router.push('/create/article').catch(()=>{})"><i class="fa fa-plus" aria-hidden="true"></i> Create Article</a></li>
                <li><a @click="$router.push('/articles').catch(()=>{})"><i class="fa fa-pencil" aria-hidden="true"></i>Articles</a></li>
                <!-- <li><a @click="$router.push('/search')"><i class="fa fa-search" aria-hidden="true"></i>Search Article</a></li> -->
            </div>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "SideIndex",
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
