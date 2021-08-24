<template >
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">ROLE LIST</h5>
        </div>
        <div class="col-md-6 text-end"></div>
      </div>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>

          <th scope="col">Role Name</th>

          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="role in roles" :key="role.id">
          <td scope="row">{{ role.id }}</td>
          <td>{{ role.name }}</td>

          <td v-if="role.status == 0">
            <span class="rolestatusIdle">Idle</span>
          </td>
          <td v-if="role.status == 1">
            <span class="rolestatus">Active</span>
          </td>
          <!-- 
          <td>
            <button
              type="button"
              class="btn btn-sm btn-light text-end"
              data-toggle="modal"
              data-target="#edit-role"
              name=""
              @click="edit_role(role)"
            >
              <i class="fas fa-edit"></i>
            </button>
            <button
              class="btn btn-light btn-sm m-0"
              @click="delete_role(role.id)"
            >
              <i class="fas fa-trash"> </i>
            </button>
          </td> -->
        </tr>

        <tr v-if="roles.length == 0">
          <td colspan="100%" class="text-center boldmsg">
            {{ loading ? "Loading..." : "No Roles Added" }}
          </td>
        </tr>

        <tr v-if="roles.length == 0">
          <td colspan="100%" class="text-center">
            <button
              type="button"
              class="btn btn-sm btn-success text-end px-4"
              @click="add_roles()"
            >
              <span class="adduserspan">Add Roles</span>
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modal -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      roles: {},

      roleInput: {
        store_keeper: "Store-Keeper",
        section_officer: "Section-Officer",
        store_officer: "Store-Officer",
        gem_consignee: "GeM-Consignee",
        head_ofiice: "SAS",
      },
    };
  },

  created() {
    this.get_role();
    var vm = this;
    bus.$on("role-added", function () {
      vm.get_role();
    });
  },

  methods: {
    add_roles() {
      this.loading = true;
      axios
        .post("./add_role", this.roleInput)
        .then((response) => {
          if (response.data == "Success") {
          }

          this.get_role();
        })
        .catch((error) => {
          this.loading = false;
          console.log(error.response.data);
        });
    },

    get_role() {
      axios
        .get("/api/add_role")
        .then((response) => (this.roles = response.data));
    },

    delete_role(id) {
      axios.delete("/api/add_role/" + id).then((response) => {
        console.log(response);
        if (response.data == "Success") {
          this.get_role();
        }
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

.rolestatus {
  color: green;
}
.rolestatusIdle {
  color: rgb(204, 38, 8);
}

.adduserspan {
  font-weight: bold;
}
.boldmsg {
  font-weight: bold;
}
</style>