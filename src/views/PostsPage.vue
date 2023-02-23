<template>
  <ion-page>
    <ion-header :translucent="true">
      <ion-toolbar>
        <ion-title>Posts</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-button id="open-modal" expand="block">Open</ion-button>
      <ion-modal ref="modal" trigger="open-modal" @willDismiss="onWillDismiss">
        <ion-header>
          <ion-toolbar>
            <ion-buttons slot="start">
              <ion-button @click="cancel()">Cancel</ion-button>
            </ion-buttons>
            <ion-title>Welcome</ion-title>
            <ion-buttons slot="end">
              <ion-button :strong="true" @click="confirm()">Confirm</ion-button>
            </ion-buttons>
          </ion-toolbar>
        </ion-header>
        <ion-content class="ion-padding">
          <ion-item>
            <ion-label position="stacked">Title</ion-label>
            <ion-input ref="title" type="text" placeholder="Post title."></ion-input>
          </ion-item>
          <ion-item>
            <ion-label position="stacked">Body</ion-label>
            <ion-input ref="body" type="text" placeholder="Post body."></ion-input>
          </ion-item>
        </ion-content>
      </ion-modal>

      <ion-grid>
        <ion-row v-for="post in posts" :key="post.id">
          <ion-col size="10" offset="1">
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
  IonButtons,
    IonButton,
    IonModal,
    IonTitle,
    IonItem,
    IonInput,
    IonLabel, IonCard, IonCardHeader, IonCardTitle, IonCardContent, IonContent, IonHeader, IonPage, IonToolbar
} from '@ionic/vue';
import { defineComponent } from 'vue';
import axios from "axios";

export default defineComponent({
  name: 'HomePage',
  components: {
    IonButtons,
    IonButton,
    IonModal,
    IonTitle,
    IonItem,
    IonInput,
    IonLabel,
    IonContent,
    IonHeader,
    IonPage,
    IonToolbar,
    IonCard, IonCardHeader, IonCardTitle, IonCardContent,
  },
  data() {
    return {
      api_endpoint: 'https://jsonplaceholder.typicode.com/posts?_limit=10',
      posts: [],
      message: '',
    }
  },
  methods: {
    async getPosts() {
      let resp = await axios.get(this.api_endpoint);
      console.log("Response=> ", resp);
      this.posts = resp.data;
    },
    cancel() {
      this.$refs.modal.$el.dismiss(null, 'cancel');
    },
    confirm() {
      const title = this.$refs.title.$el.value;
      const body = this.$refs.body.$el.value;
      this.$refs.modal.$el.dismiss({title, body}, 'confirm');
    },
    onWillDismiss(ev) {
      console.log("onWillDismiss=>", ev);
      if (ev.detail.role === 'confirm') {
        //this.message = `Hello, ${ev.detail.data}!`;
        this.posts.unshift(ev.detail.data);
      }
    },
  },
  created() {
    this.getPosts();
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
    