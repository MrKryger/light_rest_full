<template>
<div id="app">
  <table class="table  mb-1">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Note</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item,key) in items" :key="key">
                <td>{{item.id}}</td>
                <td>{{item.text}}</td>
                <td>{{item.date}}</td>
                <td>
                    <button type="button" class="btn btn-outline-danger btn-sm" @click="del(item.id)">Del</button>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-primary btn-sm" @click="open(item.id)">Edit</button>
                </td>
            </tr>
            </tbody>
    </table>
        <div class="flex mb-1">
          <textarea rows="4" class="form-control mr-1" v-model="text" placeholder="Add Notes"></textarea>
          <button type="button" class="btn btn-outline-primary btn-sm" @click="add()">Add Note</button>
        </div>

        <div class="flex" v-if="item.id">
          <textarea rows="4" class="form-control mr-1" v-model="item.text" placeholder="Edit"></textarea>
          <button type="button" class="btn btn-outline-primary btn-sm" @click="setData(item)">Edit Note</button>
        </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'App',
        data: () => ({
                items: {},
                item: {},
                text: '',
        }),
        mounted() {
          this.getData()
        },
        methods: {
           getData () {
                axios.get('http://localhost/backend/api/read.php').then((res) => {
                this.items =res.data.body || []
            })
           },
          add () {
                let body = {
                  text: this.text
                }
                axios.post('http://localhost/backend/api/create.php',body).then(() => {
                this.getData()
            })
           },
          setData (body) {
                axios.post('http://localhost/backend/api/update.php',body).then(() => {
                   this.getData()
                   this.item ={}
            })
           },
          open (id) {
                axios.get(`http://localhost/backend/api/single_read.php/?id=${id}`).then((res) => {
                this.item =res.data || []
            })  
            },
          del (id) {
                axios.post('http://localhost/backend/api/delete.php',{ id }).then(() => {
                this.getData()
            })
            }
        }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.table {
    border: 1px solid gray;
    width: 100%;
    border-radius: 5px;
    /* padding: 20px; */
}
thead {
  background-color: burlywood;
}
.mb-1 {
  margin-bottom: 16px;
}
.mr-1 {
  margin-right: 20px;
}
.flex {
  display: flex;
  align-items: center;
  width: 100%;
}
.form-control {
  width: 500px;
}
</style>
