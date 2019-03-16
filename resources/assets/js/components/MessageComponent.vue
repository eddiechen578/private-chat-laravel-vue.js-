<template>
    <div class="card card-default chat-box">
        <div class="card-header">
           <b :class="{'text-danger':session_block}">
               {{friend.name}}
               <span v-if="session_block">(blocked)</span>
           </b>
            <!-- Close Button -->
            <a href="" @click.prevent="close">
                <i class="fa fa-times pull-right" aria-hidden="true"></i>
            </a>
            <!-- Close Button Ends-->

            <!-- Option Button -->
           <div class="dropdown pull-right mr-4">
                <a href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="#" class="dropdown-item" @click="unBlock" v-if="session_block"
                       >UnBlock</a>
                    <a href="#" class="dropdown-item" @click="block"   v-else
                    >Block</a>
                    <a href="#" class="dropdown-item" @click.prevent="clear">Clear Chat</a>
                </div>
           </div>
            <!-- Option Button Ends -->
        </div>
        <div class="card-body" v-chat-scroll>
            <p class="card-text" :class="{'text-right':chat.type == 0}" v-for="chat in chats" :key="chat.id">
                  {{chat.message}}
            </p>
        </div>
        <form class="card-footer" @submit.prevent="send">
            <input class="form-control" type="text" placeholder="write the text here"
             :disabled="session_block" v-model="message">
        </form>
    </div>
</template>

<script>
    export default {
        props:['friend'],
        data(){
          return{
              chats:[],
              session_block:false,
              message:null
          }
        },
         methods:{
             send(){
                if(this.message){
                    this.pushToChats(this.message);
                    this.saveMessage();
                    this.message = null;
                }
             },
             pushToChats(message){
                this.chats.push({message: message, type:0, send_at:'Just Now'});
             },
             saveMessage(){
                 axios.post(`/send/${this.friend.session.id}`,{
                     content:this.message,
                     to_user:this.friend.id
                 });
             },
             close(){
                this.$emit('close');
             },
             clear(){
                this.chats=[];
             },
             block(){
                this.session_block = true;
             },
             unBlock(){
                this.session_block = false;
             },
             getAllMessages(){
                 axios
                   .post(`/session/${this.friend.session.id}/chats`)
                   .then(res => (this.chats = res.data.data));
             }
         },
        created(){
            this.getAllMessages();

            Echo.private(`Chat.${this.friend.session.id}`).listen('PrivateChatEvent', (e) => {
                    console.log('Event listen CommentSent')
                    this.chats.push({message: e.content, type:1, send_at:'Just Now'})
            });
        }
    };
</script>

<style>
    .chat-box{
        height:400px;
    }
    .card-body{
        overflow-y: scroll;
    }
</style>