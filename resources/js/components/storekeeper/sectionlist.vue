<template >
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">SECTION LIST</h5>
        </div>
        <div class="col-md-6 text-end">
          <button
            type="button"
            class="btn btn-sm btn-success text-end"
            data-toggle="modal"
            data-target="#add-section"
            name=""
          >
            Add New Section
          </button>
        </div>
      </div>
    </div>
    <table class="table text-center table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>

          <th scope="col">Section Name</th>

          <th scope="col">Status</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="section in sections" :key="section.id">
          <td scope="row">{{ section.id }}</td>
          <td>{{ section.name }}</td>

          <td v-if="section.status == 1">
            <span class="sectionstatus"> Active</span>
          </td>
          <td v-if="section.status == 0">
            <span class="sectionstatus0"> Idle</span>
          </td>
          <td>
            <button
              type="button"
              class="btn btn-sm btn-light text-end"
              data-toggle="modal"
              data-target="#edit-section"
              name=""
              @click="edit_section(section)"
            >
              <i class="fas fa-edit"> </i>
            </button>
            <button
              class="btn btn-light btn-sm m-0"
              @click="delete_section(section.id)"
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
      id="edit-section"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">EDIT SECTION</h5>
            <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>-->
          </div>
          <div class="modal-body">
            <add-new-section :edit="true"> </add-new-section>
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
      sections: {},
    };
  },

  created() {
    this.get_section();
    var vm = this;
    bus.$on("section-added", function () {
      vm.get_section();
    });
  },

  methods: {
    get_section() {
      axios
        .get("/api/add_section")
        .then((response) => (this.sections = response.data));
    },

    edit_section(section) {
      bus.$emit("edit-section", section);
    },
    delete_section(id) {
      axios.delete("/api/add_section/" + id).then((response) => {
        console.log(response);
        if (response.data == "Success") {
          this.get_section();
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

.sectionstatus {
  color: green;
}
.sectionstatus0 {
  color: rgb(163, 11, 74);
}
</style>