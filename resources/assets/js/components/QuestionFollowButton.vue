<template>
    <button  class="btn btn-default"
             v-text="text"
             v-bind:class="btnclass"
             v-on:click="follow"
    >
    </button>
</template>

<script>
    export default {
        props:['question','user'],
        mounted() {
            axios.post('/api/question/follower',{'question':this.question,'user':this.user}).then(
                response => {
                    this.followed = response.data.followed;

                }
            );
        },
        data(){
            return {
                followed: false
            };
        },

        computed:{
            text(){
                return this.followed ? '已关注' : '关注' ;
            },
            btnclass(){
                return this.followed ? 'btn-success' : ''
            }
        },
        methods:{
            follow(){
                axios.post('/api/question/follow',{'question':this.question}).then(
                    response => {
                        this.followed = response.data.followed;
                    }
                );
            }
        }
    }
</script>
