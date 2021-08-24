<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-2">DSR Details</h5>
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
                <label>Item Name</label>

                <select class="form-control" name="item" v-model="filter.item">
                  <option value="">Select name</option>
                  <option
                    v-for="item in item_details"
                    :key="item.id"
                    v-bind:value="item.id"
                  >
                    {{ item.name }}
                  </option>
                </select>

                <small class="text-danger" v-if="errors.item">{{
                  errors.item[0]
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

      <table class="table text-center table-info mt-4" id="storedsrBook">
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
          <tr v-for="dsr in dsr_details.data" :key="dsr.id">
            <td>{{ dsr.product_id }}</td>

            <td>{{ convert_date(dsr.date) }}</td>

            <td>{{ dsr.item_name }}</td>

            <td>{{ dsr.description_item }}</td>

            <td>{{ dsr.quantity }}</td>
            <td>{{ dsr.price }}</td>

            <td>{{ dsr.invoice }}</td>

            <td>{{ dsr.remarks }}</td>

            <td>
              <button
                type="button"
                class="btn btn-sm btn-secondary"
                data-toggle="modal"
                data-target=".dsrPageview"
                @click="view_dsr(dsr)"
              >
                view
              </button>
            </td>
          </tr>
          <tr v-if="dsr_details.length == 0">
            <td colspan="100%" class="text-center boldmsg">
              No records found!
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <pagination
        :data="dsr_details"
        :limit="3"
        align="right"
        @pagination-change-page="get_dsr_details"
      ></pagination>
    </div>

    <!-- Modal -->

    <div
      class="modal fade dsrPageview"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <dsr-details-view> </dsr-details-view>
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
  props: ["item_details", "section_details"],
  data() {
    return {
      filter: {
        date_from: "",
        date_to: "",
        item: "",
        entry: "",
        section: "",
      },

      dsr_details: {},
      errors: {},
      search: "",
    };
  },

  mounted() {
    this.get_dsr_details();
  },

  methods: {
    hide_filter() {
      this.filter.item = "";

      this.filter.date_from = "";
      this.filter.date_to = "";
      this.filter.entry = "";
      this.filter.section = "";
      this.search = false;
      this.get_dsr_details();
    },

    show_filter() {
      this.search = true;
    },

    Set_filter() {
      this.get_dsr_details();
    },

    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    view_dsr(dsr) {
      bus.$emit("dsr-details", dsr);
    },

    get_dsr_details(page = 1) {
      axios
        .get("office-dsrdata?page=" + page, {
          params: {
            item: this.filter.item,

            date_from: this.filter.date_from,
            date_to: this.filter.date_to,
            entry: this.filter.entry,
            section: this.filter.section,
          },
        })
        .then((response) => {
          this.dsr_details = response.data;

          //     $(document).ready(function () {
          //   $("#storedsrBook").DataTable({
          //     dom: "Bfrtip",
          //     buttons: ["copy", "csv", "excel", "pdf", "print"],
          //   });
          // });

          setTimeout(() => (this.dsr_details = response.data));
        });
    },
  },
};
</script>

<style>
</style>