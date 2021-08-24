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
            <p>{{ convert_date(product_date) }}</p>
          </div>

          <div class="col-md-3">
            <h5>Name of Supplier</h5>
            <p>{{ NameOfSupplier }}</p>
          </div>

          <div class="col-md-3">
            <h5>Details of Supplier</h5>
            <p>{{ DetailsOfSupplier }}</p>
          </div>

          <div class="col-md-3">
            <h5>GST No</h5>
            <p>{{ GstNo }}</p>
          </div>
          <hr />
        </div>

        <div class="row">
          <div class="col-md-3">
            <h5>Quantity</h5>
            <p>{{ Quantity }}</p>
          </div>

          <div class="col-md-3">
            <h5>Price</h5>
            <p>{{ Price }}</p>
          </div>

          <div class="col-md-3">
            <h5>Item Name</h5>
            <p>{{ ItemName }}</p>
          </div>

          <div class="col-md-3">
            <h5>Details of Item</h5>
            <p>{{ ItemDetails }}</p>
          </div>

          <hr />
        </div>

        <div class="row">
          <div class="col-md-3">
            <h5>Item Category</h5>
            <p>{{ ItemCategory }}</p>
          </div>
          <div class="col-md-3">
            <h5>Invoice</h5>

            <p>{{ Invoice }}</p>
          </div>
          <div class="col-md-3">
            <h5>Invoice date</h5>
            <p>{{ convert_date(InvoiceDate) }}</p>
          </div>

          <div class="col-md-3">
            <h5>DC No</h5>

            <p>{{ DcNo }}</p>
          </div>

          <hr />
        </div>

        <div class="row">
          <div class="col-md-3">
            <h5>DC Date</h5>
            <p>{{ convert_date(DcDate) }}</p>
          </div>
          <div class="col-md-3">
            <h5>Section</h5>

            <p>{{ Section }}</p>
          </div>
          <div class="col-md-3">
            <h5>Approved Quantity</h5>
            <p>{{ approvedquantity }}</p>
          </div>

          <div class="col-md-3">
            <h5>Arrival Page No</h5>

            <p>{{ ArrivalPageNo }}</p>
          </div>

          <hr />
        </div>

        <div class="row">
          <h5>Remarks</h5>

          <textarea
            class="form-control form-height"
            name="remarks"
            v-model="remarks"
          ></textarea>
          <small class="text-danger" v-if="errors.remarks">{{
            errors.remarks[0]
          }}</small>
          <hr />
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12">
        <div class="form-group text-end">
          <button
            class="btn btn-secondary btn-sm float-right b"
            data-dismiss="modal"
            ref="cancel_btn"
            type="button"
          >
            Cancel
          </button>

          <button
            class="btn btn-success btn-sm float-right b"
            type="submit"
            @click="gem_confirm()"
          >
            Approve
          </button>

          <!-- <button
            class="btn btn-danger btn-sm float-right"
            type="submit"
            @click="gem_reject()"
          >
            Reject
          </button> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  created() {
    var vm = this;
    bus.$on("consignee-details", function (gem) {
      vm.id = gem.product_id;
      vm.product_date = gem.product_date;
      vm.NameOfSupplier = gem.supplier_name;
      vm.DetailsOfSupplier = gem.Details;
      vm.GstNo = gem.gst;
      vm.Quantity = gem.quantity;
      vm.Price = gem.price;
      vm.ItemName = gem.item_name;
      vm.ItemDetails = gem.description_item;
      vm.ItemCategory = gem.category_name;
      vm.Invoice = gem.invoice;
      vm.InvoiceDate = gem.invoice_date;
      vm.DcNo = gem.Dc_no;
      vm.DcDate = gem.Dc_date;
      vm.Section = gem.section_name;
      vm.ArrivalPageNo = gem.arrivals_page_no;
      vm.remarks = gem.remarks;
      vm.approvedquantity = gem.approvedquantity;
    });
  },
  data() {
    return {
      id: "",
      product_date: "",
      NameOfSupplier: "",
      DetailsOfSupplier: "",
      GstNo: "",
      Quantity: "",
      Price: "",
      ItemName: "",
      ItemDetails: "",
      ItemCategory: "",
      Invoice: "",
      InvoiceDate: "",
      DcNo: "",
      DcDate: "",
      Section: "",
      SectionApproved: "",
      StoreManagerApproved: "",
      ArrivalPageNo: "",
      remarks: "",
      approvedquantity: "",

      errors: {},
    };
  },

  methods: {
    convert_date(date) {
      return moment(date).format("DD-MM-YYYY");
    },

    gem_confirm() {
      axios
        .post("./gem-confirm/" + this.id, {
          remarks: this.remarks,
          approvedquantity: this.approvedquantity,
        })
        .then((response) => {
          if (response.data == "Success") {
            Swal.fire("Confirmed!", "", "success");

            this.$refs.cancel_btn.click();
          }

          bus.$emit("consignee-confirmed");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
    gem_reject() {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, reject it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("./gem-reject/" + this.id, {
              remarks: this.remarks,
            })
            .then((response) => {
              if (response.data == "Success") {
                Swal.fire(
                  "Rejected!",
                  "Your item has been rejected.",
                  "success"
                );

                this.$refs.cancel_btn.click();
              }

              bus.$emit("consignee-confirmed");
            });
        }
      });
    },
  },
};
</script>

<style>
</style>