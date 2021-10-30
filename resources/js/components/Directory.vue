<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card"> 
                    <div class="card-header">
                        Directory
                    </div>
                    <div class="card-body">
                        {{msgSuc}}
                        <div class="form-group"> 
                            <label for="name" >Name</label>
                            <input type="text" 
                            id="name"
                            placeholder="Enter your name"
                            class="form-control"
                            v-model="item.name"
                            >

                        </div>
                        <div class="form-group"> 
                            <label for="phone" >Phone</label>
                            <input type="text" 
                            id="phone"
                            placeholder="Enter your phone"
                            class="form-control"
                            v-model="item.phone"
                            > 
                        </div>
                         <div class="form-group"> 
                            <label for="email" >Email</label>
                            <input type="text" 
                            id="email"
                            placeholder="Enter your email"
                            class="form-control"
                            v-model="item.email"
                            > 
                        </div>
                        <button class="btn btn-sm btn-success btn-block" @click="savetel">Save</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center" v-if="lists.length > 0">
            <div class="col-md-8">
                <div class="card"> 
                    <div class="card-header">
                        View Directory
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>
                                   Sl
                                </th>
                                <th>
                                    Name
                                </th>
                                    <th>
                                    Phone
                                </th>
                                    <th>
                                    Email
                                </th>
                                <th>
                                   Action
                                </th>
                            </tr>
                            <tr v-for="item in lists" :key="item.id">
                                <td> 
                                    {{item.id}}
                                </td>
                                <td> 
                                    {{item.name}}
                                </td>
                                <td> 
                                    {{item.phone}}
                                </td>
                                <td> 
                                    {{item.email}}
                                </td>
                                <td> 
                                    <button class="btn btn-warning btn-sm mr-2">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Directory",
        data(){
            return{
                lists: [],
                item:{
                    name:"",
                    phone:"",
                    email:"",

                },
                msgSuc: ""
            }
        },
        mounted() {
            this.fetchAll();
        },
        methods: {
            fetchAll(){
              axios.get('api/tel')
              .then(res => this.lists = res.data)  
            },
            savetel(){
                try{
                    axios.post('api/tel', this.item)
                    .then(res=>{
                        this.item = {
                            name:"",
                            phone:"",
                            email:"", 
                        };
                        this.msgSuc ="Save Successfully";
                    })
                }
                catch(e){
                    console.log(e);
                }
            }
        }
        
    }
</script>