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
            <p>{{ convert_date(list.product_date) }}</p>
          </div>
          <div class="col-md-3">
            <h5>Supplier Name</h5>
            <p>{{ list.supplier_name }}</p>
          </div>

          <div class="col-md-3">
            <h5>GST no</h5>
            <p>{{ list.supplier_gst }}</p>
          </div>

          <div class="col-md-3">
            <h5>Name of item</h5>
            <p>{{ list.name_item }}</p>
          </div>
        </div>

        <hr />

        <div class="row">
          <div class="col-md-3">
            <h5>Description of item</h5>
            <p>{{ list.item_description }}</p>
          </div>
          <div class="col-md-3">
            <h5>Invoice</h5>
            <p>{{ list.invoice }}</p>
          </div>

          <div class="col-md-3">
            <h5>DC No</h5>
            <p>{{ list.Dc_no }}</p>
          </div>

          <div class="col-md-3">
            <h5>Purchase Order</h5>
            <p>{{ list.purchase_order_no }}</p>
          </div>

          <hr />
        </div>
        <div class="row">
          <div class="col-md-3">
            <h5>GIR page no</h5>
            <p>{{ list.gir_page_no }}</p>
          </div>
          <div class="col-md-3">
            <h5>Category</h5>
            <p>{{ list.category_book }}</p>
          </div>

          <div class="col-md-3">
            <h5>Category page no</h5>
            <p>{{ list.category_book_page_no }}</p>
          </div>

          <div class="col-md-3">
            <h5>Quantity</h5>
            <p>{{ list.quantity }}</p>
          </div>

          <hr />
        </div>

        <div class="row">
          <div class="col-md-3">
            <h5>Price</h5>
            <p>{{ list.price }}</p>
          </div>
          <div class="col-md-3">
            <h5>Purchase Order Date</h5>
            <p>{{ convert_date(list.purchase_order_date) }}</p>
          </div>
          <div class="col-md-3">
            <h5>Arrival page no</h5>
            <p>{{ list.arrivals_page_no }}</p>
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
          >
            Cancel
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
    var amitha = this;
    bus.$on("GIR-Book", function (goods) {
      amitha.list.product_id = goods.product_id;
      amitha.list.product_date = goods.product_date;
      amitha.list.supplier_name = goods.supplier_name;
      amitha.list.supplier_gst = goods.gst;
      amitha.list.name_item = goods.item_name;
      amitha.list.item_description = goods.description_item;
      amitha.list.invoice = goods.invoice;
      amitha.list.Dc_no = goods.Dc_no;
      amitha.list.purchase_order_no = goods.purchase_order_no;
      amitha.list.gir_page_no = goods.gir_page_no;
      amitha.list.category_book = goods.category_book;
      amitha.list.category_book_page_no = goods.category_book_page_no;
      amitha.list.quantity = goods.approvedquantity;
      amitha.list.price = goods.price;
      amitha.list.purchase_order_date = goods.purchase_order_date;
      amitha.list.arrivals_page_no = goods.arrivals_page_no;
    });
  },
  data() {
    return {
      list: {
        product_id: "",
        product_date: "",
        supplier_name: "",
        supplier_gst: "",
        name_item: "",
        item_description: "",
        invoice: "",
        Dc_no: "",
        purchase_order_no: "",
        gir_page_no: "",
        category_book: "",
        category_book_page_no: "",
        quantity: "",
        price: "",
        purchase_order_date: "",
        arrivals_page_no: "",
      },

      errors: {},
    };
  },

  methods: {
    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },
  },
};
</script>

<style>
</style>