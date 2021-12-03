<template>
    <div id="articleIndexMain">
        <!--  Header  -->
        <header-index/>
        <!------------->
        <!--  Side  -->
        <side-index/>
        <!------------->
        <div class="container pb50 mt4 articleInner">
            <div class="row" style="width: 110% !important;">
                <div class="col-md-9 mt40">
                    <article>
                        <div class="intro">
                            <h2 class="text-center">{{ article.title }}</h2>
                            <h4 class="text-center">{{ article.description }}</h4>
                            <p class="text-center">{{ article.text }}</p>
                        </div>
                        <div class="row photos">
                            <div class="col-sm-6 col-md-4 col-lg-3 item mt-4" v-for="(image, index) in articleImages" :key="index" >
                                <a :href="'/' + image" data-lightbox="photos">
                                    <img class="img-fluid" :src="'/' + image">
                                </a>
                            </div>
                         </div>
                    </article>
                </div>
            </div>
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
export default {
    name: "Index",
    components: { FooterIndex, SideIndex, HeaderIndex },

    data() {
        return {
            article : [],
            articleImages : [],
        }
    },

    mounted () {
        this.showArticle();
    },

    methods : {
        async showArticle(){
            await this.axios.get('/api/show/article/' + this.$route.params.id)
                .then( response => {
                    this.article = response.data.article
                    let articleImages = response.data.article.images

                    if (articleImages != null) {
                        let imageAsObject = JSON.parse(articleImages)
                        this.articleImages = imageAsObject
                    }
                    console.log(response)
                })
                .catch(error => {
                    console.log(error)
                } )
        }
    }

}
</script>

<style scoped>

body{
    margin-top:20px;
}
article{
    width: 130%;
}
article > img{
    width: 400px;
}
#articleIndexMain{
    /*text-align: ;*/
}

.articleInner{
    margin-top: 80px;
}

.photo-gallery {
    color:#313437;
    background-color:#fff;
}

.photo-gallery p {
    color:#7d8285;
}

.photo-gallery h2 {
    font-weight:bold;
    margin-bottom:40px;
    padding-top:40px;
    color:inherit;
}

@media (max-width:767px) {
    .photo-gallery h2 {
        margin-bottom:25px;
        padding-top:25px;
        font-size:24px;
    }
}

.photo-gallery .intro {
    font-size:16px;
    max-width:500px;
    margin:0 auto 40px;
}

.photo-gallery .intro p {
    margin-bottom:0;
}

.photo-gallery .photos {
    padding-bottom:20px;
}

.photo-gallery .item {
    padding-bottom:30px;
}




</style>
