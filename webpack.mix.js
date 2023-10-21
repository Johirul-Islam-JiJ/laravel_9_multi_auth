const mix = require('laravel-mix')
// admin & seller dashboard styles
mix.styles([
    "public/admin/app-assets/vendors/css/vendors.min.css",
    "public/admin/app-assets/vendors/css/extensions/toastr.min.css",
    "public/admin/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css",
    "public/admin/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css",
    "public/admin/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css",
    "public/admin/app-assets/vendors/css/forms/select/select2.min.css",
    "public/admin/app-assets/css/bootstrap.css",
    "public/admin/app-assets/css/bootstrap-extended.css",
    "public/admin/app-assets/css/colors.css",
    "public/admin/app-assets/css/components.css",
    "public/admin/app-assets/css/themes/dark-layout.css",
    "public/admin/app-assets/css/themes/bordered-layout.css",
    "public/admin/app-assets/css/themes/semi-dark-layout.css",
    "public/admin/app-assets/css/bootstrap-extended.min.css",
    "public/admin/app-assets/css/core/menu/menu-types/vertical-menu.css",
    "public/admin/app-assets/css/pages/dashboard-ecommerce.css",
    "public/admin/app-assets/css/plugins/charts/chart-apex.css",
    "public/admin/app-assets/css/plugins/extensions/ext-component-toastr.css",
    "public/admin/app-assets/css/plugins/forms/form-validation.css",
    "public/admin/app-assets/css/pages/app-user.css",
    "public/admin/assets/css/style.css",
],'public/css/admin.css') ;


// admin & seller dashboard scripts
 mix.scripts([
     "public/admin/app-assets/vendors/js/vendors.min.js",
     "public/admin/app-assets/vendors/js/extensions/toastr.min.js",
     "public/admin/app-assets/vendors/js/forms/select/select2.full.min.js",
     "public/admin/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js",
     "public/admin/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js",
     "public/admin/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js",
     "public/admin/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js",
     "public/admin/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js",
     "public/admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js",
     "public/admin/app-assets/vendors/js/forms/validation/jquery.validate.min.js",
     "public/admin/app-assets/js/core/app-menu.js",
     "public/admin/app-assets/js/core/app.js",
     "public/admin/app-assets/js/scripts/forms/form-select2.js",
     "public/admin//app-assets/js/scripts/pages/app-user-list.js",
],'public/js/admin.js');
