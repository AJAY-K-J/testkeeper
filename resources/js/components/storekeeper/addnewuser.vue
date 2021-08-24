<template>
  <div>
    <form method="post" @submit.prevent="adduser()">
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label>Name</label>
            <input
              type="text"
              class="form-control"
              placeholder="Name"
              name="name"
              v-model="user.name"
            />
            <small class="text-danger" v-if="errors.name">{{
              errors.name[0]
            }}</small>
          </div>
        </div>

        <div class="col-6">
          <div class="form-group">
            <label>User Name</label>
            <input
              type="text"
              class="form-control"
              placeholder="User Name"
              name="username"
              v-model="user.username"
            />
            <small class="text-danger" v-if="errors.username">{{
              errors.username[0]
            }}</small>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label>Email</label>
            <input
              type="email"
              class="form-control"
              placeholder="Email"
              name="email"
              v-model="user.email"
            />
            <small class="text-danger" v-if="errors.email">{{
              errors.email[0]
            }}</small>
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label>Role</label>
            <select class="form-control" name="role" v-model="user.role">
              <option value="">Select role</option>
              <option v-for="roles in role_details" :key="roles.id">
                {{ roles.name }}
              </option>
            </select>

            <small class="text-danger" v-if="errors.role">{{
              errors.role[0]
            }}</small>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12"></div>
        <div v-if="user.role == 'Section-Officer'" class="col-12">
          <div class="form-group">
            <label>Section</label>
            <select
              class="form-control"
              id="section"
              name="section"
              v-model="user.section"
            >
              <option value="">Select section</option>
              <option v-for="section in section_details" :key="section.id">
                {{ section.name }}
              </option>
            </select>

            <small class="text-danger" v-if="errors.section">{{
              errors.section[0]
            }}</small>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-12">
          <div class="form-group text-end">
            <button
              class="btn btn-secondary float-right mr-2"
              data-dismiss="modal"
              ref="cancel_btn"
              type="button"
              @click="clear_data"
            >
              Cancel
            </button>
            <button class="btn btn-primary float-right" type="submit">
              Save
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: ["edit", "role_details"],

  created() {
    this.get_section();
    if (this.edit) {
      var vm = this;
      vm.user.section = "null";
      bus.$on("edit-user", function (lis) {
        vm.clear_data();
        vm.user.id = lis.id;
        vm.user.name = lis.name;
        vm.user.username = lis.username;
        vm.user.email = lis.email;
      });
    }
    var gt = this;
    bus.$on("user-deleted", function () {
      gt.get_section();
    });
  },

  data() {
    return {
      user: {
        name: "",
        username: "",
        email: "",
        section: "",
        role: "",
      },
      section_details: {},

      errors: {},
    };
  },

  methods: {
    clear_data() {
      for (let usr in this.user) {
        this.user[usr] = "";
      }

      for (let er in this.errors) {
        this.errors[er] = null;
      }
    },

    get_section() {
      axios
        .get("/api/section")
        .then((response) => (this.section_details = response.data));
    },

    adduser() {
      axios
        .post("./register", this.user)
        .then((response) => {
          if (response.data == "Success") {
            Swal.fire("New User Added!", "", "success");
            this.$refs.cancel_btn.click();
            this.clear_data();
            this.get_section();
          }

          bus.$emit("user-added");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
