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
    //Importamos los vue hijos
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
            //this.$store.state.items = this.$store.getters.getTodos
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
