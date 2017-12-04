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
        },
        methods: {
            /*addTodo () {
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
            removeTodo (id) {
                //removemos de la base por medio del id
                axios.delete('api/todos/'+id).then(response => {
                    this.$store.state.items = this.$store.state.items.filter(item => item.id !== id)  //Se compara con el id
                }).catch(error => {
                    console.log("Error al borrar: "+error.response.data)
                });
            },
            toggleDone (id) {
                let todos = this.$store.state.items.filter(function (item) {
                    return item.id === id;
                });
                let todo = todos[0];
                //actualizamos en la base el estado de hecho o 'done'
                axios.put('api/todos/' + id, todo).then(response =>{    //En el request es mejor enviar algo para verificar si hay datos .
                    todo.done = !todo.done
                }).catch(error => {
                    console.log("Error al actualizar: "+error.response.data)
                });
            }*/
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
