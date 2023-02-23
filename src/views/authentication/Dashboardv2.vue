<template>
  <ion-page>
    <ion-content :fullscreen="true">
      <ion-grid>
        <ion-row>
          <ion-col size="2">
            <ion-item lines="none">
              <ion-avatar slot="start">
                <img alt="Silhouette of a person's head" src="https://www.w3schools.com/howto/img_avatar2.png" />
              </ion-avatar>
              <ion-label>
                <h1>Dashboard</h1>
                <p>John Doe</p>
              </ion-label>
            </ion-item>
            <ion-item lines="full" @click="navigateTo('/dashboard-v2/reports')" button>
              <ion-icon :icon="barChartOutline" slot="start"></ion-icon>
              <ion-label>
                Reports
              </ion-label>
            </ion-item>
            <ion-item lines="full" @click="navigateTo('/dashboard-v2/outdoors')" button>
              <ion-icon :icon="bicycleOutline" slot="start"></ion-icon>
              <ion-label>
                Outdoors
              </ion-label>
            </ion-item>
            <ion-item lines="full" @click="navigateTo('/dashboard-v2/messages')" button>
              <ion-icon :icon="chatboxEllipsesOutline" slot="start"></ion-icon>
              <ion-label>
                Messages
              </ion-label>
            </ion-item>
            <ion-item lines="full" @click="navigateTo('/dashboard-v2/schedule')" button>
              <ion-icon :icon="calendarOutline" slot="start"></ion-icon>
              <ion-label>
                Schedule
              </ion-label>
            </ion-item>
          </ion-col>
          <ion-col size="10">
            <ion-router-outlet></ion-router-outlet>
          </ion-col>
        </ion-row>
      </ion-grid>
    </ion-content>
  </ion-page>
</template>
  
<script>
/* eslint-disable */
import {
  IonButton, IonContent, IonHeader, IonPage, IonTitle, IonToolbar,
  IonRouterOutlet
} from '@ionic/vue';
import { defineComponent } from 'vue';

import {
  barChartOutline,
  bicycleOutline,
  calendarOutline,
  chatboxEllipsesOutline
} from 'ionicons/icons';

export default defineComponent({
  name: 'HomePage',
  data() {
    return {
      barChartOutline,
      bicycleOutline,
      calendarOutline,
      chatboxEllipsesOutline
    }
  },
  components: {
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonButton,
    IonRouterOutlet
  },
  methods: {
    navigateTo(path) {
      this.$router.push({ 'path': path });
    }
  },
  created() {
    //   console.log("Parameter=> ", this.$route.params);
  }
});
</script>
  
<style scoped>
ion-avatar {
  --border-radius: 4px;
}
</style>
  