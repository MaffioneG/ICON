<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        
            <div class= "relative h-10 m-1">
                <div style="border-top: 1px solid #e6e6e6;" class="grid grif-cols-6">
                    <input 
                    type="text"
                    v-model="massage"
                    @keyuo.enter="sendMessage()"
                    placeholder="Digita Qui..."
                    class="col-span-5 outline-noe p-1"  
                    />   
                    <x-jet-button 
                    @click="sendMessage()"
                    class="place-self-end bg-gray-500 hover:bg.-blue-700 p-1 mt-1 rounded text-white">
                    {{ __('Invia') }}
                </x-jet-button> 
                </div>
            </div>
           
            </x-jet-authentication-card>
</x-guest-layout>            

<script>
    export default{
        components: {Input},
        props:['room'],
        data: function (){
            return {
                message: '' 
            }
        },
        methods: {
            sendMessage(){
                if(this.message == ' '){
                    return ;
                }

                axios.post('/chat/romm/' + this.room.id + '/message', {
                    message: this.message
                })
                .then ( response => {
                    if(response.status == 201) {
                    this.message= '';
                    this.$emit('messagesent');
                }
            })
            .catch (error =>{
                console.log(error);
            })
        }
    }
}  
<script>


