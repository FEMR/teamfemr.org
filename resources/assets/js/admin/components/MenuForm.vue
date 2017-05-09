<template>
    <li>
        <form :method=" method == 'get' ? 'get' : 'post' " :action="route">
            <input name="_method" type="hidden" :value="method">
            <input name="_token" type="hidden" :value="token">
            <button class="link" type="submit">
                <slot></slot>
            </button>
        </form>
    </li>
</template>

<script type="text/babel">

    export default {

        props: [ 'route', 'method', 'token' ],
        data() {

            return {

            }
        }
    }

</script>

<style scoped>

    button.link {

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

    button.link .icon{

        margin-right: 6px;
    }

    button.link:hover {

        color: #333333;
    }
</style>