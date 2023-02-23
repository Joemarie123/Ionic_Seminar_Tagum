<template>
  <ion-page>

    <header-component title="Dashboard">
      <template v-slot:buttons>
        <ion-buttons slot="end">
          <ion-button>
            <ion-button mode="ios" @click="logout">Logout</ion-button>
          </ion-button>
        </ion-buttons>
      </template>

    </header-component>
    <!-- <ion-header :translucent="true">
      <ion-toolbar>
        <ion-title>Dashboard Page</ion-title>
        <ion-buttons slot="end">
          <ion-button>
            <ion-button mode="ios" @click="logout">Logout</ion-button>
          </ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header> -->
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Dashboard Page</ion-title>
        </ion-toolbar>
      </ion-header>
      <div id="container">


        <ion-grid>
          <ion-row>
            <ion-col offset="2" size="8">
              <h1>Welcome to Dashboard!</h1>
            </ion-col>
            <ion-col offset="2" size="8">
              <ion-button @click="navigateTo('/users')" fill="outline" color="dark">Show Users</ion-button>
            </ion-col>
            <ion-col offset="2" size="8">
              <ion-card v-for="grade in grades" :key="grade.id">
                <ion-card-header>
                  <ion-card-title>{{ grade.subject }}</ion-card-title>
                </ion-card-header>

                <ion-card-content>
                  <ion-chip :color="grade.grade > 74 ? 'success' : 'warning'">
                    <ion-icon :icon="documentAttachOutline"
                      :color="grade.grade > 74 ? 'success' : 'warning'"></ion-icon>
                    <ion-label>{{ grade.grade }}</ion-label>
                  </ion-chip>
                  <ion-chip :color="grade.grade > 74 ? 'success' : 'warning'">
                    <ion-icon :icon="grade.grade > 74 ? starOutline : warningOutline"
                      :color="grade.grade > 74 ? 'success' : 'warning'"></ion-icon>
                    <ion-label>{{ grade.remarks }}</ion-label>
                  </ion-chip>
                </ion-card-content>
              </ion-card>
            </ion-col>
          </ion-row>
        </ion-grid>
      </div>
    </ion-content>
  </ion-page>
</template>
    
<script>
/* eslint-disable */
import {
  // IonList, IonCard, IonLabel, IonGrid, IonRow, IonCol,IonInput, IonButton,IonAvatar,

  IonButtons,
  IonButton,
  IonContent, IonHeader, IonPage, IonTitle, IonToolbar,
  IonChip, IonLabel, IonIcon,
} from '@ionic/vue';
import { defineComponent } from 'vue';
import { mapActions, mapGetters } from "vuex";
import HeaderComponent from '../../components/HeaderComponent.vue';

import { closeCircle, starOutline, warningOutline, documentAttachOutline } from 'ionicons/icons';

export default defineComponent({
  name: 'DashboardPage',
  components: {
    IonButtons,
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonButton,
    IonChip, IonLabel, IonIcon,
    //   IonList, IonCard, IonLabel, IonGrid, IonRow, IonCol, IonInput
    HeaderComponent
  },
  data() {
    return {
      email: '',
      password: '',
      starOutline,
      closeCircle,
      warningOutline,
      documentAttachOutline
    }
  },
  computed: {
    ...mapGetters('grades', {
      grades: 'getGrades'
    }),
  },
  methods: {
    ...mapActions('grades', [
      'fetchGrades'
    ]),
    logout() {
      localStorage.clear();
      this.$router.replace({ name: 'Loginpage' });
    },
    navigateTo(path) {
      this.$router.push({ 'path': path });
    }
  },
  created() {
    //   console.log("Parameter=> ", this.$route.params);
    this.fetchGrades();
  }
});
</script>
    
<style scoped>
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
    