<template>
  <div class="p-3">
    <div class="row">
      <h4 class="card-title text-center">
        <b>ITEM DETAILS </b>
      </h4>
      <div class="card-body align-items-center">
        <div class="row">
          <div class="col-md-3">
            <h5>Date</h5>
            <p>{{ convert_date(lot.product_date) }}</p>
          </div>
          <div class="col-md-3">
            <h5>Details of supplier</h5>
            <p>{{ supplier_details }}</p>
          </div>

          <div class="col-md-3">
            <h5>Descripction of item</h5>
            <p>{{ description_item }}</p>
          </div>

          <div class="col-md-3">
            <h5>Name of item</h5>
            <p>{{ item_name }}</p>
          </div>
        </div>

        <hr />

        <div class="row">
          <div class="col-md-3">
            <h5>Quantity</h5>
            <p>{{ lot.quantity }}</p>
          </div>
          <div class="col-md-3">
            <h5>Price</h5>
            <p>{{ lot.price }}</p>
          </div>

          <div class="col-md-3">
            <h5>Invoice No</h5>
            <p>{{ lot.invoice }}</p>
          </div>

          <div class="col-md-3">
            <h5>Remarks</h5>

            <textarea
              class="form-control form-height"
              name="remarks"
              v-model="lot.remarks"
            ></textarea>
          </div>

          <hr />
        </div>
        <div class="row">
          <div class="col-md-3">
            <h5>GIR page no</h5>
            <input
              type="number"
              class="form-control"
              placeholder="GIR page no"
              name="gir_page_no"
              v-model="lot.gir_page_no"
            />
            <small class="text-danger" v-if="errors.gir_page_no">{{
              errors.gir_page_no[0]
            }}</small>
          </div>
          <div class="col-md-3">
            <h5>Select Category</h5>
            <select
              class="form-control"
              id="category_name"
              name="category_book"
              v-model="lot.category_book"
            >
              <option value="">Select category</option>
              <option value="kardex">Kardex</option>
              <option value="dsr">DSR</option>
            </select>
            <small class="text-danger" v-if="errors.category_book">{{
              errors.category_book[0]
            }}</small>
          </div>

          <div class="col-md-3">
            <h5>Category page no</h5>
            <input
              type="text"
              class="form-control"
              placeholder="Category page no"
              name="category_book_page_no"
              v-model="lot.category_book_page_no"
            />
            <small class="text-danger" v-if="errors.category_book_page_no">{{
              errors.category_book_page_no[0]
            }}</small>
          </div>

          <div class="col-md-3">
            <h5>Purchase Order no</h5>
            <input
              type="text"
              class="form-control"
              placeholder="Purchase Order no"
              name="purchase_order_no"
              v-model="lot.purchase_order_no"
            />
            <small class="text-danger" v-if="errors.purchase_order_no">{{
              errors.purchase_order_no[0]
            }}</small>
          </div>

          <hr />
        </div>

        <div class="row">
          <div class="col-md-3">
            <h5>Purchase Order Date</h5>
            <input
              type="date"
              class="form-control"
              placeholder="Purchase Order date"
              name="purchase_order_date"
              v-model="lot.purchase_order_date"
            />
            <small class="text-danger" v-if="errors.purchase_order_date">{{
              errors.purchase_order_date[0]
            }}</small>
          </div>

          <hr />
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12">
        <div class="form-group text-end">
          <button
            class="btn btn-secondary btn-sm float-right"
            data-dismiss="modal"
            ref="cancel_btn"
            type="button"
            @click="clear_data()"
          >
            Cancel
          </button>

          <button
            class="btn btn-success btn-sm float-right"
            type="submit"
            @click="addToGIR()"
          >
            Add TO GIR
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  created() {
    var akku = this;
    bus.$on("confirmed-details", function (confirmed) {
      akku.supplier_details = confirmed.Details;
      akku.description_item = confirmed.description_item;
      akku.item_name = confirmed.item_name;

      akku.lot.product_id = confirmed.id;
      akku.lot.product_date = confirmed.date;

      akku.lot.product_supplier_id = confirmed.supplier_id;
      akku.lot.section_id = confirmed.section_id;
      akku.lot.item_id = confirmed.item_id;

      akku.lot.quantity = confirmed.quantity;
      akku.lot.approvedquantity = confirmed.approvedquantity;

      akku.lot.price = confirmed.price;
      akku.lot.invoice = confirmed.invoice;
      akku.lot.Dc_no = confirmed.Dc_no;

      akku.lot.Dc_date = confirmed.Dc_date;
      akku.lot.arrivals_page_no = confirmed.arrivals_page_no;

      akku.lot.remarks = confirmed.remarks;

      akku.lot.invoice_date = confirmed.invoice_date;
      akku.lot.stock_type = confirmed.stock_type;
    });
  },
  data() {
    return {
      item_name: "",
      supplier_details: "",
      description_item: "",

      lot: {
        product_id: "",
        product_date: "",
        product_supplier_id: "",
        section_id: "",
        item_id: "",
        quantity: "",
        approvedquantity: "",
        price: "",
        invoice: "",
        stock_type: "",
        invoice_date: "",
        Dc_no: "",
        Dc_date: "",
        arrivals_page_no: "",
        gir_page_no: "",
        category_book: "",
        category_book_page_no: "",
        purchase_order_no: "",
        purchase_order_date: "",
        remarks: "",
      },

      errors: {},
    };
  },

  methods: {
    clear_data() {
      (this.lot.arrivals_page_no = ""),
        (this.lot.gir_page_no = ""),
        (this.lot.category_book = ""),
        (this.lot.category_book_page_no = ""),
        (this.lot.purchase_order_no = ""),
        (this.lot.purchase_order_date = "");

      for (let er in this.errors) {
        this.errors[er] = null;
      }
    },

    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },

    addToGIR() {
      axios
        .post("./addtogir", this.lot)
        .then((response) => {
          if (response.data == "Success") {
            Swal.fire("Confirmed!", "", "success");

            this.$refs.cancel_btn.click();
            this.clear_data();
            bus.$emit("addedGIR");
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>

<style>
</style>