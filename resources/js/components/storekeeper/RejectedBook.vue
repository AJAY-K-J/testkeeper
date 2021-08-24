<template>
  <div class="card">
    <div class="card-body">
      <!--Export  modal -->

      <div
        class="modal fade exportRejectedModal"
        tabindex="-1"
        role="dialog"
        id=""
        data-backdrop="static"
      >
        <div class="modal-dialog modal-xl" tabindex="-1" role="dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title title my-0">EXPORT OPTIONS</h3>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
                @click="exportRejectedClose()"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <export-rejected></export-rejected>
            </div>
          </div>
        </div>
      </div>

      <!--Export  modal -->
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">Rejected Items</h5>
        </div>
        <div class="col-md-6 text-end">
          <button
            v-if="search == false"
            type="button"
            class="btn btn-sm btn-secondary"
            data-toggle="modal"
            @click="show_filter()"
          >
            Add Filters
          </button>
          <button
            type="button"
            class="btn btn-sm btn-secondary"
            data-toggle="modal"
            data-target=".exportRejectedModal"
            @click="exportRejected()"
          >
            Export
          </button>
        </div>
      </div>

      <div class="row mt-4" v-if="search">
        <h4 class="card-title text-center">
          <b>Filter Data</b>
        </h4>
        <div class="card-body align-items-center">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Date From</label>
                <input
                  type="date"
                  class="form-control"
                  name="date_from"
                  v-model="filter.date_from"
                />
                <small class="text-danger" v-if="errors.date_from">{{
                  errors.date_from[0]
                }}</small>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label>Date To</label>
                <input
                  type="date"
                  class="form-control"
                  name="Date_to"
                  v-model="filter.date_to"
                />
                <small class="text-danger" v-if="errors.date_to">{{
                  errors.date_to[0]
                }}</small>
              </div>
            </div>

            <div class="col-2">
              <div class="form-group">
                <label>supplier Name</label>

                <select
                  class="form-control"
                  name="supplier"
                  v-model="filter.supplier"
                >
                  <option value="">Select name</option>
                  <option
                    v-for="supplier in supplier_details"
                    :key="supplier.id"
                    v-bind:value="supplier.id"
                  >
                    {{ supplier.name }}
                  </option>
                </select>

                <small class="text-danger" v-if="errors.supplier">{{
                  errors.supplier[0]
                }}</small>
              </div>
            </div>

            <div class="col-2">
              <div class="form-group">
                <label>Entry Type</label>

                <select
                  class="form-control"
                  name="entry"
                  v-model="filter.entry"
                >
                  <option value="">Select type</option>
                  <option value="Local entry">Local entry</option>
                  <option value="Gem-consignee">Gem-consignee</option>
                </select>

                <small class="text-danger" v-if="errors.entry">{{
                  errors.entry[0]
                }}</small>
              </div>
            </div>

            <div class="col-2">
              <div class="form-group">
                <label>Section Name</label>

                <select
                  class="form-control"
                  name="section"
                  v-model="filter.section"
                >
                  <option value="">Select name</option>
                  <option
                    v-for="sections in section_details"
                    :key="sections.id"
                    v-bind:value="sections.id"
                  >
                    {{ sections.name }}
                  </option>
                </select>

                <small class="text-danger" v-if="errors.section">{{
                  errors.section[0]
                }}</small>
              </div>
            </div>

            <div class="col-2">
              <button
                class="btn btn-primary btn-sm px-5 mb-2"
                @click="Set_filter()"
              >
                Filter
              </button>

              <button
                class="btn btn-primary btn-sm px-5"
                @click="hide_filter()"
              >
                Clear
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive-sm">
        <table class="table text-center table-hover table-danger table-sm mt-4">
          <thead>
            <tr>
              <th scope="col">#</th>

              <th scope="col">Date</th>
              <th scope="col">Item</th>
              <th scope="col">Description of item</th>
              <th scope="col">Quantity</th>
              <th scope="col">Rejected Quantity</th>
              <th scope="col">Invoice No</th>
              <th scope="col">Disposed Status</th>
              <th scope="col">Remarks</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="rejected in rejected_details.data" :key="rejected.id">
              <td>{{ rejected.id }}</td>

              <td>{{ convert_date(rejected.date) }}</td>

              <td>{{ rejected.item_name }}</td>

              <td>{{ rejected.description_item }}</td>

              <td>{{ rejected.quantity }}</td>
              <td>{{ rejected.rejectedquantity }}</td>

              <td>{{ rejected.invoice }}</td>

              <td v-if="rejected.disposedstatus == 0">
                <span class="spanPending">Pending</span>
              </td>
              <td v-if="rejected.disposedstatus == 1">
                <span class="spandisposed">Disposed</span>
              </td>
              <td>{{ rejected.remarks }}</td>
              <td>
                <button
                  type="button"
                  class="btn btn-sm btn-secondary"
                  data-toggle="modal"
                  data-target=".rejectedPageview"
                  @click="view_rejected(rejected)"
                >
                  view
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer">
      <pagination
        :data="rejected_details"
        @pagination-change-page="get_rejected_details"
        :limit="3"
        align="right"
      ></pagination>
    </div>

    <!-- Modal -->

    <div
      class="modal fade rejectedPageview"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <rejectedPage-view> </rejectedPage-view>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";

export default {
  props: ["supplier_details", "section_details"],
  data() {
    return {
      filter: {
        date_from: "",
        date_to: "",
        supplier: "",
        entry: "",
        section: "",
      },
      rejected_details: {},
      export_rejected_details: {},
      errors: {},
      search: false,
    };
  },

  created() {
    this.get_rejected_details();
    this.get_export_rejected_details();
    var aj = this;

    bus.$on("disposed", function () {
      aj.get_rejected_details();
    });
  },

  methods: {
    hide_filter() {
      this.filter.supplier = "";
      this.filter.date_from = "";
      this.filter.date_to = "";
      this.filter.entry = "";
      this.filter.section = "";

      this.search = false;
      this.get_rejected_details();
      this.get_export_rejected_details();
    },

    show_filter() {
      this.search = true;
    },

    Set_filter() {
      this.get_rejected_details();
    },

    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    view_rejected(rejected) {
      bus.$emit("rejected-details", rejected);
    },

    get_rejected_details(page = 1) {
      axios
        .get("/rejectedDetails?page=" + page, {
          params: {
            supplier: this.filter.supplier,
            date_from: this.filter.date_from,
            date_to: this.filter.date_to,
            entry: this.filter.entry,
            section: this.filter.section,
          },
        })
        .then((response) => (this.rejected_details = response.data));
    },

    get_export_rejected_details() {
      axios
        .get("/rejectedExport", {
          params: {
            supplier: this.filter.supplier,
            date_from: this.filter.date_from,
            date_to: this.filter.date_to,
            entry: this.filter.entry,
            section: this.filter.section,
          },
        })
        .then((response) => (this.export_rejected_details = response.data));
    },

    exportRejected() {
      bus.$emit("export-rejected", this.export_rejected_details);
    },

    exportRejectedClose() {
      bus.$emit("export-rejected-close");
    },
  },
};
</script>

<style>
.spanPending {
  color: rgb(148, 21, 21);
}
.spandisposed {
  color: rgb(20, 187, 56);
}
</style>