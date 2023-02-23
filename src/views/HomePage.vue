<template>
  <div>
    <h1>Exploring Form Submission.</h1>
    <ion-grid>
      <ion-row>
        <ion-col>
          <form-component
            :post_prop="post"
            :isCreate="isCreate"
            @onFormSubmit="savePosts"
            @updateIsCreate="updateIsCreate" 
          />
        </ion-col>
        <ion-col>
          <div style="overflow-y: scroll;">
            <post-component 
              v-for="(post, i) in posts"
              :key="i"
              :title="post.title"
              :body="post.body"
              :id="post.id" 
              @editPost="editPost"
              @deletePost="deletePost"
            />
          </div>
        </ion-col>
      </ion-row>
    </ion-grid>
  </div>
</template>

<script>
//import { IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from '@ionic/vue';
import { IonGrid, IonRow, IonCol } from '@ionic/vue';
import { defineComponent } from 'vue';
import FormComponent from '../components/FormComponent';
import PostComponent from '../components/PostComponent';

export default defineComponent({
  name: 'HomePage',
  components: {
    PostComponent,
    FormComponent,
    IonGrid,
    IonRow,
    IonCol,
    // IonContent,
    // IonHeader,
    // IonPage,
    // IonTitle,
    // IonToolbar,
    // SampleComponent
  },
  data() {
    return {
      posts: [],
      post: {
        title: '',
        body: '',
        id: '',
      },
      isCreate: 1, // 1 = creation 2 = edit 3 = pending
    }
  },
  methods: {
    savePosts(post){
      if (this.isCreate == 1)
        this.posts.unshift(post);
      else if (this.isCreate == 3){
        let temp = Object.assign(this.posts);
        temp = temp.map((old_post) => {
          if (post.id == old_post.id) return post;
          else return old_post;
        });

        this.posts = temp;
        this.post = {
          title: '',
          body: '',
        };
        this.isCreate = 1;
      }
      
      // if (this.isCreate) 
      //   this.posts.unshift(post);
      // else {
      //   let temp = Object.assign(this.posts);
      //   temp = temp.map((old_post) => {
      //     if (post.id == old_post.id)
      //       return post;
      //     else return old_post;
      //   });
      //   this.posts = temp;
      // }
      
      console.log("New Post=> ", this.posts);
    },
    editPost(post){
     // console.log("(HomePage.vue) Edit this post=> ", post);
      this.post = post;
      this.isCreate = 2;
    },
    updateIsCreate(value){
      this.isCreate = value;
    },
    deletePost(id){
      let temp = Object.assign(this.posts);
      this.posts = temp.filter(post => post.id != id);
    }
  }
});
</script>

<style scoped>
#container {
  text-align: center;

  position: absolute;
  left: 0;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
}

#container strong {
  font-size: 20px;
  line-height: 26px;
}

#container p {
  font-size: 16px;
  line-height: 22px;

  color: #8c8c8c;

  margin: 0;
}

#container a {
  text-decoration: none;
}
</style>
