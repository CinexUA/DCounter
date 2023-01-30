<template>
    <div id="app">
        <loader v-if="loading" :global="true" />

        <transition name="page" mode="out-in">
            <component :is="layout" v-if="layout" />
        </transition>
    </div>
</template>

<script>
    import Loader from './Loader'
    import DefaultLayout from '../layouts/default'

    export default {
        el: '#app',
        components: {
            Loader, DefaultLayout
        },
        computed: {
            layout(){
                return (this.$route.meta.layout || 'default') + '-layout'
            }
        },
        data: () => ({
            loading: false
        }),
        metaInfo () {
            const { appName } = window.config
            return {
                title: appName,
                titleTemplate: `%s · ${appName}`
            }
        },
        beforeMount(){
            Fire.$on('showLoader', () => {
                this.loading = true;
            });
            Fire.$on('hideLoader', () => {
                this.loading = false;
            });
        },
    }
</script>
