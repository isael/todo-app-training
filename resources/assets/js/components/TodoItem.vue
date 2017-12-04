<template>
	<div>
		<td class="is-fullwidth" style="cursor: pointer" :class="{ 'is-done': done }" @click="toggleDone(id)">
	        {{ text }}
	    </td>
	    <td class="is-narrow">
	        <a class="button is-danger is-small" @click.prevent="removeTodo(id)">Eliminar</a>
	    </td>
    </div>
</template>

<script>
	export default{
		props:{
			text: {
				type: String,				
				required: true,
			},
			id: {
				type: Number,
				required: true,
			},
			done: {
				type: Boolean,
				required: true,
			}
		},
		methods: {
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
            }
		}
		/*computed: {
			text(){
				return this.$store.state.text;
			},
			id(){
				return this.$store.state.id;
			},
			done(){
				return this.$store.state.done;
			},
		}*/
	}
</script>