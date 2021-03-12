<template>
    <div>
        <card>
            <template v-slot:header>
                <div class="d-md-flex align-items-md-center justify-content-md-between">
                    <h5 class="mb-0">{{$t('client.title')}}</h5>
                    <auth />
                </div>
            </template>

            <template v-slot:body>
                <div v-if="clients.length > 0" class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center" scope="col">{{$t('name')}}</th>
                            <th class="text-center" scope="col">{{$t('provider')}}</th>
                            <th class="text-center" scope="col">{{$t('price_per_month')}}</th>
                            <th class="text-center" scope="col">{{$t('left_days')}}</th>
                            <th class="text-center" scope="col">{{$t('balance')}}</th>
                            <th class="text-center" scope="col">{{$t('status')}}</th>
                            <th class="text-center" scope="col">{{$t('next_payment')}}</th>
                            <th class="text-center" scope="col">{{$t('payment_history')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="client in clients" :key="clients.id">
                            <td class="text-center">{{client.name}}</td>
                            <td class="text-center">{{client.provider}}</td>
                            <td class="text-center">{{client.provider_price}}</td>
                            <td class="text-center">{{client.left_days}}</td>
                            <td class="text-center" v-html="client.colorize_balance"></td>
                            <td class="text-center" v-html="client.status_as_badge"></td>
                            <td class="text-center">{{client.next_payment_humans}}</td>
                            <td class="text-center">
                                <payment-history :remember-token="client.remember_token"/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <p v-else class="mb-0">
                    {{$t('no_entries')}}
                </p>
            </template>
        </card>
    </div>
</template>

<script>
    import Auth from '../components/Auth'
    import PaymentHistory from "../components/PaymentHistory";

    export default {
        layout: 'default',
        components: {
            Auth, PaymentHistory
        },
        metaInfo () {
            return { title: this.$t('client.title') }
        },
        beforeMount() {
            Fire.$on('reloadClients', () => {
                this.loadClients()
            });
        },
        async created() {
            await this.loadClients()
        },
        data () {
            return {
                title: window.config.appName,
                clients: []
            }
        },
        methods: {
            async loadClients () {
                await this.$store.dispatch('client/fetchClients')
                this.clients = this.$store.getters['client/clients'];
            }
        }
    }
</script>
