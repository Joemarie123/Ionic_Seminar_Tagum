<template>
  <ion-page>
    <ion-header :translucent="true">
      <ion-toolbar>
        <ion-title>Registration Page</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Registration Page</ion-title>
        </ion-toolbar>
      </ion-header>
      <div id="container">
        <ion-grid>
          <ion-row>
            <ion-col offset="3" size="6">
              <ion-card>
                <ion-card-header>
                  <ion-card-title>Make sure to fill-out all fields.</ion-card-title>
                </ion-card-header>
                <form @submit.prevent="register">
                  <ion-card-content>
                    <ion-list>
                      <ion-item>
                        <ion-label position="stacked">First Name</ion-label>
                        <ion-input required v-model="first_name" type="text"></ion-input>
                      </ion-item>
                      <ion-item>
                        <ion-label position="stacked">Last Name</ion-label>
                        <ion-input required v-model="last_name" type="text"></ion-input>
                      </ion-item>
                      <ion-item>
                        <ion-label position="stacked">Email</ion-label>
                        <ion-input required v-model="email" type="email"></ion-input>
                      </ion-item>
                      <ion-item>
                        <ion-label position="stacked">Password</ion-label>
                        <ion-input required v-model="password" type="password"></ion-input>
                      </ion-item>
                      <ion-button type="submit" mode="ios" expand="block">Register</ion-button>
                      <ion-button color="medium" @click="navigateTo('/login')" mode="ios"
                        expand="block">Login</ion-button>
                    </ion-list>
                  </ion-card-content>
                </form>
              </ion-card>
            </ion-col>
          </ion-row>
        </ion-grid>
      </div>
    </ion-content>
  </ion-page>
</template>
    
<script>
import {
  IonList, IonCard, IonLabel, IonGrid, IonRow, IonCol,
  IonButton, IonInput, IonContent, IonHeader, IonPage, IonTitle, IonToolbar
} from '@ionic/vue';
import { defineComponent } from 'vue';
import { mapActions } from 'vuex';

export default defineComponent({
  name: 'RegistrationPage',
  components: {
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonButton,
    IonList, IonCard, IonLabel, IonGrid, IonRow, IonCol, IonInput
  },
  data() {
    return {
      first_name: '',
      last_name: '',
      email: '',
      password: '',
    }
  },
  methods: {
    ...mapActions('users', [
      'registration'
    ]),
    register() {

      let data = new FormData();
      data.append('first_name', this.first_name);
      data.append('last_name', this.last_name);
      data.append('email', this.email);
      data.append('password', this.password);

      this.registration(data)
        .then(() => {
          this.first_name = '';
          this.last_name = '';
          this.email = '';
          this.password = '';
          this.navigateTo('/dashboard');
        }).catch(e => console.log(e.message));
    },
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
    