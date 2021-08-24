<template>
  <div>
    <form method="post" @submit.prevent="addsection()">
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label>Section Name</label>
            <input
              type="text"
              class="form-control"
              placeholder="Name"
              name="name"
              v-model="sections.name"
            />
            <small class="text-danger" v-if="errors.name">{{
              errors.name[0]
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
  props: ["edit"],

  created() {
    if (this.edit) {
      var vm = this;
      bus.$on("edit-section", function (section) {
        vm.clear_data();
        vm.sections.id = section.id;
        vm.sections.name = section.name;
      });
    }
  },

  data() {
    return {
      sections: {
        name: "",
      },
      errors: {},
    };
  },

  methods: {
    clear_data() {
      for (let section in this.sections) {
        this.sections[section] = null;
      }

      for (let er in this.errors) {
        this.errors[er] = null;
      }
    },

    addsection() {
      axios
        .post("./api/add_section", this.sections)
        .then((response) => {
          console.log(response);
          if (response.data == "Success") {
            Swal.fire("New Section Added!", "", "success");
            this.$refs.cancel_btn.click();
            this.clear_data();
          }

          bus.$emit("section-added");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
