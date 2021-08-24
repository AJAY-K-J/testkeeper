<template>
  <div class="card">
    <div class="card-body">
      <!--Export  modal -->

      <div
        class="modal fade exportModal"
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
                @click="exportClose()"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <export-arrival></export-arrival>
            </div>
          </div>
        </div>
      </div>

      <!--Export  modal -->

      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-2">Arrival Register Details</h5>
        </div>
        <div class="col-md-6 text-end">
          <button
            v-if="search == false"
            type="button"
            class="btn btn-sm btn-secondary"
            @click="view_filters()"
          >
            Add Filters
          </button>

          <!-- <export-excel
            class="btn btn-sm btn-secondary"
            :data="arrivalData.data"
            worksheet="My Worksheet"
            name="filename.xls"
          >
            Download Excel
          </export-excel> -->

          <button
            type="button"
            class="btn btn-sm btn-secondary"
            data-toggle="modal"
            data-target=".exportModal"
            @click="exportRecord()"
          >
            Export
          </button>
        </div>
      </div>

      <div class="row" v-if="search">
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
                <label>Supplier Name</label>

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

      <table class="table text-center table-info mt-5" id="storeArrivalBook">
        <thead>
          <tr>
            <th scope="col">#</th>

            <th scope="col">Date</th>
            <th scope="col">Item</th>
            <th scope="col">Description of item</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Invoice No</th>
            <th scope="col">Remarks</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="arrivals in arrival_details.data" :key="arrivals.id">
            <td>{{ arrivals.id }}</td>

            <td>{{ convert_date(arrivals.date) }}</td>

            <td>{{ arrivals.item_name }}</td>

            <td>{{ arrivals.description_item }}</td>

            <td>{{ arrivals.quantity }}</td>
            <td>{{ arrivals.price }}</td>

            <td>{{ arrivals.invoice }}</td>

            <td>{{ arrivals.remarks }}</td>

            <td>
              <button
                type="button"
                class="btn btn-sm btn-secondary"
                data-toggle="modal"
                data-target=".arrivalsPageview"
                @click="view_store_arrivals(arrivals)"
              >
                view
              </button>
            </td>
          </tr>
          <tr v-if="arrival_details.length == 0">
            <td colspan="100%" class="text-center boldmsg">
              No records found!
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <pagination
        :data="arrival_details"
        @pagination-change-page="get_Arrival_details"
        :limit="3"
        align="right"
      ></pagination>
    </div>

    <!-- Modal -->

    <div
      class="modal fade arrivalsPageview"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <arrival-details-view> </arrival-details-view>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
// import DataTable from 'datatables.net-bs4';
// import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';

export default {
  props: ["supplier_details", "section_details"],
  data() {
    return {
      search: false,

      filter: {
        date_from: "",
        date_to: "",
        supplier: "",
        entry: "",
        section: "",
        export: false,
      },
      arrivalData: {},
      arrival_details: {},

      errors: {},
    };
  },

  created() {
    this.get_Arrival_details();
    this.get_arrival_export_details();
  },

  methods: {
    hide_filter() {
      this.filter.item = "";

      this.filter.date_from = "";
      this.filter.date_to = "";
      this.filter.entry = "";
      this.filter.section = "";
      this.filter.supplier = "";
      this.search = false;
      this.get_Arrival_details();
      this.get_arrival_export_details();
    },
    view_filters() {
      this.search = true;
    },

    Set_filter() {
      this.get_Arrival_details();
      this.get_arrival_export_details();
    },

    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    view_store_arrivals(arrivals) {
      bus.$emit("arrivals-details", arrivals);
    },

    get_Arrival_details(page = 1) {
      axios
        .get("/arrivalDetails?page=" + page, {
          params: {
            supplier: this.filter.supplier,

            date_from: this.filter.date_from,
            date_to: this.filter.date_to,
            entry: this.filter.entry,
            section: this.filter.section,
          },
        })
        .then((response) => {
          this.arrival_details = response.data.data;
        });
    },

    get_arrival_export_details() {
      axios
        .get("/arrivalExport", {
          params: {
            supplier: this.filter.supplier,

            date_from: this.filter.date_from,
            date_to: this.filter.date_to,
            entry: this.filter.entry,
            section: this.filter.section,
          },
        })
        .then((response) => {
          this.arrivalData = response.data;
        });
    },

    exportRecord() {
      bus.$emit("export-details", this.arrivalData);
    },
    exportClose() {
      bus.$emit("export-close");
    },
  },
};
</script>

<style>
</style>