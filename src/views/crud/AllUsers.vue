<template>
  <ion-page>
    <ion-header :translucent="true">
      <ion-toolbar>
        <ion-title>All Users</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">All Users</ion-title>
        </ion-toolbar>
      </ion-header>

      <ion-grid>
        <ion-row>
          <ion-col offset="2" size="8">
            <!-- <custom-d-tables
              :columns="columns"
            /> -->
            <CustomDTable
              :columns="columns"
              :rows="rows"
            />
          </ion-col>
        </ion-row>
      </ion-grid>
    </ion-content>
  </ion-page>
</template>
  
<script>
/* eslint-disable */


import { IonButton, IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from '@ionic/vue';
import { mapActions, mapGetters } from "vuex";

import CustomDTable from "../../components/CustomDTables";


export default {
  name: 'HomePage',
  components: {
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonButton,

    CustomDTable
  },
  data() {
    return {
      columns: [
        {
          key: 'id',
          label: 'ID',
          justify: 'center'
        },
        {
          key: 'first_name',
          label: 'First Name'
        },
        {
          key: 'last_name',
          label: 'Last Name'
        },
        {
          key: 'email',
          label: 'Email',
          justify: 'center'
        },
        {
          key: 'no_of_grades',
          label: '# of Grades',
          justify: 'center'
        }
      ],
      rows: [],
    }
  },
  computed: {
    ...mapGetters('users', {
      users: 'getUsers'
    }),
  },
  methods: {
    ...mapActions('users', ['fetchUsers']),
    navigateTo(path) {
      this.$router.push({ 'path': path });
    }
  },

  created() {
    this.fetchUsers().then(() => {
      this.users.forEach(user => {
        this.rows.push({
          id : user.id,
          first_name: user.first_name,
          last_name: user.last_name,
          email: user.email,
          no_of_grades: user.grades.length
        });
      })
    });
 
  },
}
</script>
  
<style scoped>

</style>
  