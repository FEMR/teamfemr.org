<template>
    <div>
        <button class="button is-info" @click="isVisible=!isVisible">View Other Programs</button>
        <div :class="{ modal:true, 'map-modal': true, 'is-active': isVisible }">
            <div class="modal-background"></div>
            <div class="modal-content">

                <femr-map></femr-map>

            </div>
            <button class="modal-close is-large" aria-label="close" @click="isVisible=!isVisible"></button>
        </div>
    </div>
</template>

<script type="text/babel">

    import * as VueGoogleMaps from 'vue2-google-maps';

    import InfoWindow from './InfoWindow';

    export default {

        components: {

        },
        data() {

            return {

                isVisible: false
            }
        },
        methods: {}
    }

</script>

<style scoped>



</style>