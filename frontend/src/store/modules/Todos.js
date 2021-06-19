import {
  getError
} from "@/utils/helpers";
import TodoService from "../../services/TodoService";

import * as types from './mutation-types'

export const namespaced = true;

export const state = {
  filter: 'all',
  loading: false,
  error: null,
  todos: [
    // {
    //   id: 1,
    //   title: 'Finish vue screencast',
    //   date: '2021-06-18',
    //   completedDate: '',
    //   description: '2 litra vodi',
    //   completed: false,
    //   editing: false
    // },
    // {
    //   id: 2,
    //   title: 'Take over world',
    //   date: '2021-06-19',
    //   completedDate: '',
    //   completed: false,
    //   description: 'kakoe to udobrenie',
    //   editing: false
    // }
  ]
}

export const mutations = {
  [types.SET_TODO](state, todos) {
    state.todos = todos
  },
  [types.CLEAR_COMPLETED](state) {
    state.todos = state.todos.filter(todo => !todo.completed)
  },
  [types.CHANGE_FILTER](state, filter) {
    state.filter = filter
  },
  [types.CHECK_ALL](state, checked) {
    state.todos.forEach(t => t.completed = checked)
  },
  [types.REMOVE_TODO](state, index) {
    state.todos.splice(index, 1)
  },
  [types.SET_LOADING](state, loading) {
    state.loading = loading
  },
  [types.SET_ERROR](state, error) {
    state.error = error
  },
  updateTodo(state, todo) {
    const index = state.todos.findIndex(t => t.id === todo.id)
    state.todos.splice(index, 1, {
      id: todo.id,
      date: todo.due_date,
      title: todo.title,
      completed: todo.completed,
      // editing: todo.editing
    })
  }
}

export const actions = {
  async getAllData({
    commit
  }) {
    commit("SET_LOADING", true)
    try {
      let response = await TodoService.getData('/calendar_task');
      commit("SET_TODO", response.data.data);
      commit("SET_LOADING", false)

    } catch (error) {
      commit("SET_LOADING", false)
      commit("SET_ERROR", getError(error));
    }
  },

  clearCompleted({
    commit
  }) {
    commit(types.CLEAR_COMPLETED)
  },
  changeFilter({
    commit
  }, filter) {
    commit(types.CHANGE_FILTER, filter)
  },
  allChecked({
    commit
  }, event) {
    commit(types.CHECK_ALL, event.target.checked)
  },
  removeTodo({
    commit
  }, index) {
    commit(types.REMOVE_TODO, index)
  },
  async updateTodo({
    commit
  }, todo) {
    commit("SET_LOADING", true)
    try {
      await TodoService.changeData('/calendar_task', todo.id, `active=${todo.completed ? 0 : 1}`);
      // commit("SET_TODO", response.data.data);
      commit('updateTodo', todo)
      commit("SET_LOADING", false)

    } catch (error) {
      commit("SET_LOADING", false)
      commit("SET_ERROR", getError(error));
    }
  }
}

export const getters = {
  remaining: state => {
    return state.todos.filter(t => !t.completed).length
  },
  anyRemaining: (state, getters) => {
    return getters.remaining != 0
  },
  todosFiltered: state => {
    if (state.filter === 'all') {
      return state.todos
    } else if (state.filter === 'active') {
      return state.todos.filter(t => !t.completed)
    } else if (state.filter === 'completed') {
      return state.todos.filter(t => t.completed)
    }

    return state.todos
  },
  showClearCompletedButton: state => {
    return state.todos.filter(t => t.completed).length > 0
  },
  todos: (state) => {
    return state.todos
  },
  loading: (state) => {
    return state.loading
  },
  error: state => {
    return state.error
  }
}