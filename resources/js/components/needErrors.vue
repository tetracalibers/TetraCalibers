<template>
    <div v-if="errors" class="alert _white _shadow _box _f-danger">
        <i class="fas fa-exclamation-triangle"></i>
        {{ errors }}
        <span class="-close">×</span>
    </div>
</template>

<script>
export default {
    props: ['errors']
}
</script>
