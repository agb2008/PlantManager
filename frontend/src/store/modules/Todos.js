import * as types from './mutation-types'

export const namespaced = true;

export const state = {
    filter: 'all',
    todos: [
      {
        id: 1,
        title: 'Finish vue screencast',
        date: '2021-06-18',
        description: '2 litra vodi',
        completed: false,
        editing: false
      },
      {
        id: 2,
        title: 'Take over world',
        date: '2021-06-19',
        completed: false,
        description: 'kakoe to udobrenie',
        editing: false
      }
    ]
}

export const getters = {
    remaining: state => {
      return state.todos.filter(t => !t.completed).length
    },
    anyRemaining: (state, getters) => {
      return getters.remaining != 0
    },
    todosFiltered: state => {
      if(state.filter === 'all'){
        return state.todos
      } else if(state.filter === 'active'){
        return state.todos.filter(t => !t.completed)
      } else if(state.filter === 'completed'){
        return state.todos.filter(t => t.completed)
      }

      return state.todos
    },
    showClearCompletedButton: state => {
      return state.todos.filter(t => t.completed).length > 0
    }
  }

  export const mutations = {
    [types.ADD_TODO](state, todo){
      state.todos.push({
        id: todo.id,
        title: todo.title,
        completed: false,
        editing: false
      })
    },
    [types.CLEAR_COMPLETED](state){
      state.todos = state.todos.filter(todo => !todo.completed)
    },
    [types.CHANGE_FILTER](state, filter){
      state.filter = filter
    },
    [types.CHECK_ALL](state, checked){
      state.todos.forEach(t => t.completed = checked)
    },
    [types.REMOVE_TODO](state, index){
      state.todos.splice(index, 1)
    },
    updateTodo(state, todo){
      const index = state.todos.findIndex(t => t.id === todo.id)
      state.todos.splice(index, 1, {
        id: todo.id,
        title: todo.title,
        completed: todo.completed,
        editing: todo.editing
      })
    }
  }

  export const actions = {
    setTodo({commit}, todo){
      commit(types.ADD_TODO, todo)
    },
    clearCompleted({commit}){
      commit(types.CLEAR_COMPLETED)
    },
    changeFilter({commit}, filter){
      commit(types.CHANGE_FILTER, filter)
    },
    allChecked({commit}, event){
      commit(types.CHECK_ALL, event.target.checked)
    },
    removeTodo({commit}, index){
      commit(types.REMOVE_TODO, index)
    }, 
    updateTodo({commit}, todo){
      commit('updateTodo', todo)
    }
  }