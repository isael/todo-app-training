<template>    
    <form method= "POST" v-on:submit.prevent="addTodo">
        <div class="box">
            <div class="field is-grouped">
                <p class="control is-expanded">
                    <input class="input" type="text" placeholder="Nuevo recordatorio" :value="todoItemText" @input="changeText">
                </p>
                <p class="control">
                    <a class="button is-info" @click="addTodo">
                        Agregar
                    </a>
                </p>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        //Cambiamos los props por acceso directo al store
        computed: {
            todoItemText(){
                return this.$store.state.todoItemText;
            }
        },
        methods: {
            changeText(event){  //Se actualiza directo en la variable del store
                this.$store.state.todoItemText = event.target.value;
            },
            addTodo () {
                let text = this.$store.state.todoItemText.trim()
                if (text !== '') {
                    //guarda en base
                    axios.post('api/todos',{
                        text: this.$store.state.todoItemText
                    }).then(response => {    
                        //agregamos al principio de la lista en la vista 
                        this.$store.state.items.unshift({ text: text, done: false, id: response.data.id });
                        this.$store.state.todoItemText = '';
                    }).catch(error => {
                        console.log(error.response.data)
                    });
                }
            },
        }
    }
</script>