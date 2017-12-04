<template>
    <div class="container">

        <TodoInput/>

        <table class="table is-bordered is-fullwidth">
            <tr class="is-fullwidth">
               <TodoItem  v-for="(todo, index) in items" :key="index" :id="todo.id" :done="todo.done" :text="todo.text"/>
            </tr>
        </table>

    </div>
</template>

<script>
    //Importamos los vue hijos
    import TodoItem from './TodoItem.vue';
    import TodoInput from './TodoInput.vue';

    export default {
        computed: {
            items(){
                return this.$store.getters.getItems;
            }
        },
        components:{
            TodoInput, TodoItem
        },
        mounted () {    //Se ejecuta la actualizacion de la lista de Items en un mutation
            this.$store.commit('cargaItems')
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
