<template>
	<div>
		<td class="is-fullwidth" style="cursor: pointer" :class="{ 'is-done': done }" @click="toogleDone(id)">
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
		methods: {	//Redirigen a los mutations del store
			removeTodo (id) {
                this.$store.dispatch('removeTodo',id);
            },
            toogleDone (id) {
                this.$store.dispatch('toogleDone',id);
            }
		},
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