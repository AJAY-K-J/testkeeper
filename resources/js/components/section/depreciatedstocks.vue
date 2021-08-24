<template>
  <div class="">
    <div class="row">
      <h4 class="card-title text-center">
        <b>ITEM DETAILS </b>
      </h4>
      <div class="card-body align-items-center">
        <div class="row">
          <div class="col">
            <h5>Item Name</h5>
            <p>{{ itemName }}</p>
          </div>
          <div class="col">
            <h5>Description of Item</h5>
            <p>{{ itemDec }}</p>
          </div>

          <hr />
        </div>
        <div class="row">
          <div class="col">
            <h5>Deprecated Quantity</h5>
            <p>{{ itemQuantity }}</p>
          </div>
        </div>

        <hr />
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
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    var vm = this;
    bus.$on("depreciated-stock", function (stocks) {
      vm.productId = stocks.product_id;
      vm.itemName = stocks.item_name;

      vm.itemDec = stocks.description_item;
      vm.itemQuantity = stocks.deprecated_quantity;

      vm.item_id = stocks.item_id;
      vm.section_name = stocks.section_name;
    });
  },
  data() {
    return {
      Depreciated_Quantity: "",
      productId: "",
      itemName: "",
      itemDec: "",
      itemQuantity: "",
      section_name: "",
      item_id: "",
    };
  },

  methods: {},
};
</script>

<style>
</style>