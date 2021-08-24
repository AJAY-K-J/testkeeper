<template>
  <div>
    <form method="post" @submit.prevent="ChangePassword()">
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label>Current Password</label>
            <i class="fa fa-eye show-pass-btn"></i>

            <input
              type="password"
              class="form-control"
              placeholder="Password"
              name="currentPassword"
              v-model="user.currentPassword"
            />

            <small class="text-danger" v-if="errors.currentPassword">{{
              errors.currentPassword[0]
            }}</small>
          </div>
        </div>

        <div class="col-12 mt-2">
          <div class="form-group">
            <label>New Password </label> <i class="fa fa-eye show-pass-btn"></i>

            <input
              type="password"
              class="form-control"
              placeholder="New Password"
              name="password"
              v-model="user.password"
            />

            <small class="text-danger" v-if="errors.password">{{
              errors.password[0]
            }}</small>
          </div>
        </div>

        <div class="col-12 mt-2">
          <div class="form-group">
            <label>Confirm Password</label>
            <input
              type="password"
              class="form-control"
              placeholder="Confirm Password"
              name="password_confirmation"
              v-model="user.password_confirmation"
            />
            <small class="text-danger" v-if="errors.password_confirmation">{{
              errors.password_confirmation[0]
            }}</small>
            <small class="text-danger" v-if="mismatch"
              ><b>Password Mismatch</b></small
            >
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
  created() {},

  data() {
    return {
      user: {
        currentPassword: "",
        password: "",
        password_confirmation: "",
      },
      mismatch: false,
      errors: {},
    };
  },

  methods: {
    check_password() {
      if (this.user.password != this.user.password_confirmation) {
        this.mismatch = true;
      } else {
        this.mismatch = false;
      }
    },

    clear_data() {
      for (let usr in this.user) {
        this.user[usr] = "";
      }

      for (let er in this.errors) {
        this.errors[er] = null;
      }
    },

    ChangePassword() {
      axios
        .post("./change-password", this.user)
        .then((response) => {
          if (response.data.status == 1) {
            const Toast = Swal.mixin({
              toast: true,
              position: "top",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });

            Toast.fire({
              icon: "success",
              title: "Password changed successfully",
            });

            this.$refs.cancel_btn.click();
            this.clear_data();
          } else {
            Swal.fire("Invalid Password!", "Try again", "error");
            this.$refs.cancel_btn.click();
            this.clear_data();
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },

  mounted() {
    $(".show-pass-btn").on("mousedown", function () {
      $(this).siblings("[type=password]").attr("type", "text");
    });

    $(".show-pass-btn").on("mouseup", function () {
      $(this).siblings("[type=text]").attr("type", "password");
    });
  },

  watch: {
    "user.password": function () {
      this.check_password();
    },
    "user.password_confirmation": function () {
      this.check_password();
    },
  },
};
</script>


<style >
.show-pass-btn {
  position: absolute;
  margin-top: 40px;
  right: 20px;
  color: #666;
  z-index: 4;
}

.show-pass-btn:hover {
  cursor: pointer;
  color: #000;
}
</style>
