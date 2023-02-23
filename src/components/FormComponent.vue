<template>
  <div>
    <h2>Form Input</h2>
    <form @submit.prevent="formSubmit">
      <input v-model="title" placeholder="Title" type="text" class="title" />
      <textarea v-model="body" placeholder="Body" cols="30" class="body" rows="10"></textarea>
      <button class="save-btn" type="submit">Save</button>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    post_prop: Object,
    isCreate: Number,
  },
  data() {
    return {
      title: '',
      body: '',
      id: '',
    }
  },
  methods: {
    formSubmit() {
      console.log("Title=>", this.title);
      console.log("Body=>", this.body);
      this.$emit('onFormSubmit', { 
        title: this.title,
        body: this.body,
        id: this.isCreate == 3 ? this.id : Math.round(Math.random() * 1000)
      });

      this.resetFields();
    }, 
    resetFields(){
      this.title = '';
      this.body = '';
      this.id = '';
    }
  },
  updated() {
    console.log("PostProp=> ", this.post_prop);
    console.log("isCreate=>", this.isCreate);

    if (this.isCreate == 2){
      this.title = this.post_prop.title;
      this.body = this.post_prop.body;
      this.id = this.post_prop.id;
      this.$emit('updateIsCreate', 3);
    }

  }
}
</script>


<style scoped>
.save-btn {
  width: 100%;
  margin: 5px 10px;
  padding-top: 10px;
  padding-bottom: 10px;
}
.title, .body {
  width: 100%;
  padding: 2px;
  border: none;
  margin: 5px 10px;
  border-bottom: 4px solid #fc3030;
}

</style>