<template>
    <ion-header>
      <ion-toolbar>
        <ion-title>Inline Modal</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content class="ion-padding">
      <ion-button id="open-modal" expand="block">Open</ion-button>
      <p>{{ message }}</p>
      <ion-modal ref="modal" trigger="open-modal" @willDismiss="onWillDismiss">
            <h1>Modal is working.</h1>
      </ion-modal>
    </ion-content>
  </template>
  
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
      },
      data() {
        return {
          message: 'This modal example uses triggers to automatically open a modal when the button is clicked.',
        };
      },
      methods: {
        cancel() {
          this.$refs.modal.$el.dismiss(null, 'cancel');
        },
        confirm() {
          const name = this.$refs.input.$el.value;
          this.$refs.modal.$el.dismiss(name, 'confirm');
        },
        onWillDismiss(ev) {
          if (ev.detail.role === 'confirm') {
            this.message = `Hello, ${ev.detail.data}!`;
          }
        },
      },
    };
  </script>