<template>
  <div>
    <form method="post" @submit.prevent="additem()">
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label>Item Name</label>
            <input
              type="text"
              class="form-control"
              placeholder="Name"
              name="name"
              v-model="items.name"
            />
            <small class="text-danger" v-if="errors.name">{{
              errors.name[0]
            }}</small>
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label>Category Name</label>

            <select
              class="form-control"
              name="category_name"
              v-model="items.category_name"
            >
              <option value="">Select category</option>
              <option v-for="category in category_details" :key="category.id">
                {{ category.name }}
              </option>
            </select>

            <small class="text-danger" v-if="errors.category_name">{{
              errors.category_name[0]
            }}</small>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="remarks" class="control-label col-form-label"
              >Description of item</label
            >
            <div class="col-sm-9">
              <textarea
                class="form-control form-height"
                name="description_item"
                v-model="items.description_item"
              ></textarea>
            </div>

            <small class="text-danger" v-if="errors.description_item">{{
              errors.description_item[0]
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
  props: ["edit", "category_details"],

  created() {
    if (this.edit) {
      var vm = this;
      bus.$on("edit-item", function (item) {
        vm.clear_data();
        vm.items.id = item.id;
        vm.items.name = item.name;

        vm.items.description_item = item.description_item;
      });
    }
  },

  data() {
    return {
      items: {
        name: "",
        category_name: "",
        description_item: "",
      },
      errors: {},
    };
  },

  methods: {
    clear_data() {
      for (let item in this.items) {
        this.items[item] = null;
      }

      for (let er in this.errors) {
        this.errors[er] = null;
      }
    },

    additem() {
      axios
        .post("./api/add_item", this.items)
        .then((response) => {
          console.log(response);
          if (response.data == "Success") {
            Swal.fire("New Item Added!", "", "success");

            this.$refs.cancel_btn.click();
            this.clear_data();
          }

          bus.$emit("item-added");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
