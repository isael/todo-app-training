<template>
    <div class="container">
        <TodoInput/>
        <table class="table is-bordered is-fullwidth">
            <tr class="is-fullwidth">
               <TodoItem  v-for="(todo, index) in this.$store.state.items" :key="index" :id="todo.id" :done="todo.done" :text="todo.text"/>
            </tr>
        </table>
    </div>
</template>

<script>
    /**
     * Tips:
     * - En mounted pueden obtener el listado del backend de todos y dentro de la promesa de axios asirnarlo
     *   al arreglo que debe tener una estructura similar a los datos de ejemplo.
     * - En addTodo, removeTodo y toggleTodo deben hacer los cambios pertinentes para que las modificaciones,
     *   addiciones o elimicaiones tomen efecto en el backend asi como la base de datos.
     */

    import TodoItem from './TodoItem.vue';
    import TodoInput from './TodoInput.vue';

    export default {
        components:{
            TodoInput, TodoItem
        },
        mounted () {
            axios.get('api/todos').then(response => {
                this.$store.state.items = response.data
            });
            //this.items = store.getters.getTodos,
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
