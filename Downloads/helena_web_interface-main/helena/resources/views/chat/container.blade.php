<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <x-messageContainer />
            <x-inputMessage />

             
              <input-message 
              :room="currentRoom"
              v-on:messagesent="getMessages()"/>
            </div>
        </div>
    </div>
    </x-app-layout>

    <script>
        import AppLayout from '@Layouts/AppLayout'
        import MessageContainer from './messageContainer.blade.php'
        import InputMessage from '/usr/local/share/pear/htdocs/TESI/helena/resources/views/components/input-message.blade.php'

        export default{
            components: {
                AppLayout,
                MessageContainer,
                InputMessage,
            },
            data: function(){
                return {
                    chatRooms: [],
                    currentRoom: [],
                    messages: []
                }
            }
            method:{
                getRooms(){
                    axios.get('/chat/rooms')
                    .then(responese =>{
                        this.chatRooms = response.data;
                        this.setRoom(response.data[0]);
                    })
                    .catch(error => {
                        console.log(error);
                    })
                },

                setRoom (room){
                    this.currentRoom = room;
                    this.getMessages();
                },
                getMessages(){
                    axios.get('chat/room/' + this.currentRoom.id + '/messages')
                    .then(response => {
                        this.messages = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
                
                }
            },
            created() {
                this.getRooms();
            }
        }
    </script>
