import Vue from 'vue'
import Vuex from 'vuex'
import { takeTest, mcq } from './modules'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    takeTest,
    mcq
  },
  state: {
    user: null
  },
  mutations: {
    setUser (state, payload) {
      state.user = payload
    }
  },
  actions: {
    defineUser ({ commit }, payload) {
      commit('setUser', payload)
    }
  },
  getters: {
    authUser: (state) => state.user
  }
})
