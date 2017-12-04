<template>    
    <form method= "POST" v-on:submit.prevent="$emit('addTodo')">
        <div class="box">
            <div class="field is-grouped">
                <p class="control is-expanded">
                    <input class="input" type="text" placeholder="Nuevo recordatorio" :value="todoItemText" @input="changeText">
                </p>
                <p class="control">
                    <a class="button is-info" @click="$emit('addTodo')">
                        Agregar
                    </a>
                </p>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        props:['todoItemText'], //Propiedad que será modificada desde el vue Todo
        data () {
            return {
                todoItemInputText: ''
            }
        },
        methods: {
            changeText(event){
                this.todoItemInputText = event.target.value;    //Detecta los cambios de Todo y actualiza
                this.$emit('changeText',this.todoItemInputText) //Actualiza todoItemText del Todo
            }
        }
    }
</script>