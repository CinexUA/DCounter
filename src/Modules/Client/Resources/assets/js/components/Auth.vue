<template>
    <div>
        <modal
            title="New Client"
            :showFooter="true"
            btnOpenModalClass="btn btn-sm btn-success"
            btnOpenModalName="Add new client"
            @onClose="onClose"
        >
            <form
                @submit.prevent="onSave"
                @keydown="form.onKeydown($event)"
            >
                <div class="form-group">
                    <label>Email</label>
                    <input v-model="form.email" type="text" name="email"
                           class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input v-model="form.password" type="password" name="password"
                           class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                    <has-error :form="form" field="password"></has-error>
                </div>
            </form>

            <template v-slot:footer-buttons>
                <button
                    type="button"
                    class="btn btn-primary"
                    @click.prevent="onSave()"
                >
                    Auth
                </button>
            </template>

        </modal>

        <choose-client v-if="clients.length > 0" :clients="clients" />
    </div>
</template>

<script>
    import { Form } from 'vform'
    import ChooseClient from "./ChooseClient";
    import Swal from "sweetalert2";

    export default {
        name: "Auth",
        components: {
            ChooseClient
        },
        data: () => ({
            form: new Form({
                email: '',
                password: ''
            }),
            clients: []
        }),
        methods: {
            async onSave(){
                this.clients = []
                const { data } = await this.form.post('/api/client/auth')

                if(data.data.length === 0){
                    Swal.fire({
                        type: 'warning',
                        title: 'Account(s) not found',
                        reverseButtons: true,
                        confirmButtonText: 'Ok',
                    })
                } else {
                    this.clients = data.data
                }
            },
            onClose(){
                this.form.email = ''
                this.form.password = ''
                this.clients = []
            }
        }
    }
</script>
