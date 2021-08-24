require('./bootstrap');


window.Vue = require('vue').default;
window.bus = new Vue();
export const bus = new Vue();

global.jQuery = require('jquery');


var $ = global.jQuery;
window.$ = $;


import Swal from 'sweetalert2';
window.Swal = Swal;

Vue.component('pagination', require('laravel-vue-pagination'));


import Vue from 'vue'
import excel from 'vue-excel-export'
 
Vue.use(excel)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('change-password', require('./components/auth/passwordChange.vue').default);

Vue.component('first-user', require('./components/auth/firstUser.vue').default);

Vue.component('dashboard-form', require('./components/storekeeper/dashboardform.vue').default);

Vue.component('add-new-user', require('./components/storekeeper/addnewuser.vue').default);
Vue.component('user-list', require('./components/storekeeper/userlist.vue').default);


Vue.component('add-new-category', require('./components/storekeeper/addcategory.vue').default);
Vue.component('category-list', require('./components/storekeeper/categorylist.vue').default);

Vue.component('add-new-item', require('./components/storekeeper/additem.vue').default);
Vue.component('item-list', require('./components/storekeeper/itemlist.vue').default);


Vue.component('role-list', require('./components/storekeeper/rolelist.vue').default);

Vue.component('add-new-supplier', require('./components/storekeeper/addsupplier.vue').default);
Vue.component('supplier-list', require('./components/storekeeper/supplierlist.vue').default);

Vue.component('add-new-section', require('./components/storekeeper/addsection.vue').default);
Vue.component('section-list', require('./components/storekeeper/sectionlist.vue').default);

Vue.component('confirmed-details', require('./components/storekeeper/confirmedPage.vue').default);
Vue.component('confirmedPage-view', require('./components/storekeeper/confirmedPageView.vue').default);

Vue.component('rejected-book', require('./components/storekeeper/RejectedBook.vue').default);
Vue.component('rejectedPage-view', require('./components/storekeeper/RejectedPageView.vue').default);

Vue.component('gir-list', require('./components/storekeeper/GIRlist.vue').default);
Vue.component('gir-view', require('./components/storekeeper/GIRview.vue').default);
Vue.component('section-allot', require('./components/storekeeper/sectionallot.vue').default);

Vue.component('dsr-book', require('./components/storekeeper/dsrbook.vue').default);
Vue.component('view-dsr-stock', require('./components/storekeeper/viewdsr.vue').default);

Vue.component('kardex-book', require('./components/storekeeper/kardexbook.vue').default);
Vue.component('view-kardex-stock', require('./components/storekeeper/viewkardex.vue').default);

Vue.component('store-arrival-book', require('./components/storekeeper/storeArrivalBook.vue').default);
Vue.component('arrival-details-view', require('./components/storekeeper/arrivalDetailsView.vue').default);

Vue.component('export-arrival', require('./components/storekeeper/exportArrival.vue').default);
Vue.component('export-gir', require('./components/storekeeper/exportGir.vue').default);
Vue.component('export-rejected', require('./components/storekeeper/exportRejected.vue').default);

// ###############################################################################################

Vue.component('sectiondashboard-table', require('./components/section/sectiondashboard.vue').default);
Vue.component('view-arrival', require('./components/section/view_arrival.vue').default);
Vue.component('section-store-book', require('./components/section/sectionstorebook.vue').default);
Vue.component('view-section-stock', require('./components/section/viewsectionstock.vue').default);

Vue.component('export-sectionstock', require('./components/section/exportSectionStock.vue').default);

Vue.component('section-return', require('./components/section/sectionreturn.vue').default);
Vue.component('view-depreciated-stock', require('./components/section/depreciatedstocks.vue').default);

// ##################################################################################################

Vue.component('managerdashboard-table', require('./components/storemanager/managerdashboard.vue').default);
Vue.component('manager-view-arrival', require('./components/storemanager/manager_view.vue').default);
Vue.component('arrival-book-table', require('./components/storemanager/arrivalbook.vue').default);
Vue.component('store-view-arrival', require('./components/storemanager/storeview.vue').default);



Vue.component('office-dashboard-table', require('./components/office/officedashboard.vue').default);

Vue.component('office-rejection', require('./components/office/officeRejection.vue').default);
Vue.component('rejection-details-view', require('./components/office/officeRejectionView.vue').default);

Vue.component('office-kardex', require('./components/office/officeKardex.vue').default);
Vue.component('kardex-details-view', require('./components/office/officeKardexView.vue').default);

Vue.component('office-gir', require('./components/office/officeGIR.vue').default);
Vue.component('gir-details-view', require('./components/office/officeGirView.vue').default);

Vue.component('office-gem-consignee', require('./components/office/officeGemConsignee.vue').default);
Vue.component('gem-details-view', require('./components/office/officeGemView.vue').default);

Vue.component('office-dsr', require('./components/office/officeDSR.vue').default);
Vue.component('dsr-details-view', require('./components/office/dsrview.vue').default);

Vue.component('office-arrival', require('./components/office/officeArrival.vue').default);
Vue.component('office-arrival-details-view', require('./components/office/officeArrivalView.vue').default);

// ##################################################################################################

Vue.component('gem-dashboard', require('./components/Gem_consignee/gemdashboard.vue').default);
Vue.component('view-consignee', require('./components/Gem_consignee/viewconsignee.vue').default);

Vue.component('gem-arrival-book', require('./components/Gem_consignee/gemArrivalBook.vue').default);
Vue.component('view-GemArrival', require('./components/Gem_consignee/gemArrivalBookView.vue').default);

/**
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});