import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);
import SearchIndex from '../components/admin/search/SearchIndex';
import AdminIndex from '../components/admin/IndexComponent/AdminIndex';
import ArticleIndex from '../components/admin/article/ArticleIndex';
import CreateArticle from '../components/admin/article/CreateArticle';
import ArticlesList from '../components/admin/article/ArticlesList';

export default new VueRouter({
    mode: 'history',
    scrollBehavior: () => ({
        y: 0
    }),
    routes : [
        {
            path: '/',
            name :'home',
            component : SearchIndex ,
        },
        {
            path: '/dashboard',
            name :'dashboard',
            component : AdminIndex,
        },
        {
            path: '/show/article/:id',
            name :'show-article',
            component : ArticleIndex ,
        },
        {
            path: '/create/article',
            name :'create-article',
            component : CreateArticle,
        },
        {
            path: '/edit/article/:id',
            name :'edit-article',
            component : CreateArticle,
        },
        {
            path: '/articles',
            name :'articles',
            component : ArticlesList,
        },
    ]
})


