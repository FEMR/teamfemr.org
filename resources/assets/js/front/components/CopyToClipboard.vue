<template>
    <div>
        <a class="button is-small femr-button clipboard-button" data-clipboard-target="#survey-template">
            <span class="icon is-small">
              <i class="fa fa-clipboard"></i>
            </span>
            <span>Copy</span>
        </a>
        <pre id="survey-template"><slot></slot></pre>
    </div>
</template>

<script type="text/babel">

    import Clipboard from 'clipboard';

    export default {

        data() {

            return {


            }
        },

        methods: {

            success(e) {


            }
        },

        created(){

            let clipboard = new Clipboard('.clipboard-button');
            clipboard.on( 'success', this.success );
        }
    }

</script>

<style scoped>

</style>