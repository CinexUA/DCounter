<template>
    <div>
        <a
            v-if="btnOpenModalShow"
            href="#"
            :class="btnOpenModalClass || 'btn btn-success'"
            @click.prevent="onOpen()"
        >
            {{btnOpenModalName}}
        </a>

        <div v-if="showModal">
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div :class="['modal-dialog', ...modalDialogClass]" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{title}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" @click="onClose()">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <slot />
                                </div>
                                <div class="modal-footer">
                                    <button
                                        v-if="btnCloseModalShow"
                                        type="button"
                                        class="btn btn-secondary"
                                        @click.prevent="onClose()"
                                    >
                                        {{btnCloseModalName || $t('close')}}
                                    </button>
                                    <slot name="footer-buttons"></slot>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Modal",
        props: {
            showModalProp: {type: Boolean, default: false},
            showModalClass: { type: String, default: '' },
            title: { type: String, default: null },
            showFooter: { type: Boolean, default: false },
            modalScrolling: { type: Boolean, default: false },
            modalDialogClass: { type: String, default: '' },
            btnOpenModalName: { type: String, default: 'Modal' },
            btnOpenModalClass: { type: String, default: null },
            btnOpenModalShow: { type: Boolean, default: true },
            btnCloseModalName: { type: String },
            btnCloseModalShow: { type: Boolean, default: true },
        },
        data () {
            return {
                showModal: this.showModalProp
            }
        },
        methods: {
            onClose(){
                this.showModal = false
                this.$emit('onClose')
            },
            onOpen(){
                this.showModal = true
                this.$emit('onOpen')
            }
        }
    }
</script>

<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }
</style>
