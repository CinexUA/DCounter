<template>
    <div>
        <modal
            :title="$t('client.found_customers')"
            :showFooter="true"
            :btnOpenModalShow="false"
            :showModalProp="true"
        >
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th scope="col">{{$t('name')}}</th>
                        <th scope="col">{{$t('provider')}}</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="client in clients">
                        <td>{{ client.name }}</td>
                        <td>{{ client.provider }}</td>
                        <td>
                            <a
                                v-if="!isTokenExist(client.token)"
                                href="#" @click.prevent="onAdd(client)"
                            >
                                {{$t('add')}}
                            </a>
                            <p v-else>
                                {{$t('added')}}
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </modal>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "ChooseClient",
        props: {
            clients: { type: Array, default: [] }
        },
        computed: {
            ...mapGetters({
                isTokenExist: 'client/isTokenExist',
            })
        },
        methods: {
            onAdd(client){
                this.$store.dispatch('client/saveToken', client)
                Fire.$emit('reloadClients')
            }
        }
    }
</script>

<style scoped>

</style>
