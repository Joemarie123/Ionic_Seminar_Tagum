<template>
  <ion-page>
    <ion-header :translucent="true">
      <ion-toolbar>
        <ion-title>Sign Up</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-grid>
        <ion-row>
          <ion-col offset="3" size="6" style="text-align:center">
            <h1>Membership Form</h1>
          </ion-col>
        </ion-row>
        <ion-row>
          <ion-col offset="2" size="4">
            <ion-item>
              <ion-label position="floating">First Name</ion-label>
              <ion-input v-model="user.first_name" mode="ios"></ion-input>
            </ion-item>
          </ion-col>
          <ion-col offset="1" size="4">
            <ion-item>
              <ion-label position="floating">Last Name</ion-label>
              <ion-input :autofocus="true" v-model="user.last_name"></ion-input>
            </ion-item>
          </ion-col>
        </ion-row>
        <ion-row>
          <ion-col offset="2" size="9">
            <ion-item>
              <ion-label position="floating">Address</ion-label>
              <ion-textarea v-model="user.address" :auto-grow="true"></ion-textarea>
            </ion-item>
          </ion-col>
        </ion-row>
        <ion-row>
          <ion-col offset="2" size="4">
            <ion-item>
              <ion-label position="floating">Email</ion-label>
              <ion-input type="email" v-model="user.email"></ion-input>
            </ion-item>
          </ion-col>
          <ion-col offset="1" size="4">
            <ion-item>
              <ion-label position="floating">Password</ion-label>
              <ion-input v-model="user.password" type="password"></ion-input>
            </ion-item>
          </ion-col>
        </ion-row>
        <ion-row>
          <ion-col offset="2" size="4">
            <ion-label>Sex</ion-label>
            <ion-radio-group v-model="user.sex">
              <ion-item>
                <ion-label>Male</ion-label>
                <ion-radio mode="ios" slot="end" value="Male"></ion-radio>
              </ion-item>
              <ion-item>
                <ion-label>Female</ion-label>
                <ion-radio mode="ios" slot="end" value="Female"></ion-radio>
              </ion-item>
            </ion-radio-group>
          </ion-col>
          <ion-col offset="1" size="4">
            <ion-label>Available Government ID</ion-label>
            <ion-item>
              <ion-select v-model="user.ids" mode="ios" placeholder="Select all fruits that apply" :multiple="true">
                <ion-select-option value="National ID">National ID</ion-select-option>
                <ion-select-option value="Driver's License">Driver's License</ion-select-option>
                <ion-select-option value="Passport">Passport</ion-select-option>
              </ion-select>
            </ion-item>
          </ion-col>
        </ion-row>
        <ion-row>
          <ion-col offset="2" size="9">
            <ion-item>
              <ion-label>Date of Birth</ion-label>
              <ion-datetime-button mode="ios" datetime="datetime"></ion-datetime-button>
              <ion-modal mode="ios" :keep-contents-mounted="true">
                <ion-datetime v-model="user.dob" mode="ios" id="datetime"></ion-datetime>
              </ion-modal>
            </ion-item>
          </ion-col>
        </ion-row>
        <ion-row>
          <ion-col offset="2" size="9">
            <ion-button @click="showUserData" color="primary" mode="ios" expand="block">Submit</ion-button>
            <ion-button color="warning" mode="ios" expand="block">Cancel</ion-button>
          </ion-col>
        </ion-row>
      </ion-grid>
    </ion-content>
  </ion-page>
</template>
  
<script>
import { alertController, IonButton, IonDatetime, IonDatetimeButton, IonModal, IonSelect, IonSelectOption, IonTextarea, IonItem, IonLabel, IonInput, IonContent, IonHeader, IonPage, IonTitle, IonToolbar, IonRadio, IonRadioGroup } from '@ionic/vue';
import { defineComponent } from 'vue';


export default defineComponent({
  name: 'HomePage',
  components: {
    IonButton,
    IonDatetime, IonDatetimeButton, IonModal,
    IonSelect, IonSelectOption,
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonLabel,
    IonInput,
    IonItem,
    IonTextarea,
    IonRadio,
    IonRadioGroup
  },
  data() {
    return {
      user: {
        first_name: '',
        last_name: '',
        address: '',
        email: '',
        password: '',
        sex: '',
        ids: [],
        dob: '',
      }
    }
  },
  methods: {
    showUserData() {
      console.log("User=> ", this.user);
      this.$router.push({name: 'Posts'});
    },
    async showAlert() {
      const alert = await alertController.create({
        header: 'Alert',
        subHeader: 'Important message',
        message: 'This is an alert!',
        buttons: ['OK'],
      });

      await alert.present();

      this.user.first_name = '';
    }
  },
  created(){
    console.log("REf=>", this.$refs.last_name_ref);
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
  