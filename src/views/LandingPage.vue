<template>
  <ion-page>
    <header-component title="Landing Page" />
    <ion-content :fullscreen="true">
      <ion-grid>
        <ion-row>
          <ion-col size="12">
            <ion-img :src="bgImage"></ion-img>
          </ion-col>
        </ion-row>
        <ion-row>
          <ion-col offset="2" size="2">
            <ion-button color="dark" size="small" fill="outline"  router-link="/login">Sign In</ion-button>
          </ion-col>
          <ion-col>
            <ion-button color="medium" size="small" fill="outline" @click="$router.push({ name: 'VuexPost' })">Vuex Posts</ion-button>
          </ion-col>
          <ion-col size="2">
            <ion-button color="medium" size="small" fill="outline" @click="$router.push({ name: 'RegistrationPage' })">Sign Up</ion-button>
          </ion-col>
        </ion-row>
        <ion-row>
          <ion-col offset="2" size="8">
            <ion-datetime></ion-datetime>
          </ion-col>
        </ion-row>
      </ion-grid>
    </ion-content>
  </ion-page>
</template>

<script>
import { IonImg, IonButton, IonContent, IonPage, IonDatetime } from '@ionic/vue';
import { defineComponent } from 'vue';
import bg from '../assets/imgs/bg-img.png';
import HeaderComponent from '../components/HeaderComponent.vue';

export default defineComponent({
  name: 'HomePage',
  components: {
    IonContent,
    IonPage,
    IonButton,
    IonDatetime,
    IonImg,

    HeaderComponent
  },
  data() {
    return {
      bgImage: bg
    }
  }
});
</script>


