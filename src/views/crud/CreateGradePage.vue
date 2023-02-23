<template>
  <ion-page>
    <ion-header :translucent="true">
      <ion-toolbar>
        <ion-title>New Grade</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">New Grade</ion-title>
        </ion-toolbar>
      </ion-header>
      <ion-grid>
        <ion-row>
          <ion-col offset="2" size="8">
            <h2>Adding a new grade for {{ user.first_name + ' ' + user.last_name }}.</h2>
          </ion-col>
        </ion-row>
        <ion-row>
          <ion-col offset="2" size="8">
            <form @submit.prevent="saveGrade">
              <ion-item>
                <ion-label position="floating">Subject name</ion-label>
                <ion-input required v-model="subject" placeholder="Enter the subject name"></ion-input>
              </ion-item>
              <ion-item>
                <ion-label position="floating">Grade</ion-label>
                <ion-input required v-model="grade" type="number" placeholder="Enter the grade"></ion-input>
              </ion-item>
              <ion-item>
                <ion-label position="floating">Remarks</ion-label>
                <ion-input v-model="remarks" disabled="true" placeholder="Remarks"></ion-input>
              </ion-item>
              <ion-button type="submit" mode="ios" fill="outline" expand="block">Save Grade</ion-button>
            </form>
          </ion-col>
        </ion-row>
      </ion-grid>
    </ion-content>
  </ion-page>
</template>
  
<script>
import {
  IonInput, IonItem, IonLabel,
  IonButton,
  IonContent, IonHeader, IonPage, IonTitle, IonToolbar
} from '@ionic/vue';
import { defineComponent } from 'vue';
import { mapGetters, mapActions } from 'vuex';

export default defineComponent({
  name: 'CreateGradePage',
  data() {
    return {
      user: {},
      subject: '',
      grade: 0,
      remarks: '',
      action: '',
      grade_id: '',
    }
  },
  components: {
    IonInput, IonItem, IonLabel,
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonButton
  },
  computed: {
    ...mapGetters('users', {
      users: 'getUsers',
    }),
  },
  watch: {
    grade(newGrade) {
      if (newGrade > 74)
        this.remarks = 'PASSED';
      else this.remarks = 'FAILED';
    }
  },
  methods: {
    ...mapActions('grades', [
      'newGrade',
      'updateGrade'
    ]),
    ...mapActions('users', [
      'fetchUsers'
    ]),
    navigateTo(path) {
      this.$router.push({ 'path': path });
    },
    saveGrade() {
      const { subject, grade, remarks } = this;
      const { user_id } = this.$route.params;
      if (this.action == 'new') {
        this.newGrade({
          user_id,
          subject,
          grade,
          remarks
        }).then((e) => {
          if (e == 1)
            this.fetchUsers().then(() => this.$router.go(-1)).catch(e => console.log(e.message));
        }).catch(e => console.log(e.message));
      } else {
        const { grade_id } = this;
        this.updateGrade({
          user_id,
          grade_id,
          subject,
          grade,
          remarks
        }).then( e => {
          if (e.status == 1)
            this.fetchUsers().then(() => this.$router.go(-1)).catch( e => console.log(e.message));
        })
        .catch( e => console.log("Error=> ", e));
      }

    }
  },
  created() {
    console.log("Parameter=> ", this.$route.params, this.$route.params.grade_id);

    const { user_id } = this.$route.params;
    this.user = this.users.find(e => e.id == user_id);

    this.action = 'new';

    if (this.$route.params.grade_id != undefined) {
      let grade = this.user.grades.find(grade => grade.id == this.$route.params.grade_id);
      this.grade = grade.grade;
      this.remarks = grade.remarks;
      this.subject = grade.subject;
      this.action = 'update';
      this.grade_id = grade.id;
    }

    this.remarks = this.grade > 74 ? 'PASSED' : 'FAILED';
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
  