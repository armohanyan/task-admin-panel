<template>
    <section class="panel important">
        <div class="form-container">
            <h2>Write a post</h2>
            <form  enctype='multipart/form-data' method='POST' action=''>
                <label for="title">Article Title:</label>
                <input type="text" name="title" id="title" placeholder="Type article title" />
                <label for="description">Article Description:</label>
                <input type="text" name="description" id="description" placeholder="Type article description"/>
                <label for='text'>Article Text:</label>
                <textarea cols="40" rows="8" name="text" id="text"></textarea>
                <label for="images">Article Images</label>
                <input @change="previewFiles"  ref="myFiles" type='file' name='images[]' id="images" multiple />
                <div class="images-container">
                    <div v-for="(image, index) in articleImages" :key="index" class="image-items">
                        <img :src="image" alt="">
                        <span @click="deleteImage(index)" class="delete-image"><img src="https://img.icons8.com/flat-round/64/000000/delete-sign.png"/></span>
                    </div>
                </div>
                <input type="submit" value="Submit" />
            </form>
        </div>
    </section>
</template>
<script>

export default {

    data(){
        return {
            articleImages : [] ,
        }
    },

    methods: {
        previewFiles(event) {
            const file = event.target.files[0];
            this.articleImages.push(URL.createObjectURL(file));
        },

        deleteImage(index){
           this.articleImages.splice(index,1)
        }
    }
}
</script>

<style scoped>
.panel{
    display: flex;
    flex-wrap:wrap;
}
.form-container{
    width: 70%;
}

.images-container{
    margin-top: 3px;
    display: flex;
    flex-wrap:wrap;
    width: 100%;
}

.images-container > div{
    width: 25%;
    position: relative;
}
.images-container > div > img{
    object-fit: cover;
    width:100%;
}

.delete-image{
    position: absolute;
    top: 2px;
    right: 5px;
    font-size: 18px;
    font-width: 700;
    color: #fff;
}

.delete-image > img {
    width: 30px;
    height: 30px;
}
</style>
