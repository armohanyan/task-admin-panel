<template>
    <section class="panel important">
        <div class="form-container">
            <h2>Write a post</h2>
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
            inputErrors : {},
            imagesObject : null,
            array : [],
            FILE : [],
            inputValues : {
                title : '',
                description : '',
                text : '',
            }
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
            this.showArticleImages.splice(index,1)
            this.FILE.splice(index,1)
        },

        onSubmit(e) {
            console.log(this.inputValues)
            let data = new FormData();
            let formValue = this.inputValues;

            this.FILE.forEach((file, index) => {
                data.append('files[' + index + ']', file);
            })

            $.each(this.inputValues, (key, value) =>  {
                 data.append(key, value);
            });

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            this.axios.post('api/create/article', data, config)
            .then(response => {
                console.log(response)
                if ( ! response.data.success ) {
                    this.inputErrors = []
                    $.each(response.data.errors, (key, value) =>  {
                        this.inputErrors[key] = value.join()
                        this.inputErrors[key + 'Error'] = true
                    });
                }
            })
            .catch(err => console.log(err))
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

.invalid-feedback::placeholder {
    color: red;
}

.invalid-image {
    color: red;
    font-size: 13px;
}

</style>

