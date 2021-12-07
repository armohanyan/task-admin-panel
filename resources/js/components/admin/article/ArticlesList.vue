<template>
  <div id="articles-main">
    <!--  Header  -->
    <header-index />
    <!------------->
    <!--  Side  -->
    <side-index />
    <!------------->
    <div class="articles-inner">
      <div id="root">
        <div v-for="article of articles" class="card">
          <div class="image-container">
            <img :src="article.image" alt="" />
          </div>
          <div class="card-content">
            <div class="title">{{ article.title }}</div>
            <p>{{ article.description }}</p>
            <p>{{ article.text }}</p>
            <div class="action-links">
              <a
                @click="
                  $router.push({
                    name: 'show-article',
                    params: { id: article.id },
                  })
                "
                class="view"
                title="View"
                data-toggle="tooltip"
                ><i class="material-icons">&#xE417;</i></a
              >
              <a
                @click="
                  $router.push({
                    name: 'edit-article',
                    params: { id: article.id },
                  })
                "
                class="edit"
                title="Edit"
                data-toggle="tooltip"
                ><i class="material-icons">&#xE254;</i></a
              >
              <a
                @click="deleteArticle(article.id)"
                class="delete"
                title="Delete"
                data-toggle="tooltip"
                ><i class="material-icons">&#xE872;</i></a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--  Footer  -->
    <footer-index />
    <!------------->
  </div>
</template>

<script>
import HeaderIndex from "../header/HeaderIndex";
import SideIndex from "../side/SideIndex";
import FooterIndex from "../footer/FooterIndex";
export default {
  name: "ArticlesList",
  components: {
    HeaderIndex,
    SideIndex,
    FooterIndex,
  },
  data() {
    return {
      articles: [],
    };
  },

  mounted() {
    this.getArticles();
  },

  created() {
    EventBus.$on("onSubmit", (data) => {
      this.getArticles();
    });
  },

  methods: {
    async getArticles() {
      await this.axios
        .get("api/articles")
        .then((response) => {
          this.articles = [];
          let articles = response.data.articles;

          articles.forEach((article) => {
            let imagesAsObject;

            if (article.images != null) {
              imagesAsObject = JSON.parse(article.images)[0];
            } else {
              imagesAsObject =
                "https://image.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg";
            }

            let articleExample = {
              id: article.id,
              title: article.title,
              description: article.description,
              text: article.text,
              image: imagesAsObject,
            };
            this.articles.push(articleExample);
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },

    async deleteArticle(id) {
      await this.axios
        .get(`/api/destroy/article/${id}`)
        .then((response) => {
          this.getArticles();
        })
        .catch((error) => {
          console.log(error);
        });
    }
  },
};
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body {
  background: #f1f1f1;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: "Poppins";
}
.container {
  display: flex;
  justify-content: center;
  margin: 1rem;
  gap: 10px;
  flex-wrap: wrap;
}
#root {
  width: 100%;
  padding: 100px 200px;
  display: flex;
  justify-content: center;
  gap: 10px;
  flex-wrap: wrap;
}
.card {
  height: 430px;
  position: relative;
  background: #fff;
  border-radius: 5px;
  width: 17%;
}
.card:hover {
  box-shadow: 2px 2px 7px 2px rgba(0, 0, 0, 0.2);
}
.card .image-container {
  position: relative;
  width: 100%;
  height: 180px;
}
.card img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  filter: brightness(0.8);
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  object-fit: cover;
  transition: 0.2s ease-in-out;
}
.card:hover img {
  filter: brightness(1);
}
.card-content {
  padding: 15px 20px;
  flex-direction: column;
  padding-bottom: 10px;
}
.tag {
  background: red;
  padding: 1px 7px;
  font-size: 12px;
  color: #fff;
  border-radius: 40px;
}
.title {
  font-weight: bold;
  margin-top: 5px;
}
.card p {
  font-size: 12px;
  margin-top: 10px;
  font-weight: 300;
}

.user {
  position: absolute;
  bottom: 10px;
  right: 20px;
  left: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 10px;
  padding-top: 10px;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}
.user .user-img {
  background: blue;
  width: 40px;
  height: 40px;
  border-radius: 50%;
}
.user .user-info {
  display: flex;
  flex-direction: column;
  letter-spacing: 1px;
}
.user .user-info small {
  font-size: 11px;
}
.user .user-info span {
  font-weight: bold;
  font-size: 14px;
}
.action-links {
  cursor: pointer;
  text-align: center;
  margin-top: 100px;
}
.action-links i {
  font-size: 20px;
  margin: 0 5px;
  cursor: pointer;
}

.action-links a {
  color: #a0a5b1;
  display: inline-block;
  margin: 0 5px;
}
.action-links .view {
  color: #03a9f4;
}
.action-links .edit {
  color: #ffc107;
}
.action-links .delete {
  color: #e34724;
}
i {
  font-size: 19px;
}
</style>