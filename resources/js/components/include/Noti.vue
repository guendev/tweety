<template>
    <div class="position-absolute shadow-sm z100 mt-2 mx-3 r0">
        <div
            v-for="(noti, index) in notis"
            class="text-light mb-3 bg-primary p-3 br10 position-relative"
            style="box-sizing: border-box;"
        >
            <div class="el-notification__group">
                <h2 class="el-notification__title fs18">{{noti.title}}</h2>
                <div class="el-notification__content">
                    <p>{{ noti.content }}</p>
                </div>
                <div class="el-notification__closeBtn el-icon-close">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { eventBus } from "../../app";
    export default {
        name: "Noti",
        data() {
            return {
                notis: []
            }
        },


        methods: {
          showNoti($data) {
              this.notis.unshift($data);
              setTimeout( ()=> {
                  this.notis.pop();
              }, 3000)

          }
        },
        created() {
            eventBus.$on('noti', ($data) => {
                this.showNoti($data);
            })
        }


    }
</script>

<style scoped>

</style>
