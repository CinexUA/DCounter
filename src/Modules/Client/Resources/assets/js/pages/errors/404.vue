<template>
    <card class="text-center">
        <template v-slot:header>
            {{ $t('page_not_found') }}
        </template>

        <template v-slot:body>
            <div class="links">
                <router-link :to="{ name: 'index' }">
                    {{ $t('go_home') }}
                </router-link>
            </div>
        </template>
    </card>
</template>

<script>
    export default {
        name: 'NotFound'
    }
</script>
