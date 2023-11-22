<template>
    <button @click.prvent="onClick" class="text-white bg-green-500 rounded">
        <slot></slot>
    </button>
</template>

<script setup>
defineProps({
    onClick: {
        type: Function,
        required: true
    }
})
</script>

<style lang="scss" scoped>

</style>