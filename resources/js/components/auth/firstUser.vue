<template>
  <div class="p-3">
    <form method="post" @submit.prevent="adduser()">
      <div class="row">
        <div class="col-12 text-center mb-4">
          <h3>First User Registration</h3>
          <hr />
        </div>

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
            <select class="form-control" id="" name="role" v-model="user.role">
              <option value="">Select</option>
              <option value="Store-Keeper">Store Keeper</option>
            </select>

            <small class="text-danger" v-if="errors.role">{{
              errors.role[0]
            }}</small>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-12">
          <div class="form-group text-end">
            <button
              class="btn btn-sm px-3 btn-secondary float-right mr-2"
              data-dismiss="modal"
              ref="cancel_btn"
              type="button"
              @click="clear_data"
            >
              Clear
            </button>
            <button
              class="btn sg btn-sm px-3 btn-primary float-right"
              type="submit"
            >
              Register
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  created() {},

  data() {
    return {
      user: {
        name: "",
        username: "",
        email: "",
        role: "",
        firstUser: "true",
      },

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

    adduser() {
      axios
        .post("./register", this.user)
        .then((response) => {
          if (response.data == "success") {
            this.clear_data();

            Swal.fire(
              "Good job!",
              "User Registration Success!",
              "success"
            ).then(function () {
              window.location.href = "login";
            });
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
