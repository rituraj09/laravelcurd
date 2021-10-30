<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form @submit="savetel">
          <div class="card">
            <div class="card-header">Directory</div>
            <div class="card-body">
              {{ msgSuc }}
              <div class="form-group">
                <label for="name">Name</label>
                <input
                  type="text"
                  id="name"
                  placeholder="Enter your name"
                  class="form-control"
                  v-model="item.name"
                />
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input
                  type="text"
                  id="phone"
                  placeholder="Enter your phone"
                  class="form-control"
                  v-model="item.phone"
                />
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input
                  type="text"
                  id="email"
                  placeholder="Enter your email"
                  class="form-control"
                  v-model="item.email"
                />
              </div>
               <div v-if="error.length>0" class="form-group text-danger">
                   <h3>Please fix the following errors</h3>
                   <ul>
                       <li v-for="e in error" v-bind:key="e.id">
                            {{e}}
                       </li>
                   </ul>
              </div>
              <button class="btn btn-sm btn-success btn-block">
                {{ isEditing ? "Update" : "Save" }}
              </button>
              <button
                class="btn btn-sm btn-danger btn-block"
                @click="canceEdit"
                v-bind:class="[isEditing ? 'show' : 'hide']"
              >
                Cancel
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="row justify-content-center" v-if="lists.length > 0">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">View Directory</div>
          <div class="card-body">
            <table class="table table-bordered">
              <tr>
                <th>Sl</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
              <tr v-for="(item, index) in lists" :key="item.id">
                <td>
                  {{ index + 1 }}
                </td>
                <td>
                  {{ item.name }}
                </td>
                <td>
                  {{ item.phone }}
                </td>
                <td>
                  {{ item.email }}
                </td>
                <td>
                  <button
                    @click="editTel(item)"
                    class="btn btn-warning btn-sm mr-2"
                  >
                    Edit
                  </button>
                  <button
                    @click="deleteTel(item.id)"
                    class="btn btn-danger btn-sm"
                  >
                    Delete
                  </button>
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
  data() {
    return {
      lists: [],
      error: [],
      item: {
        name: "",
        phone: "",
        email: "",
      },
      msgSuc: null,
      temp_id: null,
      isEditing: false,
    };
  },
  mounted() {
    this.fetchAll();
  },
  methods: {
    fetchAll() {
      axios.get("api/tel").then((res) => (this.lists = res.data));
    },
    savetel(e) {
       this.error=[];
      e.preventDefault();
      if (this.item.name == "") {
          this.error.push("Enter your Name");  
      }
      if (this.item.phone == "") {
         this.error.push("Enter your phone"); 
      }
      if (this.item.email == "") {
         this.error.push("Enter your email"); 
      }
      if(this.error.length>0)
      {
          return false;
      }
      let method = axios.post;
      let url = "api/tel";
      let msg = "Save Successfully";
      if (this.isEditing) {
        method = axios.put;
        url = "api/tel/" + this.temp_id;
        msg = "Update Successfully.";
      }
      try {
        method(url, this.item).then((res) => {
          this.item = {
            name: "",
            phone: "",
            email: "",
          };
          this.msgSuc = msg;
          this.fetchAll();
          this.temp_id = null;
          this.isEditing = false;
          this.error=[];
        });
      } catch (e) {
        console.log(e);
      }
    },
    editTel(tel) {
      this.item = {
        name: tel.name,
        phone: tel.phone,
        email: tel.email,
      };
      this.temp_id = tel.id;
      this.isEditing = true;
      this.msgSuc = null;
        this.error=[];
    },
    canceEdit(e) {
    this.error=[];
      e.preventDefault();
      this.item = {
        name: "",
        phone: "",
        email: "",
      };
      this.temp_id = null;
      this.isEditing = false;
      this.msgSuc = null;
      
    },
    deleteTel(id) {
      try {
        axios.delete("api/tel/" + id).then((res) => {
          this.fetchAll();
          this.msgSuc = "Delete Successfully";
          this.error=[];
        });
      } catch (e) {
        console.log(e);
      }
    },
  },
};
</script>
<style scoped>
.show {
  visibility: visible;
}
.hide {
  visibility: hidden;
}
</style>