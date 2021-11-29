<template>
    <section class="panel important">
        <div class="form-container">
            <h2>Write a post</h2>
            <div id="form-inner">
                <label for="title">Article Title:</label>
                <input v-model="inputValues.title" type="text" name="title" id="title" placeholder="Type article title" />

                <label for="description">Article Description:</label>
                <input v-model="inputValues.description" type="text" name="description" id="description" placeholder="Type article description"/>

                <label for='text'>Article Text:</label>
                <textarea v-model="inputValues.text" cols="40" rows="8" name="text" placeholder="Type text" id="text"></textarea>

                <label for="images">Article Images</label>
                <input @change="previewFiles"  ref="myFiles" accept="image/*" type='file' name='images[]' id="images" multiple />

                <div class="images-container">
                    <div v-for="(image, index) in showArticleImages" :key="index" class="image-items">
                        <img :src="image" alt="">
                        <span @click="deleteImage(index)" class="delete-image"><img src="https://img.icons8.com/flat-round/64/000000/delete-sign.png"/></span>
                    </div>
                </div>
                <div class="button">
                    <button @click="submitCreateForm" class="submit-form">Submit</button>
                </div>
            </div>
        </div>
    </section>
</template>
<script>

export default {
    data(){
        return {
            showArticleImages : [],
            inputErrors : {},
            inputValues : {
                title : null,
                description : null,
                text : null,
                images : [],
            }
        }
    },

    methods: {
        previewFiles(event) {
            const file = event.target.files[0];
            this.showArticleImages.push(URL.createObjectURL(file));
            this.inputValues.images.push(event.target.files[0].name);
        },

        deleteImage(index){
            this.showArticleImages.splice(index,1)
            this.inputValues.images.splice(index,1)
        },

        submitCreateForm() {
            this.axios.post('api/create/article', this.inputValues)
                .then(response => {
                    if (! response.data.success ) {
                        console.log(response.data.errors);
                    }
                })
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
    padding: 10px;
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
