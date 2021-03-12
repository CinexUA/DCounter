<template>
    <a @click="eraseClients()" href="#" class="dropdown-item pl-3">
        {{$t('client.erase_clients')}}
    </a>
</template>

<script>
    import Swal from "sweetalert2";

    export default {
        name: "EraseClients",
        methods: {
            eraseClients(){
                Swal.fire({
                    type: 'warning',
                    title: this.$t('client.clear_clients_list'),
                    text: this.$t('client.clients_list_will_be_cleared'),
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: this.$t('yes_delete_it'),
                    cancelButtonText: this.$t('no_cancel'),
                }).then(result => {
                    if (result.value) {
                        this.$store.dispatch('client/removeTokens')
                        Fire.$emit('reloadClients')
                        Swal.fire(this.$t("client.clients_has_been_deleted"), '', "success")
                    }
                })
            },
        }
    }
</script>

<style scoped>

</style>
