import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
  state: {    
    todoItemText: '',
    items: [],
  },
  getters: {

  },
  mutations: { 
    addTodo (state) {
      let text = state.todoItemText.trim()
      if (text !== '') {
          //guarda en base
          axios.post('api/todos',{
              text: state.todoItemText
          }).then(response => {    
              //agregamos al principio de la lista en la vista 
              state.items.unshift({ text: text, done: false, id: response.data.id });
              state.todoItemText = '';
          }).catch(error => {
              console.log(error.response.data)
          });
      }
    },
    changeText (state,event){
      state.todoItemText = event.target.value;
    },
    removeTodo (state,id) {
      //removemos de la base por medio del id
      axios.delete('api/todos/'+id).then(response => {
          state.items = state.items.filter(item => item.id !== id)  //Se compara con el id
      }).catch(error => {
          console.log("Error al borrar: "+error.response.data)
      });
    }
  }
})