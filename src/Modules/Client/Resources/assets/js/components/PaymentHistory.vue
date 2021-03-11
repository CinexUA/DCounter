<template>
    <div>
        <modal
            title="Payment history"
            :btnOpenModalShow="true"
            modalDialogClass="modal-xl modal-dialog-scrollable"
            btnOpenModalName="show"
            btnOpenModalClass="btn btn-sm btn-primary"
            @onOpen="loadPaymentHistory"
        >
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th scope="col">Uuid</th>
                        <th scope="col">Type</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="payment in payments.data">
                        <td>{{ payment.uuid }}</td>
                        <td v-if="payment.type === 'deposit'">
                            <span class="badge bg-success">deposit</span>
                        </td>
                        <td v-else>
                            <span class="badge bg-danger">withdrawal</span>
                        </td>
                        <td>{{payment.amount}}</td>
                        <td>{{payment.description}}</td>
                        <td>{{payment.created_at_human}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <pagination
                class="mt-3"
                align="right"
                size="small"
                :data="payments"
                @pagination-change-page="loadPaymentHistory">
            </pagination>
        </modal>
    </div>
</template>

<script>
    import Pagination from 'laravel-vue-pagination'

    export default {
        name: "PaymentHistory",
        components: {
            Pagination
        },
        props: {
            rememberToken: { type: String }
        },
        data: () => ({
            showHistory: false,
            payments: {}
        }),
        methods: {
            async loadPaymentHistory(page = 1){
                this.payments = await this.$store.dispatch(
                    'client/fetchClientPaymentHistory',
                    {
                        rememberToken: this.rememberToken,
                        page
                    }
                )
            }
        }
    }
</script>

<style scoped>

</style>
