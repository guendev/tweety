<template>
    <div class="site-header bg-dark-1">
        <div class="container">
            <div class="row h50 fs18 justify-content-between align-items-center">
                <div
                    class="col-auto"
                    v-if="$route.fullPath !== '/'"
                >
                    <a
                        href="javascript:void(0)"
                        @click="back()"
                    >
                        <svg class="fs24"><use xlink:href="#i-back"></use></svg>
                    </a>
                </div>
                <div class="text-light mr-auto col-auto d-flex flex-column">
                    <div class="site-name">{{ $route.fullPath === '/' ? 'Trang Chủ' : title === '' ? 'Back' : title }}</div>
                    <small
                        class="text-muted fs12 mb-2"
                        v-if="$route.fullPath !== '/' && title !== '' "
                    >{{ subHeader }}</small>
                </div>

                <div
                    class="col-auto ml-auto d-flex"
                    v-if="$route.fullPath === '/'"
                >
                    <a href="javascript:void(0)">
                        <svg class="fs24"><use xlink:href="#i-reload"></use></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { eventBus } from "../../app";
    export default {
        name: "Header",
        data() {
            return {
                title: '',
                subHeader: '',
                profile_url: new RegExp('^(/@)([a-zA-Z0-9])*$', 'i'),
                discover_url: new RegExp('^(/)(discovery)*$', 'i')
            }
        },
        methods: {
            back(){
                if (history.back() !== undefined){
                    history.back()
                } else {
                    const current_url = this.$route.fullPath;
                    if (this.profile_url.test(current_url) || this.discover_url.test(current_url)){
                        window.location.href = '/';
                    }
                }
            }
        },
        created() {
            eventBus.$on('header-data', ($data) => {
                this.title = $data.title;
                this.subHeader = $data.subHeader
            });
        }
    }
</script>

<style scoped>

</style>
