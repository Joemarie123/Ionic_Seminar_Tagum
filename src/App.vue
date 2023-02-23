<template>
  <ion-app>
    <ion-router-outlet/>
  </ion-app>
</template>

<script>
import { 
    // IonIcon, 
    // IonLabel, 
    // IonTabBar, 
    // IonTabButton, 
    // IonTabs, 
    IonApp, IonRouterOutlet } from '@ionic/vue';
import { defineComponent } from 'vue';
import { calendar, personCircle } from 'ionicons/icons';
  

export default defineComponent({
  name: 'App',
  components: {
    IonApp,
    IonRouterOutlet,
    // IonIcon, 
    // IonLabel, 
    // IonTabBar, 
    // IonTabButton, 
    // IonTabs,
  },
  setup() {
      const beforeTabChange = () => {
        console.log("beforeTabChange");
      }
      const afterTabChange = () => {
        console.log("afterTabChange");
      }
      return {
        calendar,
        personCircle,
        beforeTabChange,
        afterTabChange
      }
    }
});
</script>