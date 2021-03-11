<template>
    <a @click="eraseClients()" href="#" class="dropdown-item pl-3">
        Erase clients
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
                    title: 'Clear clients list?',
                    text: "Clients list will be cleared!",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: 'Yes, delete it !',
                    cancelButtonText: 'No, cancel !',
                }).then(result => {
                    if (result.value) {
                        this.$store.dispatch('client/removeTokens')
                        Fire.$emit('reloadClients')
                        Swal.fire("Clients has been deleted!", '', "success")
                    }
                })
            },
        }
    }
</script>

<style scoped>

</style>
