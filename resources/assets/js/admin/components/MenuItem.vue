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

    a.link {

        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;

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

    a.link .icon{

        margin-right: 6px;
    }

    a.link:hover {

        color: #333333;
    }
</style>