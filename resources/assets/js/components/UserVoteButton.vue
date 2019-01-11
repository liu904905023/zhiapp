<template>
    <button  class="btn btn-default"
             v-text="text"
             v-bind:class="btnclass"
             v-on:click="vote"
    >
    </button>
</template>

<script>
    export default {
        props:['answer','count'],
        mounted() {
            axios.get('/api/answer/'+this.answer+'/votes/user').then(
                response => {
                    this.voted = response.data.voted;

                }
            );
        },
        data(){
            return {
                voted: false
            };
        },

        computed:{
            text(){
                return this.count ;
            },
            btnclass(){
                return this.voted ? 'btn-primary' : ''
            }
        },
        methods:{
            vote(){
                axios.post('/api/answer/vote',{'answer':this.answer}).then(
                    response => {
                        this.voted = response.data.voted;
                        this.voted?this.count++:this.count--;
                    }
                );
            }
        }
    }
</script>
