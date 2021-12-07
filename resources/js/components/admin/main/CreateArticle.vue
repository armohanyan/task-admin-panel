<template>
    <section class="panel important" id="table-section" ref="scrollToMe">
        <div class="form-container">
            <h2>Create a article</h2>
            <div class="createdSuccessfully-inner">
                <span class="createdSuccessfully" v-if="createdSuccessfully">You created article successfully</span>
            </div>
            <form  @submit.prevent="onSubmit" enctype="multipart/form-data" id="form-inner">
                <label for="title">Article Title:</label>
                <input v-model="inputValues.title" type="text" name="title" id="title"
                        :class="inputErrors.titleError ? 'invalid-feedback' : ''"
                        :placeholder="inputErrors.titleError ? inputErrors.title : 'Type article title'" />

                <label for="description">Article Description:</label>
                <input v-model="inputValues.description" type="text" name="description" id="description"
                       :class="inputErrors.descriptionError ? 'invalid-feedback' : ''"
                            :placeholder="inputErrors.descriptionError ? inputErrors.description : 'Type article description'" />

                <label for='text'>Article Text:</label>
                <textarea v-model="inputValues.text" cols="40" rows="8" name="text" placeholder="Type text" id="text"
                      :class="inputErrors.textError ? 'invalid-feedback' : ''"
                      :placeholder="inputErrors.textError ? inputErrors.text : 'Type article text'">
                </textarea>

                <label for="images">Article Images</label>
                <input @change="previewFiles"  ref="myFiles" accept="image/*" type='file' name='images[]' id="images" multiple/>
                <span :class="inputErrors.imagesError ? 'invalid-image' : ''" >
                    {{ inputErrors.imagesError ? inputErrors.images : '' }}
                </span>
                <div class="images-container">
                    <div v-for="(image, index) in showArticleImages" :key="index" class="image-items">
                        <img :src="image" alt="">
                        <span @click="deleteImage(index)" class="delete-image"><img src="https://img.icons8.com/flat-round/64/000000/delete-sign.png"/></span>
                    </div>
                </div>
                <span v-if="isCountMore" class="isCountMore">Images count must be 20. </span>
                <div class="button">
                    <button  class="submit-form">Submit</button>
                </div>
            </form>
        </div>
    </section>
</template>
<script>


export default {
    data(){
        return {
            showArticleImages : [],
            deletedImages : [],
            inputErrors : {},
            createdSuccessfully : false,
            imagesObject : null,
            isCountMore : false,
            isFormForEdit : false,
            articleImage : [],
            FILE : [],
            editArtilcle : [],
            inputValues : {
                title : '',
                description : '',
                text : '',
            },
            articleId : '',
        }
    },

    created () {

        EventBus.$on('deleteArticle', (data) => {
            this.clearForm()
        });
        if(this.$route.name == 'edit-article') {
            this.articleId = this.$route.params.id;
            this.isFormForEdit = true
            this.createdSuccessfully = false;
            const el = this.$refs.scrollToMe;
            if (el) { el.scrollIntoView({behavior: "smooth", block: "center", inline: "center"});}
            this.axios.get(`/api/edit/article/${this.articleId}`)
                .then(response => {
                    let articleImages = response.data.article.images

                    $.each(response.data.article, (key, value) =>  {
                        this.inputValues[key] !== undefined ? this.inputValues[key] = value : false
                    } );

                    if (articleImages != null) {
                        let imageAsObject = JSON.parse(articleImages)
                        this.showArticleImages = [];
                        this.FILE = [];

                        $.each(imageAsObject, (key, value) =>  {
                            this.showArticleImages.push('/' + value)
                            this.articleImage.push(value)
                        });
                    }
                })
                .catch(error => {
                    console.log(error);
                })
       }
    },

    methods: {

        previewFiles(event) {
            const files = event.target.files;
            $.each(files, (index, file) =>  {
                this.FILE.push(file);
                this.showArticleImages.push(URL.createObjectURL(file));
            });
        },

        deleteImage(index){
            let deletedImage = this.showArticleImages.splice(index,1)
            this.FILE.splice(index,1)
            if ( this.articleImage.includes(deletedImage.join() )) {
                this.deletedImages.push(deletedImage)
            }
        },

        SubmitForm() {
            let data = new FormData();
            let formValue = this.inputValues;
            let url;

            this.FILE.forEach((file, index) => {
                data.append('files[' + index + ']', file);
            })

            $.each(this.inputValues, (key, value) =>  {
                 data.append(key, value);
            });

            if (this.isFormForEdit){
                url = `/api/update/article/${this.articleId}`
                console.log(this.deletedImages)
                this.deletedImages.length > 0 ? data.append('deletedImages', this.deletedImages) : '';
            }
            else{
                url = '/api/create/article'
            }

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            this.axios.post(url, data, config)
            .then(response => {
                if ( ! response.data.success ) {
                    this.inputErrors = []

                    $.each(response.data.errors, (key, value) =>  {
                        this.inputErrors[key] = value.join()
                        this.inputErrors[key + 'Error'] = true
                    });
                }
                else {
                    this.clearForm()
                    this.createdSuccessfully = true;
                    EventBus.$emit('onSubmit', true);
                }
            })
            .catch(err => console.log(err))
        },
        onSubmit(){
            this.showArticleImages.length > 20 ? this.isCountMore = true : this.SubmitForm() ;
        },
        clearForm(){
            this.isCountMore = false
            this.showArticleImages = [];
            this.inputErrors = {};
            this.imagesObject = null;
            this.FILE = [];
            this.inputValues = {
                title : '',
                description : '',
                text : '',
            };
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

.isCountMore{
    color: red;
}

.invalid-feedback::placeholder {
    color: red;
}

.invalid-image {
    color: red;
    font-size: 13px;
}

.createdSuccessfully-inner{
    width: 100%;
    text-align: center;
}

.createdSuccessfully{
    color: green;
    font-size:20px;
    font-weight: 700;
}
</style>

