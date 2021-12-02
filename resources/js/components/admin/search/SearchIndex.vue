<template>
    <div id="search-main">
    <!--  Header  -->
        <header-index/>
    <!------------->
    <!--  Side  -->
        <side-index/>
    <!------------->
        <side-index/>
        <div class="logo">
            <img alt="Google" src="https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png">
        </div>
        <div class="bar">
            <input v-model="query" class="searchbar" type="text" title="Search" placeholder="Search Google or type a URL" >
            <a href="#"> <img class="voice" src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Google_mic.svg/716px-Google_mic.svg.png" title="Search by Voice"></a>
            <div class="searchResult">
                <ul>
                    <li v-for="(queryResponse, index) in queryResponses" :key="index"
                         @click="$router.push({ name: 'show-article', params: { id: queryResponse.id } })">
                        <img src="https://img.icons8.com/material-rounded/24/000000/search.png"/> {{ queryResponse.title }}
                    </li>
                </ul>
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
    name: "SearchIndex",
    components: {
        HeaderIndex,
        SideIndex,
        FooterIndex,
    },

    data(){
        return {
            query : '',
            queryResponses : [],
        }
    },

    methods : {
        async sendSearchQuery(){
            await this.axios.get('api/query/response/' + this.query)
                .then( response => {
                    this.queryResponses = response.data.queryResult;
                })
                .catch( error => {
                    console.log(error)
                })
        }
    },

    watch: {
        query(after, before) {
            if( this.query.length > 0 ){
                 this.sendSearchQuery();
            }
            this.queryResponses.length = [];
        }
    },
}
</script>
<style scoped>

ul {
    list-style-type: none;
    overflow: hidden;
}

li {
    float: right;
}

li a {
    color: #000;
    display: block;
    text-align: center;
    padding: 10px 10px;
    text-decoration: none;
    font-size:14px;
}
li a:hover {
    text-decoration: underline;
}
.grid{
    height:23px;
    position:relative;
    bottom:4px;
}
.signbutton{
    background-color: #4885ed;
    color: #fff;
    border:none;
    border-radius:3px;
    padding:7px 10px;
    position:relative;
    bottom:7px;
    font-weight:bold;
}
.logo{
    text-align: center;
    margin-top:200px;
    margin-bottom:20px;
}
.bar{
    position: relative;
    margin:0 auto;
    width:570px;
    border-radius:15px;
}

.bar a{
    position: absolute;
    right: 20px;
    top: 10px;
    border-radius: 15px;

}
.bar:hover{
    box-shadow: 1px 1px 8px 1px #dcdcdc;
}

.bar:focus-within{
    box-shadow: 1px 1px 8px 1px #dcdcdc;
    outline:none;
}
.searchbar{
    position: absolute;
    left: 0;
    height:45px;
    border:none;
    width:100%;
    font-size:16px;
    outline: none;
    transition: width 0.4s linear;
    padding: 12px 10px;
    color: #000;
    caret-color:#000;
    border-radius: 15px;
}
.voice{
    height:20px;
}
.buttons{
    text-align: center;
    margin-top:30px;
}
.button{
    background-color: #f5f5f5;
    border:none;
    color:#707070;
    font-size:15px;
    padding: 10px 20px;
    margin:5px;
    border-radius:4px;
    outline:none;
}
.button:hover{
    border: 1px solid #c8c8c8;
    padding: 9px 19px;
    color:#808080;
}
.button:focus{
    border:1px solid #4885ed;
    padding: 9px 19px;
}
.searchResult{
    position: absolute;
    top: 38px;
    width: 100%;
    background: #fff;
    border: none;
    border-radius:0 0 15px 15px ;
}

.searchResult ul li {
    width: 100%;
    padding: 15px;
}
.searchResult ul li:hover{
    cursor: pointer;
    background: rgba(232, 232, 232, 0.8);
}
.searchResult ul li img {
    width: 18px;
    padding-right: 5px;
}

</style>
