<template>
  <div>
    <form method="post" @submit.prevent="addcategory()">
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label>Category Name</label>
            <input
              type="text"
              class="form-control"
              placeholder="Name"
              name="name"
              v-model="category.name"
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
      bus.$on("edit-category", function (cat) {
        vm.clear_data();
        vm.category.id = cat.id;
        vm.category.name = cat.name;
      });
    }
  },

  data() {
    return {
      category: {
        name: "",
      },
      errors: {},
    };
  },

  methods: {
    clear_data() {
      for (let cat in this.category) {
        this.category[cat] = null;
      }

      for (let er in this.errors) {
        this.errors[er] = null;
      }
    },

    addcategory() {
      axios
        .post("./api/add_category", this.category)
        .then((response) => {
          console.log(response);
          if (response.data == "Success") {
            Swal.fire("New Category Added!", "", "success");
            this.$refs.cancel_btn.click();
            this.clear_data();
          }

          bus.$emit("category-added");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
