<template>
  <div>
    <form method="post" @submit.prevent="addsupplier()">
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label>Supplier Name</label>
            <input
              type="text"
              class="form-control"
              placeholder="Name"
              name="name"
              v-model="suppliers.name"
            />
            <small class="text-danger" v-if="errors.name">{{
              errors.name[0]
            }}</small>
          </div>
        </div>

        <div class="col-6">
          <div class="form-group">
            <label>GST No</label>
            <input
              type="text"
              class="form-control"
              placeholder="GST No"
              name="gst"
              v-model="suppliers.gst"
            />
            <small class="text-danger" v-if="errors.gst">{{
              errors.gst[0]
            }}</small>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label>Details</label>
            <textarea
              class="form-control form-height"
              name="Details"
              placeholder="Details"
              v-model="suppliers.Details"
            ></textarea>
          </div>

          <small class="text-danger" v-if="errors.Details">{{
            errors.Details[0]
          }}</small>
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
      bus.$on("edit-supplier", function (supplier) {
        vm.clear_data();
        vm.suppliers.id = supplier.id;
        vm.suppliers.name = supplier.name;
        vm.suppliers.Details = supplier.Details;
        vm.suppliers.gst = supplier.gst;
      });
    }
  },

  data() {
    return {
      suppliers: {
        name: "",
        Details: "",
        gst: "",
      },
      errors: {},
    };
  },

  methods: {
    clear_data() {
      for (let supplier in this.suppliers) {
        this.suppliers[supplier] = null;
      }

      for (let er in this.errors) {
        this.errors[er] = null;
      }
    },

    addsupplier() {
      axios
        .post("./api/add_supplier", this.suppliers)
        .then((response) => {
          if (response.data == "Success") {
            Swal.fire("New Supplier Added!", "", "success");
            this.$refs.cancel_btn.click();
            this.clear_data();
          }

          bus.$emit("supplier-added");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
