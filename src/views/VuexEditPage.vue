<template>
  <ion-page>
    <ion-header :translucent="true">
      <ion-toolbar>
        <ion-title>Vuex Edit</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Vuex Edit</ion-title>
        </ion-toolbar>
      </ion-header>
      <ion-grid>
        <ion-row>
          <ion-col offset="2" size="8">
            <ion-card>
              <ion-card-header>
                <ion-card-title>{{ post.title }}</ion-card-title>
              </ion-card-header>
              <ion-card-content>
                {{ post.body }}
              </ion-card-content>
            </ion-card>
          </ion-col>
        </ion-row>
      </ion-grid>

    </ion-content>
  </ion-page>
</template>
    
<script>
import {
  // IonButton, IonIcon,
  IonCol, IonGrid, IonRow,
  IonContent, IonHeader, IonPage, IonTitle, IonToolbar
} from '@ionic/vue';
//   import { cogOutline } from 'ionicons/icons';
import { defineComponent } from 'vue';
import { mapActions, mapGetters } from "vuex";

export default defineComponent({
  name: 'HomePage',
  data: () => ({
    post: {
      title: '',
      body: '',
    }
  }),
  components: {
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonCol, IonGrid, IonRow,
    //   IonButton, IonIcon
    //   IonButton
  },
  // setup() {
  //   return { cogOutline }
  // },
  methods: {
    ...mapActions('posts', [
      'fetchPosts',
    ]),
    navigateTo(path) {
      this.$router.push({ 'path': path });
    }
  },
  computed: {
    ...mapGetters('posts', {
      posts: 'getPosts'
    }),
  },
  created() {
    //console.log("Parameter=> ", this.$route.params);
    // console.log("Passed post=> ", this.posts.find( post => post.id == this.$route.params.id));

    // this.post = this.posts.find(post => post.id == this.$route.params.id);
    
    this.fetchPosts().then(() => {
      const { id } = this.$route.params;
      const { posts } = this;

      if ( posts.find( post => post.id == id) == undefined) {
        this.$router.replace({name: 'VuexPost'});
      } else {
        this.post = posts.find(post => post.id == id);
      }

    });

    
    
    
    // if (this.posts.length == 0 || posts.find( post => post.id == id) == undefined){
    //   this.$router.replace({ name: 'VuexPost'});
    //   return;
    // }


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
    