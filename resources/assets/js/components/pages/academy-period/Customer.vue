<template>
    <div class="content-row">
        <h2 class="content-row-title">Index Period Customer</h2>
        <div class="row">
            <div class="col-md-5">
                <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Search by academy or customer then type Enter"
                    v-model="search"  
                    @keyup.enter="getResults(1)">
            </div>
            <div class="col-md-2">
                <v-select 
                    placeholder="-- Select status --"
                    label="name"
                    track-by="code"
                    v-model="status" 
                    :options="[{code: 0, name: 'Not yet paid'}, {code: 1, name: 'Paid'}, {code: 2, name: 'Pending'}]" 
                    @input="getResults(1)"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" v-if="result.data.length">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Academy</th>
                                <th>Period</th>
                                <th>Customer</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-bind:key="index"
                                v-for="(item, index) in result.data">
                                <td>{{ (index+1) }}</td>
                                <td>{{ item.academy_name }}</td>
                                <td>{{ item.academy_period }}</td>
                                <td>{{ item.customer_name }}</td>
                                <td>{{ item.price }}</td>
                                <td>{{ item.description }}</td>

                                <!-- STATUS -->
                                <td v-if="item.status === 0">
                                    <span>Not yet paid</span>
                                </td>
                                <td v-else-if="item.status === 1">
                                    <span>Paid</span>
                                </td>
                                <td v-else-if="item.status === 2">
                                    <span>Pending</span>
                                </td>
                                <!-- STATUS -->

                                <!-- ACTION -->
                                <td>
                                    <template v-if="item.status === 1">
                                        <a href="javascript:void(0)" @click="showData('show', item.payment_id)">
                                            <span class="fa fa-eye"></span>
                                        </a> &nbsp;
                                    </template>
                                    <template v-else>
                                        <a href="javascript:void(0)" @click="showData('show', item.payment_id)">
                                            <span class="fa fa-eye"></span>
                                        </a> &nbsp;
                                        <a href="javascript:void(0)" @click="showData('edit', item.payment_id)">
                                            <span class="fa fa-pencil-square-o"></span>
                                        </a> &nbsp;
                                    </template>
                                    <a href="javascript:void(0)" @click="destroyData(item)">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                </td>
                                <!-- ACTION -->
                            </tr>
                        </tbody>
                    </table>
                    <paginate
                        :page-count="result.last_page"
                        :click-handler="getResults"
                        :prev-text="'Prev'"
                        :next-text="'Next'"
                        :container-class="'pagination'">
                    </paginate>
                </div>
            </div>
            <div v-else>
                <div class="col-md-12">
                    <span>No data yet.</span>
                </div>
            </div>

            <!-- MODAL -->
            <modal 
                name="modal-box"
                height="auto">
                <div class="card">
                    <div class="card-header">
                        <div class="container">
                            <h3>Transaction #No. {{ payment.id }}</h3>
                            <div v-bind:key="index"
                                 v-for="(item, index) in payment.period_customers">
                                {{ item.academy_period.academy.name }} - {{ item.customer.name }} - {{ item.price }}
                            </div>
                        </div>
                    </div>

                    <hr>
                    
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="transaction_id">Transaction ID</label>
                                    <input class="form-control" id="transaction_id" v-model="payment.transaction_id">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="via">Via</label>
                                    <input class="form-control" id="via" v-model="payment.via" :readonly="modal_mode === 'show'">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" id="amount" v-model="payment.amount" :readonly="modal_mode === 'show'">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="transaction_status">Transaction Status</label>
                                    <input class="form-control" id="transaction_status" v-model="payment.transaction_status" :readonly="modal_mode === 'show'">
                                </div>
                                <div class="form-group col-md-12">
                                    <button
                                        v-if="modal_mode === 'edit'"
                                        @click.prevent="editData()" 
                                        class="btn btn-info" 
                                        type="submit">Update</button>
                                    <button class="btn btn-info" @click="$modal.hide('modal-box')">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </modal>
            <!-- MODAL -->
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                search: '',
                status: null,
                modal_mode: '',
                result: {
                    data: []
                },
                payment: {}
            }
        },
        mounted() {
            this.getResults(1);
        },
        methods: {
            getResults(page= 1) {
                let query= `page=${page}`;

                if (this.status) {
                    query+= `&status=${this.status.code}`;
                } else {
                    query+= `&search=${this.search}`;
                }

                this.$store.dispatch('academy_period/PERIOD_CUSTOMERS', query).then(response => {
                    this.result= response;
                });
            },
            showData(modal_mode, id) {
                this.modal_mode= modal_mode;
                
                this.$store.dispatch('payment/SHOW', { id: id, data_payment: 'Academy' }).then(response => {
                    this.payment= response;
                    this.$modal.show('modal-box');
                });
            },
            editData() {
                if (confirm(`Are you sure want to update payment: "${this.payment.transaction_id}"?`)) {
                    let data= {
                        id: this.payment.id,
                        amount: this.payment.amount,
                        via: this.payment.via,
                        transaction_status: this.payment.transaction_status
                    };

                    this.$store.dispatch('payment/UPDATE', data).then(response => {
                        this.showData('edit', data.id);
                    });
                }
            },
            destroyData(period_customer) { 
                if (confirm(`Are you sure want to delete customer: "${period_customer.customer_name}"?`)) {
                    this.$store.dispatch('academy_period/DESTROY_PERIOD_CUSTOMER', period_customer.id).then(response => {
                        this.getResults();
                    });
                }
            }   
        }   
    }   
</script>