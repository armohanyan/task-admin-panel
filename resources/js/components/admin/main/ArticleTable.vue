<template>
    <section class="panel" ref="scrollToMe">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Table <b>Articles</b></h2></div>
                        <div class="col-sm-4">
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" class="form-control" placeholder="Search&hellip;">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead  >
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Text</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(article, index) in articles">
                            <td>{{ article.id }}</td>
                            <td>{{ article.title }}</td>
                            <td>{{ article.description }}</td>
                            <td>{{ article.text }}</td>
                            <td class="action-links">
                                <a @click="$router.push({ name: 'show-article', params: { id: article.id  } })" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                <a @click="editArticle(article.id)" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a @click="deleteArticle(article.id)" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>

<script>

export default {
    name: "ArticleITable",

    data(){
        return {
            articles : [],
        }
    },

    mounted () {
        this.getArticles();
    },

    created() {
        EventBus.$on('onSubmit', (data) => {
            this.getArticles();
        })

        EventBus.$on('scrollToEditArticle', (data) => {
            const el = this.$refs.scrollToMe;
            if (el) { el.scrollIntoView({behavior: "smooth", block: "center", inline: "center"});}
        });
    },

    methods : {
       async getArticles(){
            await this.axios.get('api/articles')
            .then(response => {
                this.articles = response.data.articles
            })
            .catch(error => {
                console.log(error);
            })
        },

       async deleteArticle(id){
            await this.axios.get(`api/destroy/article/${id}`)
            .then(response => {
                EventBus.$emit('deleteArticle', true);
                this.getArticles();
            })
            .catch(error => {
                console.log(error);
            })
        },

        editArticle(id){
            EventBus.$emit('editArticle', id);
        }
    }
}
</script>

<style scoped>
.panel {
    width: 95%;
    padding-right: 19px;
}

.table-wrapper {
    min-width: 1000px;
    background: #fff;
    padding: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
    padding-bottom: 10px;
    margin: 0 0 10px;
}
.table-title h2 {
    margin: 8px 0 0;
    font-size: 22px;
}
.search-box {
    position: relative;
    float: right;
}
.search-box input {
    height: 34px;
    border-radius: 20px;
    padding-left: 35px;
    border-color: #ddd;
    box-shadow: none;
}
.search-box input:focus {
    border-color: #3FBAE4;
}
.search-box i {
    color: #a0a5b1;
    position: absolute;
    font-size: 19px;
    top: 8px;
    left: 10px;
}
table.table tr th, table.table tr td {
    border-color: #e9e9e9;
}
table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}
table.table td:last-child {
    width: 130px;
}
table.table td a {
    color: #a0a5b1;
    display: inline-block;
    margin: 0 5px;
}
table.table td a.view {
    color: #03A9F4;
}
table.table td a.edit {
    color: #FFC107;
}
table.table td a.delete {
    color: #E34724;
}
table.table td i {
    font-size: 19px;
}
.pagination {
    float: right;
    margin: 0 0 5px;
}
.pagination li a {
    border: none;
    font-size: 95%;
    width: 30px;
    height: 30px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 30px !important;
    text-align: center;
    padding: 0;
}
.pagination li a:hover {
    color: #666;
}
.pagination li.active a {
    background: #03A9F4;
}

.pagination li.active{
    color: #fff;
}
.pagination li.active a:hover {
    background: #0397d6;
}
.pagination li.disabled i {
    color: #ccc;
}
.pagination li i {
    font-size: 16px;
    padding-top: 6px
}
.hint-text {
    float: left;
    margin-top: 6px;
    font-size: 95%;
}

.action-links{
    cursor: pointer;
}
</style>
