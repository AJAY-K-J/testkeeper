<template >
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">SUPPLIER LIST</h5>
        </div>
        <div class="col-md-6 text-end">
          <button
            type="button"
            class="btn btn-sm btn-success text-end"
            data-toggle="modal"
            data-target="#add-supplier"
            name=""
          >
            Add New Supplier
          </button>
        </div>
      </div>

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">supplier Name</th>
            <th scope="col">Description</th>
            <th scope="col">GST No</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="supplier in suppliers.data" :key="supplier.id">
            <td scope="row">{{ supplier.id }}</td>
            <td>{{ supplier.name }}</td>
            <td>{{ supplier.Details }}</td>
            <td>{{ supplier.gst }}</td>

            <td v-if="supplier.status == 0">
              <span class="supplierstatus"> Active</span>
            </td>
            <td>
              <button
                type="button"
                class="btn btn-sm btn-light text-end"
                data-toggle="modal"
                data-target="#edit-supplier"
                name=""
                @click="edit_supplier(supplier)"
              >
                <i class="fas fa-edit"> </i>
              </button>
              <button
                class="btn btn-light btn-sm m-0"
                @click="delete_supplier(supplier.id)"
              >
                <i class="fas fa-trash"> </i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      <pagination
        :data="suppliers"
        @pagination-change-page="get_supplier"
      ></pagination>
    </div>

    <!-- Modal -->

    <div
      class="modal fade"
      id="edit-supplier"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">
              EDIT SUPPLIER
            </h5>
            <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>-->
          </div>
          <div class="modal-body">
            <add-new-supplier :edit="true"> </add-new-supplier>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      suppliers: {},
    };
  },

  created() {
    this.get_supplier();
    var vm = this;
    bus.$on("supplier-added", function () {
      vm.get_supplier();
    });
  },

  methods: {
    get_supplier(page = 1) {
      axios
        .get("/api/add_supplier?page=" + page)
        .then((response) => (this.suppliers = response.data));
    },

    edit_supplier(supplier) {
      bus.$emit("edit-supplier", supplier);
    },
    delete_supplier(id) {
      axios.delete("/api/add_supplier/" + id).then((response) => {
        console.log(response);
        if (response.data == "Success") {
          this.get_supplier();
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

.supplierstatus {
  color: green;
}
</style>