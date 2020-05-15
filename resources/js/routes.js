import dashboardComponent from './components/dashboardComponent'
import usersComponent from './components/usersComponent'
import commentComponent from './components/commentComponent'
import productsComponent from './components/productsComponent'
import categoryComponent from './components/categoryComponent'
import editCategoryComponent from './components/editCategoryComponent'
import slideComponent from './components/slideComponent'
import colorComponent from './components/colorComponent'
import sizeComponent from './components/sizeComponent'
import supplierComponent from './components/supplierComponent'
import chartComponent from './components/chartComponent'
import orderComponent from './components/orderComponent'
import dateComponent from './components/dateComponent'
const routes = [
    {
        path: '/admin/dashboard',
        component: dashboardComponent,
        name: 'dashboardComponent',
    },
    {
        path: '/admin/dashboard/users',
        component: usersComponent,
        name: 'usersComponent',
    } ,
    {
        path: '/admin/dashboard/comments',
        component: commentComponent,
        name: 'commentComponent',
    },
    {
        path: '/admin/dashboard/products',
        component: productsComponent,
        name: 'productsComponent',
    },
    {
        path: '/admin/dashboard/category',
        component: categoryComponent,
        name: 'categoryComponent',
    },
    {
        path: '/admin/dashboard/category/edit/:id',
        component: editCategoryComponent,
        name: 'editCategoryComponent',
    },
    {
        path: '/admin/dashboard/slide',
        component: slideComponent,
        name: 'slideComponent',
    },
    {
        path: '/admin/dashboard/attribute/colors',
        component: colorComponent,
        name: 'colorComponent',
    },
    {
        path: '/admin/dashboard/attribute/sizes',
        component: sizeComponent,
        name: 'sizeComponent',
    },
    {
        path: '/admin/dashboard/suppliers',
        component: supplierComponent,
        name: 'supplierComponent',
    },
    {
        path: '/admin/dashboard/charts',
        component: chartComponent,
        name: 'chartComponent',
    },
    {
        path: '/admin/dashboard/orders',
        component: orderComponent,
        name: 'orderComponent',
    },
    {
        path: '/admin/dashboard/discount/date-component',
        component: dateComponent,
        name: 'dateComponent',
    },
];

export default routes;