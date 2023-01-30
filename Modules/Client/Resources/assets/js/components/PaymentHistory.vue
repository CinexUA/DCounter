<template>
    <div>
        <modal
            :title="$t('payment_history')"
            :btnOpenModalShow="true"
            modalDialogClass="modal-xl modal-dialog-scrollable"
            :btnOpenModalName="$t('show')"
            btnOpenModalClass="btn btn-sm btn-primary"
            @onOpen="loadPaymentHistory"
        >
            <div v-if="isTableNotEmpty">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th scope="col">{{$t('uuid')}}</th>
                            <th scope="col">{{$t('type')}}</th>
                            <th scope="col">{{$t('amount')}}</th>
                            <th scope="col">{{$t('description')}}</th>
                            <th scope="col">{{$t('date')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="payment in payments.data">
                            <td :data-title="$t('uuid')"><span>{{ payment.uuid }}</span></td>
                            <td :data-title="$t('type')" v-if="payment.type === 'deposit'">
                                <span class="badge bg-success">{{$t('deposit')}}</span>
                            </td>
                            <td :data-title="$t('type')" v-else>
                                <span class="badge bg-danger">{{$t('withdrawal')}}</span>
                            </td>
                            <td :data-title="$t('amount')">{{payment.amount}}{{payment.currency}}</td>
                            <td :data-title="$t('description')">{{payment.description || '&nbsp;'}}</td>
                            <td :data-title="$t('date')">{{payment.created_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div v-else>
                {{$t('no_entries')}}
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
        computed: {
            isTableNotEmpty: function () {
                return this.payments["data"] !== undefined && this.payments.data.length > 0
            }
        },
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
    @media only screen and (max-width: 800px) {
        table tbody tr td:first-child span{
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 135px;
            white-space: nowrap;
        }
    }
</style>
