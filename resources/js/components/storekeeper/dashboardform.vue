<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form
          class="form-horizontal"
          method="POST"
          @submit.prevent="addarrivals()"
        >
          <div class="card-body">
            <h4 class="card-title text-center">
              <b>STORE ARRIVAL REGISTER </b>
            </h4>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="date" class="control-label col-form-label"
                    >Date
                  </label>
                  <div class="col-sm-9">
                    <input
                      type="date"
                      class="form-control"
                      id="date"
                      name="date"
                      v-model="arrivals.date"
                      placeholder="Date "
                    />
                  </div>

                  <small class="text-danger" v-if="errors.date">{{
                    errors.date[0]
                  }}</small>
                </div>

                <div class="form-group">
                  <label for="price" class="control-label col-form-label"
                    >Price</label
                  >
                  <div class="col-sm-9">
                    <input
                      type="text"
                      class="form-control"
                      id="price"
                      name="price"
                      v-model="arrivals.price"
                      placeholder="Price Here"
                    />
                  </div>

                  <small class="text-danger" v-if="errors.price">{{
                    errors.price[0]
                  }}</small>
                </div>

                <div class="form-group">
                  <label for="dcno" class="control-label col-form-label"
                    >DC No</label
                  >
                  <div class="col-sm-9">
                    <input
                      type="text"
                      class="form-control"
                      id="dcno"
                      name="Dc_no"
                      v-model="arrivals.Dc_no"
                      placeholder="DC No Here"
                    />
                  </div>

                  <small class="text-danger" v-if="errors.Dc_no">{{
                    errors.Dc_no[0]
                  }}</small>
                </div>
              </div>

              <!-- completed -->

              <div class="col">
                <div class="form-group">
                  <label for="item" class="control-label col-form-label"
                    >Entry Type</label
                  >
                  <div class="col-sm-9">
                    <!----><select
                      class="form-control"
                      id="stock_type"
                      name="stock_type"
                      v-model="arrivals.stock_type"
                    >
                      <option value="">Select Type</option>
                      <option value="Local entry">Local entry</option>
                      <option value="Gem-consignee">Gem-consignee</option>
                    </select>
                  </div>
                  <small class="text-danger" v-if="errors.stock_type">{{
                    errors.stock_type[0]
                  }}</small>
                </div>

                <div class="form-group">
                  <label for="invoice" class="control-label col-form-label"
                    >Invoice No</label
                  >
                  <div class="col-sm-9">
                    <input
                      type="text"
                      class="form-control"
                      id="invoice"
                      name="invoice"
                      v-model="arrivals.invoice"
                      placeholder="Invoice No Here"
                    />
                  </div>

                  <small class="text-danger" v-if="errors.invoice">{{
                    errors.invoice[0]
                  }}</small>
                </div>

                <div class="form-group">
                  <label for="dcdate" class="control-label col-form-label">
                    DC Date</label
                  >
                  <div class="col-sm-9">
                    <input
                      type="date"
                      class="form-control"
                      id="dcdate"
                      name="Dc_date"
                      v-model="arrivals.Dc_date"
                      placeholder=" DC Date "
                    />
                  </div>

                  <small class="text-danger" v-if="errors.Dc_date">{{
                    errors.Dc_date[0]
                  }}</small>
                </div>
              </div>

              <!-- completed -->
              <div class="col">
                <div class="form-group">
                  <label for="supplier" class="control-label col-form-label"
                    >Supplier Name</label
                  >
                  <div class="col-sm-9">
                    <select
                      class="form-control"
                      id="supplier"
                      name="supplier"
                      v-model="arrivals.supplier"
                      @change="Details_of_suppliers($event)"
                    >
                      <option value="">Select Supplier</option>
                      <option
                        v-for="suppliers in supplier_details"
                        :key="suppliers.id"
                        v-bind:value="suppliers.id"
                      >
                        {{ suppliers.name }}
                      </option>
                    </select>
                  </div>

                  <small class="text-danger" v-if="errors.supplier">{{
                    errors.supplier[0]
                  }}</small>
                </div>

                <div class="form-group">
                  <label for="dcdate" class="control-label col-form-label">
                    Invoice Date</label
                  >
                  <div class="col-sm-9">
                    <input
                      type="date"
                      class="form-control"
                      id="invoice_date"
                      name="invoice_date"
                      v-model="arrivals.invoice_date"
                      placeholder=" Invoice Date "
                    />
                  </div>

                  <small class="text-danger" v-if="errors.invoice_date">{{
                    errors.invoice_date[0]
                  }}</small>
                </div>

                <div class="form-group">
                  <label for="section" class="control-label col-form-label"
                    >Name of Section
                  </label>
                  <div class="col-sm-9">
                    <select
                      class="form-control"
                      id="section"
                      name="section"
                      v-model="arrivals.section"
                    >
                      <option value="">Select Section</option>
                      <option
                        v-for="section in section_details"
                        :key="section.id"
                        v-bind:value="section.id"
                      >
                        {{ section.name }}
                      </option>
                    </select>
                  </div>

                  <small class="text-danger" v-if="errors.section">{{
                    errors.section[0]
                  }}</small>
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="itemname" class="control-label col-form-label"
                    >Supplier details
                  </label>
                  <div class="col-sm-9">
                    <textarea
                      class="form-control form-height"
                      rows="1"
                      disabled
                      v-model="this.Details_of_supplier"
                    >
                    </textarea>
                    <small class="text-danger" v-if="errors.supplier">{{
                      errors.supplier[0]
                    }}</small>
                  </div>
                </div>
                <!-- 444444444444444444444444444444444444444444444444444444444444444444444444444444 -->
                <div class="form-group">
                  <label for="itemname" class="control-label col-form-label"
                    >Choose item
                  </label>
                  <div class="col-sm-9">
                    <select
                      class="form-control"
                      id="itemname"
                      name="item_name"
                      v-model="arrivals.item_name"
                      @change="Change($event)"
                    >
                      <!-- 4444444444444444444444444444444444444444444444444444444444444444444444444 -->
                      <option value="">Select Item</option>
                      <option
                        v-for="item in item_details"
                        :key="item.id"
                        v-bind:value="item.id"
                      >
                        {{ item.name }}
                      </option>
                    </select>
                  </div>

                  <small class="text-danger" v-if="errors.item_name">{{
                    errors.item_name[0]
                  }}</small>
                </div>

                <div class="form-group">
                  <label for="officer" class="control-label col-form-label"
                    >Arrival page no
                  </label>
                  <div class="col-sm-9">
                    <input
                      type="text"
                      class="form-control"
                      id="arrivals_page_no"
                      name="arrivals_page_no"
                      v-model="arrivals.arrivals_page_no"
                      placeholder="Page No Here"
                    />
                  </div>
                  <small class="text-danger" v-if="errors.arrivals_page_no">{{
                    errors.arrivals_page_no[0]
                  }}</small>
                </div>
              </div>
              <!--  -->
              <div class="col">
                <div class="form-group">
                  <label for="quantity" class="control-label col-form-label"
                    >Quantity</label
                  >
                  <div class="col-sm-9">
                    <input
                      type="number"
                      class="form-control"
                      id="quantity"
                      name="quantity"
                      v-model="arrivals.quantity"
                      placeholder="Quantity Here"
                    />
                  </div>
                  <small class="text-danger" v-if="errors.quantity">{{
                    errors.quantity[0]
                  }}</small>
                </div>

                <div class="form-group">
                  <label for="dcno" class="control-label col-form-label"
                    >Item Details</label
                  >

                  <div class="col-sm-9">
                    <textarea
                      class="form-control form-height"
                      v-model="this.Details_of_item"
                      rows="1"
                      disabled
                    ></textarea>

                    <small class="text-danger" v-if="errors.item_name">{{
                      errors.item_name[0]
                    }}</small>
                  </div>
                </div>

                <div class="form-group">
                  <label for="remarks" class="control-label col-form-label"
                    >Remarks</label
                  >
                  <div class="col-sm-9">
                    <textarea
                      class="form-control form-height"
                      rows="1"
                      name="remarks"
                      v-model="arrivals.remarks"
                    ></textarea>
                  </div>

                  <small class="text-danger" v-if="errors.remarks">{{
                    errors.remarks[0]
                  }}</small>
                </div>
              </div>
              <!--  -->

              <div class="border-top">
                <div class="card-body text-end">
                  <button
                    type="submit"
                    class="btn btn-primary"
                    name="arrivalsave"
                    :disabled="isLoading"
                  >
                    Register
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  props: [
    "edit",
    "item_details",
    "section_details",
    "section_officer",
    "supplier_details",
  ],

  created() {},

  data() {
    return {
      isLoading: false,
      Details_of_supplier: "",
      Details_of_item: "",
      items: {},

      arrivals: {
        date: "",
        supplier: "",
        stock_type: "",
        item_name: "",

        quantity: "",
        price: "",
        invoice: "",
        invoice_date: "",
        Dc_no: "",
        Dc_date: "",
        section: "",
        arrivals_page_no: "",
        remarks: "",
      },

      errors: {},
    };
  },

  methods: {
    Change(event) {
      this.isLoading = true;
      this.Details_of_item = "";
      let val = event.target.value;
      for (let itms in this.item_details) {
        let Details = this.item_details[itms];
        if (Details.id == val) {
          this.Details_of_item = Details.description_item;
          this.isLoading = false;
          break;
        }
      }
    },

    Details_of_suppliers(event) {
      this.isLoading = true;
      this.Details_of_supplier = "";
      let akku = event.target.value;
      for (let sup in this.supplier_details) {
        let ajay = this.supplier_details[sup];

        if (ajay.id == akku) {
          this.Details_of_supplier = ajay.Details;
          this.isLoading = false;
          break;
        }
      }
    },

    clear_data() {
      for (let arrival in this.arrivals) {
        this.arrivals[arrival] = null;
      }

      for (let er in this.errors) {
        this.errors[er] = null;
      }

      this.Details_of_supplier = "";
      this.Details_of_item = "";
    },

    addarrivals() {
      this.isLoading = true;

      axios
        .post("./api/addarrivals", this.arrivals)
        .then((response) => {
          if (response.data == "Success") {
            Swal.fire("Successfully Added!", "", "success");

            this.clear_data();
          }

          bus.$emit("arrivals-added");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
      this.isLoading = false;
    },
  },
};
</script>

<style scoped>
</style>