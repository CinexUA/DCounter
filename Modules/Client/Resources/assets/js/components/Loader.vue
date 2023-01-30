<template>
    <div :class="{global}">
        <div class="spinner-border" :class="color" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Loader",
        props: {
            global: {
                required: false,
                type: Boolean,
                default: false
            }
        },
        computed: {
            color(){
                const colors = [
                    'text-primary', 'text-secondary', 'text-success', 'text-danger', 'text-warning', 'text-info'
                ];
                return colors[Math.floor(Math.random() * colors.length)];
            }
        },
        mounted() {

        }
    }
</script>

<style scoped lang="scss">
    .spinner-border{
        position: absolute;
        top: calc(50% - 1.5rem);
        left: calc(50% - 1.5rem);
        width: 3rem;
        height: 3rem;
    }
    .global{
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: white;
        opacity: .8;
        z-index: 9999;

        .spinner-border{
            position: absolute;
            /*top: 50%;
            left: 50%;*/
        }
    }
</style>
