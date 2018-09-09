<template>
    <span class="leading-normal">{{ field.value }}</span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>
