<script>
/* eslint-disable */
import {
  IonButtons,
  IonButton,
  IonModal,
  IonHeader,
  IonContent,
  IonToolbar,
  IonTitle,
  IonItem,
  IonInput,
  IonLabel,
} from '@ionic/vue';
export default {
  components: {
    IonToolbar,
    IonHeader,
    IonTitle,
  },
  props: {
    title: String
  }
}
</script>

<template>
  <ion-header :translucent="true">
    <ion-toolbar>
      <ion-title>{{ title }}</ion-title>
      <slot name="buttons"></slot>
    </ion-toolbar>
  </ion-header>
</template>