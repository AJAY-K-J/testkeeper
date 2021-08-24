<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-2">rejection Details</h5>
        </div>
        <div class="col-md-6 text-end" v-if="search == false">
          <button
            type="button"
            class="btn btn-sm btn-primary"
            data-toggle="modal"
            @click="show_filter()"
          >
            Add Filters
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

            <div class="col-1 mt-4">
              <div>
                <button
                  class="btn btn-primary btn-sm px-4 mb-2"
                  @click="Set_filter()"
                >
                  Search
                </button>
              </div>
            </div>

            <div class="col-1 mt-4">
              <div>
                <button class="btn btn-primary btn-sm" @click="hide_filter()">
                  Clear Filter
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <table class="table text-center table-info mt-4" id="storerejectionBook">
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
          <tr v-for="rejection in rejection_details.data" :key="rejection.id">
            <td>{{ rejection.id }}</td>

            <td>{{ convert_date(rejection.date) }}</td>

            <td>{{ rejection.item_name }}</td>

            <td>{{ rejection.description_item }}</td>

            <td>{{ rejection.quantity }}</td>
            <td>{{ rejection.price }}</td>

            <td>{{ rejection.invoice }}</td>

            <td>{{ rejection.remarks }}</td>

            <td>
              <button
                type="button"
                class="btn btn-sm btn-secondary"
                data-toggle="modal"
                data-target=".rejectionPageview"
                @click="view_rejection(rejection)"
              >
                view
              </button>
            </td>
          </tr>
          <tr v-if="rejection_details.length == 0">
            <td colspan="100%" class="text-center boldmsg">
              No records found!
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <pagination
        :data="rejection_details"
        :limit="3"
        align="right"
        @pagination-change-page="get_rejection_details"
      ></pagination>
    </div>

    <!-- Modal -->

    <div
      class="modal fade rejectionPageview"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <rejection-details-view> </rejection-details-view>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import DataTable from "datatables.net-bs4";
import "datatables.net-bs4/css/dataTables.bootstrap4.min.css";
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

      rejection_details: {},
      errors: {},
      search: "",
    };
  },

  mounted() {
    this.get_rejection_details();
  },

  methods: {
    hide_filter() {
      this.filter.supplier = "";

      this.filter.date_from = "";
      this.filter.date_to = "";
      this.filter.entry = "";
      this.filter.section = "";
      this.filter.supplier = "";

      this.search = false;
      this.get_rejection_details();
    },

    show_filter() {
      this.search = true;
    },

    Set_filter() {
      this.get_rejection_details();
    },

    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    view_rejection(rejection) {
      bus.$emit("rejection-details", rejection);
    },

    get_rejection_details(page = 1) {
      axios
        .get("office-RejectedPagedata?page=" + page, {
          params: {
            supplier: this.filter.supplier,

            date_from: this.filter.date_from,
            date_to: this.filter.date_to,
            entry: this.filter.entry,
            section: this.filter.section,
          },
        })
        .then((response) => {
          this.rejection_details = response.data;
        });
    },
  },
};
</script>

<style>
</style>