<template>
    <div class="card">

        <div v-if="this.$slots.header" class="card-header">
            <slot name="header"></slot>
        </div>

        <div v-if="this.$slots.body" class="card-body">
            <slot name="body"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Card',
        props: {
            title: { type: String, default: null }
        }
    }
</script>
