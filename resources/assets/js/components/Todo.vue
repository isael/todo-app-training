<template>
    <div class="container">
        <form method= "POST" v-on:submit.prevent="addTodo">
            <div class="box">
                <div class="field is-grouped">
                    <p class="control is-expanded">
                        <input class="input" type="text" placeholder="Nuevo recordatorio" v-model="todoItemText">
                    </p>
                    <p class="control">
                        <a class="button is-info" @click.prevent="addTodo">
                            Agregar
                        </a>
                    </p>
                </div>
            </div>
        </form>
        <table class="table is-bordered is-fullwidth">
            <tr class="is-fullwidth">
               <TodoItem  v-for="(todo, index) in items" :key="index" :id="todo.id" :done="todo.done" :text="todo.text" @toggleDone="toggleDone" @removeTodo="removeTodo"/>
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

    export default {
        components:{
            TodoItem
        },
        data () {
            return {
                todoItemText: '',
                items: [],
            }
        },
        mounted () {
            axios.get('api/todos').then(response => {
                this.items = response.data
            });
            //pendiente
        },
        methods: {
            addTodo () {
                let text = this.todoItemText.trim()
                if (text !== '') {
                    //guarda en base
                    axios.post('api/todos',{
                        text: this.todoItemText
                    }).then(response => {    
                        //agregamos al principio de la lista en la vista                    
                        this.items.unshift({ text: text, done: false });
                        this.todoItemText = '';
                    }).catch(error => {
                        alert(error.response.data)
                    });
                }
            },
            removeTodo (id) {
                //removemos de la base por medio del id
                axios.delete('api/todos/'+id).then(response => {
                    this.items = this.items.filter(item => item.id !== id)  //Se compara con el id
                }).catch(error => {
                    alert(error.response.data)
                });
            },
            toggleDone (todo) {
                //actualizamos en la base el estado de hecho o 'done'
                axios.put('api/todos/'+todo.id,todo).then(response =>{    //El request es vacio ya que es suficiente con el id para hacer la actualizacion.
                    todo.done = !todo.done
                }).catch(error => {
                    alert(error.response.data)
                });
            }
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
