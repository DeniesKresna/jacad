import CustomerIndex from '../components/pages/customer/Index.vue';
import CustomerDetail from '../components/pages/customer/Detail.vue';

export const customer= [
    {
        name: 'CustomerIndex',
        path: '/customer',
        component: CustomerIndex
    }, 
    {
        name: 'CustomerDetail',
        path: '/customer/:id',
        component: CustomerDetail
    }
];