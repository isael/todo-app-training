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
        methods: {  //Se ejecutan los metodos en los mutations del store
            changeText(event){  
                this.$store.commit('changeText');
            },
            addTodo () {
                this.$store.commit('addTodo');
            },
        }
    }
</script>