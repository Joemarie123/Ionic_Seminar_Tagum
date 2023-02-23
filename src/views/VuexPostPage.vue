<template>
  <ion-page>
    <ion-header :translucent="true">
      <ion-toolbar>
        <ion-title>Vuex Posts</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Vuex Posts</ion-title>
        </ion-toolbar>
      </ion-header>
      <ion-grid>
        <ion-row>
          <ion-col offset="2" size="8">
            <ion-card v-for="post in posts" :key="post.id">
              <ion-card-header>
                <ion-card-title>{{ post.title }}</ion-card-title>
              </ion-card-header>
              <ion-card-content>
                <ion-grid>
                  <ion-row>
                    <ion-col>{{ post.body }}</ion-col>
                  </ion-row>
                  <ion-row>
                    <ion-col>
                      <ion-button mode="ios" @click="$router.push({ name: 'VuexEditPage', params: { id: post.id } })">
                        <ion-icon slot="icon-only" :icon="cogOutline"></ion-icon>
                      </ion-button>
                    </ion-col>
                  </ion-row>
                </ion-grid>
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
  IonButton, IonIcon,
  IonCol, IonGrid, IonRow,
  IonContent, IonHeader, IonPage, IonTitle, IonToolbar
} from '@ionic/vue';
import { cogOutline } from 'ionicons/icons';
import { defineComponent } from 'vue';
import { mapActions, mapGetters } from "vuex";

export default defineComponent({
  name: 'HomePage',
  components: {
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonCol, IonGrid, IonRow,
    IonButton, IonIcon
    //   IonButton
  },
  setup() {
    return { cogOutline }
  },
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
    //   console.log("Parameter=> ", this.$route.params);
    this.fetchPosts()
      .then(() => console.log("Line 56=>", this.posts))

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
  