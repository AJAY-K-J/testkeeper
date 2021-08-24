<template>
  <div class="card">
    <div class="card-body">
      <!--Export  modal -->

      <div
        class="modal fade exportSectionStockModal"
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
                @click="exportSectionStockClose()"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <export-sectionstock></export-sectionstock>
            </div>
          </div>
        </div>
      </div>

      <!--Export  modal -->

      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">Section Stocks</h5>
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
            data-target=".exportSectionStockModal"
            @click="exportSectionStock()"
          >
            Export
          </button>
        </div>
      </div>

      <!-- filter -->
      <div class="row mt-4" v-if="search">
        <h4 class="card-title text-center">
          <b>Filter Data</b>
        </h4>
        <div class="card-body align-items-center">
          <div class="row">
            <div class="col-md-3">
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

            <div class="col-md-3">
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

                <select
                  class="form-control"
                  name="item_name"
                  v-model="filter.item_name"
                >
                  <option value="">Select name</option>
                  <option
                    v-for="item_names in item_details"
                    :key="item_names.id"
                    v-bind:value="item_names.id"
                  >
                    {{ item_names.name }}
                  </option>
                </select>

                <small class="text-danger" v-if="errors.item_name">{{
                  errors.item_name[0]
                }}</small>
              </div>
            </div>

            <div class="col-3">
              <div class="row px-5">
                <button
                  class="btn btn-secondary btn-sm px-5 mb-2"
                  @click="Set_filter()"
                >
                  Filter
                </button>

                <button
                  class="btn btn-secondary btn-sm px-5"
                  @click="hide_filter()"
                >
                  Clear
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- filter end -->

      <!-- table -->

      <div>
        <table class="table table-striped text-center mt-4">
          <thead>
            <tr>
              <th scope="col">Item</th>
              <th scope="col">Description of item</th>
              <th scope="col">Quantity in Section</th>

              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="stocks in section_stocks.data" :key="stocks.id">
              <td>{{ stocks.item_name }}</td>

              <td>{{ stocks.description_item }}</td>

              <td>{{ stocks.quantity_stock }}</td>

              <td>
                <button
                  type="button"
                  class="btn btn-sm btn-secondary"
                  data-toggle="modal"
                  data-target="#viewstocks"
                  @click="view_section_stocks(stocks)"
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
        :data="section_stocks"
        :limit="3"
        align="right"
        @pagination-change-page="get_section_stocks"
      ></pagination>
    </div>
    <!-- Modal -->

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div
      class="modal fade"
      id="viewstocks"
      tabindex="-1"
      role="dialog"
      aria-labelledby="viewstocksTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header"></div>
          <div class="modal-body">
            <view-section-stock> </view-section-stock>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";

export default {
  props: ["item_details"],
  data() {
    return {
      section_stocks: {},
      export_section_stocks: {},
      search: false,

      filter: {
        date_from: "",
        date_to: "",
        item_name: "",
      },
      errors: {},
    };
  },

  created() {
    this.get_section_stocks();
    this.get_section_stocks_export_details();
    var aj = this;

    bus.$on("item-deprecated", function () {
      aj.get_section_stocks();
    });
  },

  methods: {
    show_filter() {
      this.search = true;
    },

    hide_filter() {
      this.filter.item = "";

      this.filter.date_from = "";
      this.filter.date_to = "";
      this.filter.item_name = "";

      this.search = false;
      this.get_section_stocks();
    },
    Set_filter() {
      this.get_section_stocks();
      this.get_section_stocks_export_details();
    },

    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    view_section_stocks(stocks) {
      bus.$emit("section-stock", stocks);
    },

    get_section_stocks(page = 1) {
      axios
        .get("/sectionstockdetails?page=" + page, {
          params: {
            date_from: this.filter.date_from,
            date_to: this.filter.date_to,
            item_name: this.filter.item_name,
          },
        })
        .then((response) => (this.section_stocks = response.data));
    },
    get_section_stocks_export_details() {
      axios
        .get("/exportsectionstock", {
          params: {
            date_from: this.filter.date_from,
            date_to: this.filter.date_to,
            item_name: this.filter.item_name,
          },
        })
        .then((response) => (this.export_section_stocks = response.data));
    },

    exportSectionStock() {
      bus.$emit("export-section-stock", this.export_section_stocks);
    },

    exportSectionStockClose() {
      bus.$emit("export-section-stock-close");
    },
  },
};
</script>

<style>
</style>