<template >
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">CATEGORY LIST</h5>
        </div>
        <div class="col-md-6 text-end">
          <button
            type="button"
            class="btn btn-sm btn-success text-end"
            data-toggle="modal"
            data-target="#add-category"
            name=""
          >
            Add New Category
          </button>
        </div>
      </div>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>

          <th scope="col">Category Name</th>

          <th scope="col">Status</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="cat in category" :key="cat.id">
          <td scope="row">{{ cat.id }}</td>
          <td>{{ cat.name }}</td>

          <td v-if="cat.status == 0">
            <span class="Categorystatus"> Active</span>
          </td>
          <td>
            <button
              type="button"
              class="btn btn-sm btn-light text-end"
              data-toggle="modal"
              data-target="#edit-category"
              name=""
              @click="edit_category(cat)"
            >
              <i class="fas fa-edit"> </i>
            </button>
            <button
              class="btn btn-light btn-sm m-0"
              @click="delete_category(cat.id)"
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
      id="edit-category"
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
              EDIT CATEGORY
            </h5>
            <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>-->
          </div>
          <div class="modal-body">
            <add-new-category :edit="true"> </add-new-category>
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
      category: {},
    };
  },

  created() {
    this.get_category();
    var vm = this;
    bus.$on("category-added", function () {
      vm.get_category();
    });
  },

  methods: {
    get_category() {
      axios
        .get("/api/add_category")
        .then((response) => (this.category = response.data));
    },

    edit_category(category) {
      bus.$emit("edit-category", category);
    },
    delete_category(id) {
      axios.delete("/api/add_category/" + id).then((response) => {
        console.log(response);
        if (response.data == "Success") {
          this.get_category();
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

.Categorystatus {
  color: green;
}
</style>