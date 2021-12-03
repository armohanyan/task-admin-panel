import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);
import SearchIndex from '../components/admin/search/SearchIndex';
import AdminIndex from '../components/admin/IndexComponent/AdminIndex';
import ArticleIndex from '../components/admin/article/ArticleIndex';

export default new VueRouter({
    // mode: 'history',
    routes : [
        {
            path: '/',
            name :'home',
            component : AdminIndex ,
        },
        {
            path: '/search',
            name :'search',
            component : SearchIndex,
        },
        {
            path: '/show/article/:id',
            name :'show-article',
            component : ArticleIndex ,
        },
    ]
})


