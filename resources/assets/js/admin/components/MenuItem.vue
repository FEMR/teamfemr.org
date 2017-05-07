<template>
    <li>
        <a class="link" :href="link">
            <slot></slot>
        </a>
    </li>
</template>

<script type="text/babel">

    export default {

        props: [ 'link' ],
        data() {

            return {

            }
        }
    }

</script>

<style scoped>

    .link {

        font-family: inherit;
        white-space: nowrap;
        text-align: left;
        line-height: 1.5rem;
        font-size: 0.9em;
        color: #6f6f6f;
        cursor: pointer;

        border: none;
        background-color: transparent;
    }

    .link:hover {

        color: #333333;
    }
</style>