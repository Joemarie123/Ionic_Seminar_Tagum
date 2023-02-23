<template>
  <div >
    <h1 
      @mouseover="color='green'"
      @mouseout="color='blue'" 
      :style="{ color: color}"
    >The count value is {{ count }}.</h1>

    <button 
      :class="{ 'bg-red': isDisabled }" 
      :disabled="isDisabled" 
      @click="count++; 
      isDisabled = true"
    >Increase</button>
    
    <p>There are {{ names.length }} name/s.</p>
    <p>{{ `There are ${names.length} name/s.` }}</p>
    <!-- <a v-if="color == 'green'" :href="url">{{ url }}</a> -->

    <div v-if="age > 18">Age is greater than 18</div>
    <div v-else-if="age > 15">Age is greater than 15 and less than or equal 18</div>
    <div v-else>
      Age is 15 and below.
    </div>



    <input type="text" @keypress.enter="enterKeyPressed" />

    <ul>
      <li 
        v-for="(name, i) in names"
        :key="i"  
      >{{ name }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      count: 0,
      names: ['Matthew', 'Mark','Luke', 'Kennedy'],
      user: {
        first_name: 'John',
        last_name: 'Doe',
        email: 'johndoe@email.com'
      },
      comment: "HEllo world",
      url: "youtube.com",
      isDisabled: false,
      color: 'blue',
      age: 15,
    }
  },
  methods: {
    enterKeyPressed(){
      alert("Enter key is pressed.");
    },
  },
  created() {
    alert('Created!');
  },
  updated() {
    alert('Updated!');
  },  
  mounted(){
    alert('Mounted!');
  },  
  beforeCreate(){
    alert('BeforeCreate!');
  }
}
</script>

<style scoped>
.bg-red {
  background-color:#fc3030;
}
</style>