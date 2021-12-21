<div>
    <div class="h-90 w-full">
       <div class="h-full p-2 flex flex-col-reverse overflow-scroll"> 
            <div v-for="(message, index) in messages" :key="index">
                prova1 
                prvoa2
                prova3
                <message-item :message="message" />
            </div>
        </div>
    <script>
    export default{
        }
    </script>