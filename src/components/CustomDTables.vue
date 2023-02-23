<script>
/* eslint-disable */ 
export default {
  props: {
    columns: Array,
    rows: Array
  },
  mounted(){
    console.log("Rows=> ", this.rows, "Cols=> ", this.columns)
  }
}
</script>

<template>
  <table width="100%">
    <thead>
      <tr>
        <th style="padding: 12px 7px; text-align:center;" v-for="(col,i) in columns" :key="i">{{ col.label }}</th>
      </tr>
    </thead>
    <tbody>
      <tr class="row" v-for="row in rows" :key="row.id">
        <td :style="`padding: 10px 5px; text-align: ${col.hasOwnProperty('justify') ? col.justify : 'left'};`" v-for="(col,i) in columns" :key="i">
          {{ row[col.key]}}
        </td>
      </tr>
    </tbody>
  </table>
</template>

<style scoped>
tr.row:hover {
  background-color:#d2d2d2;
  transition-duration: 800ms;
}

table, td, th {
  border: 1px solid gray;
  border-collapse: collapse;
}

table {
  border-radius: 25px;
}
</style>