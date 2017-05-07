<template>
    <div class="dropdown-menu" v-on-clickaway="hideMenu">
        <button class="button is-small" type="button" @click="toggleMenu">
            <span class="icon is-small">
              <i class="fa fa-caret-down"></i>
            </span>
        </button>
        <div class="box dropdown" v-show="isVisible">
            <aside class="menu">
                <ul class="menu-list">

                    <slot></slot>

                </ul>
            </aside>
        </div>
    </div>

</template>

<script type="text/babel">

    import EventBus from "../event-bus"
    import { mixin as clickaway } from 'vue-clickaway';

    export default {

        mixins: [ clickaway ],
        props: [],
        data() {

            return {

                isVisible: false
            }
        },
        methods: {

            toggleMenu() {

                this.isVisible = ! this.isVisible;
            },
            hideMenu() {

                this.isVisible = false;
            }
        }
    }

</script>

<style scoped>

    .dropdown-menu{

        position: relative;
    }

    .dropdown-menu .dropdown {

        box-shadow: 0 0 8px #777;
        position: absolute;
        left: 0;
        top: 100%;
        z-index: 1000;
        padding:  10px;
    }

    .dropdown-menu .icon {

        margin-right: 5px;
    }

</style>