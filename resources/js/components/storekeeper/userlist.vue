<template >
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">USERS LIST</h5>
        </div>
        <div class="col-md-6 text-end">
          <button
            type="button"
            class="btn btn-sm btn-success text-end"
            data-toggle="modal"
            data-target="#add-user"
            name=""
          >
            Add New User
          </button>
        </div>
      </div>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>

          <th scope="col">Name</th>
          <th scope="col">User Name</th>
          <th scope="col">Email</th>
          <th scope="col">Section</th>
          <th scope="col">Role</th>
          <th scope="col">Status</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="lis in list" :key="lis.id">
          <td scope="row">{{ lis.id }}</td>
          <td>{{ lis.name }}</td>
          <td>{{ lis.username }}</td>
          <td>{{ lis.email }}</td>
          <td>{{ lis.section }}</td>
          <td>{{ lis.role }}</td>

          <td v-if="lis.status == 0">
            <span class="userstatus"> Active</span>
          </td>
          <td v-if="lis.status == 2"><span class="removed"> Removed</span></td>
          <td>
            <!-- <button
              type="button"
              class="btn btn-sm btn-success text-end"
              data-toggle="modal"
              data-target="#edit-user"
              name=""
              @click="edit_user(lis)"
            >
              edit
            </button>-->
            <button
              class="btn btn-light btn-sm m-0"
              @click="delete_user(lis.id)"
            >
              <i class="fas fa-trash"> </i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modal -->

    <div
      class="modal fade"
      id="edit-user"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">EDIT USER</h5>
            <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>-->
          </div>
          <div class="modal-body">
            <add-new-user :role_details="role_details" :edit="true">
            </add-new-user>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["role_details"],
  data() {
    return {
      list: {},
    };
  },

  created() {
    this.get_user();
    var vm = this;
    bus.$on("user-added", function () {
      vm.get_user();
    });
  },

  methods: {
    get_user() {
      axios.get("/api/adduser").then((response) => (this.list = response.data));
    },

    edit_user(lis) {
      bus.$emit("edit-user", lis);
    },
    delete_user(id) {
      axios.delete("/api/delete/" + id).then((response) => {
        console.log(response);
        if (response.data == "Success") {
          this.get_user();
        }

        bus.$emit("user-deleted");
      });
    },
  },
};
</script>

<style>
.table thead th {
  font-weight: bold;
  color: black;
}

.userstatus {
  color: green;
  font-weight: bold;
}

.removed {
  color: rgb(182, 61, 5);
  font-weight: bold;
}
</style>