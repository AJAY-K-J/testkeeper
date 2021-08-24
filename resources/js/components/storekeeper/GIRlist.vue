<template>
  <div class="card">
    <div class="card-body">
      <!--Export  modal -->

      <div
        class="modal fade exportGirModal"
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
                @click="exportGirClose()"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <export-gir></export-gir>
            </div>
          </div>
        </div>
      </div>

      <!--Export  modal -->
      <div class="row">
        <div class="col-md-6 bold">
          <h5 class="card-title mb-0">GIR Book</h5>
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
            data-target=".exportGirModal"
            @click="exportGir()"
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

      <table class="table text-center table-hover mt-4">
        <thead>
          <tr>
            <th scope="col">GIR Page</th>

            <th scope="col">Supplier Name</th>
            <th scope="col">Item</th>
            <th scope="col">Invoice No</th>
            <th scope="col">Purchase Order</th>
            <th scope="col">Category</th>
            <th scope="col">Quantity in Store</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="goods in goods_details.data" :key="goods.id">
            <td>{{ goods.gir_page_no }}</td>

            <td>{{ goods.supplier_name }}</td>

            <td>{{ goods.item_name }}</td>

            <td>{{ goods.invoice }}</td>

            <td>{{ goods.purchase_order_no }}</td>

            <td>{{ goods.category_book }}</td>

            <td>{{ goods.balance_quantity }}</td>

            <td>
              <button
                type="button"
                class="btn btn-sm btn-secondary b"
                data-toggle="modal"
                data-target=".goodsview"
                @click="view_goods(goods)"
              >
                view
              </button>
              <button
                type="button"
                class="btn btn-sm btn-success b"
                data-toggle="modal"
                data-target="#allotview"
                @click="allot_goods(goods)"
              >
                Allot
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      <pagination
        :data="goods_details"
        :limit="3"
        align="right"
        @pagination-change-page="get_goods_list"
      ></pagination>
    </div>

    <!-- Modal -->

    <div
      class="modal fade goodsview"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <gir-view> </gir-view>
        </div>
      </div>
    </div>

    <!-- ########################################################################################################### -->

    <!-- Modal -->
    <div
      class="modal fade"
      id="allotview"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="allotview">Allot goods</h5>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
          </div>
          <div class="modal-body">
            <section-allot> </section-allot>
          </div>
        </div>
      </div>
    </div>

    <!-- ############################################################################################ -->
  </div>
</template>

<script>
import moment from "moment";

export default {
  props: ["supplier_details", "section_details"],
  data() {
    return {
      errors: {},
      goods_details: {},
      export_goods_details: {},

      filter: {
        date_from: "",
        date_to: "",
        supplier: "",
        entry: "",
        section: "",
      },
      search: false,
    };
  },

  created() {
    this.get_goods_list();
    this.get_export_goods_list();

    var cm = this;
    bus.$on("item-alloted", function () {
      cm.get_goods_list();
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
      this.get_goods_list();
      this.get_export_goods_list();
    },

    show_filter() {
      this.search = true;
    },

    Set_filter() {
      this.get_goods_list();
    },

    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    view_goods(goods) {
      bus.$emit("GIR-Book", goods);
    },

    allot_goods(goods) {
      bus.$emit("allot-goods", goods);
    },

    get_goods_list(page = 1) {
      axios
        .get("/goodslist?page=" + page, {
          params: {
            supplier: this.filter.supplier,
            date_from: this.filter.date_from,
            date_to: this.filter.date_to,
            entry: this.filter.entry,
            section: this.filter.section,
          },
        })
        .then((response) => (this.goods_details = response.data));
    },
    get_export_goods_list() {
      axios
        .get("/exportgirlist", {
          params: {
            supplier: this.filter.supplier,
            date_from: this.filter.date_from,
            date_to: this.filter.date_to,
            entry: this.filter.entry,
            section: this.filter.section,
          },
        })
        .then((response) => (this.export_goods_details = response.data));
    },
    exportGir() {
      bus.$emit("export-gir", this.export_goods_details);
    },
    exportGirClose() {
      bus.$emit("export-gir-close");
    },
  },
};
</script>

<style>
</style>