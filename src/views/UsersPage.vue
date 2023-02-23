<template>
  <ion-page>
    <ion-header :translucent="true">
      <ion-toolbar>
        <ion-title>Users Page</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Users Page</ion-title>
        </ion-toolbar>
      </ion-header>

      <ion-grid>
        <ion-row>
          <ion-col offset="2" size="8">
            <ion-card v-for="user in users" :key="user.id">
              <img alt="Silhouette of mountains" :src="`https://ionic-backend.000webhostapp.com/avatars/${user.avatar}`" />
              <ion-card-header>
                <ion-card-title>{{ user.first_name }} {{ user.last_name }}</ion-card-title>
                <ion-card-subtitle>{{ user.email }}</ion-card-subtitle>
              </ion-card-header>

              <ion-card-content>
                {{ user.bio }}
              </ion-card-content>
            </ion-card>
          </ion-col>
        </ion-row>
      </ion-grid>
    </ion-content>
  </ion-page>
</template>
  
<script>
import {  IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from '@ionic/vue';
import { defineComponent } from 'vue';
import { mapGetters, mapActions } from "vuex";

export default defineComponent({
  name: 'HomePage',
  components: {
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    // IonButton
  },
  computed: {
    ...mapGetters('users', {
      users: 'getUsers'
    })
  },
  methods: {
    ...mapActions('users', [
      'fetchUsers',
    ]),
    navigateTo(path) {
      this.$router.push({ 'path': path });
    }
  },
  created() {
    //   console.log("Parameter=> ", this.$route.params);
    this.fetchUsers().then(() => console.log(this.users));
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
  