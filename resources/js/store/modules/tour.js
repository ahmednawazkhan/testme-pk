/**
 * @type {import('vuex').Module}
 */
export const tour = {
  state: {
    steps: [],
    callbacks: {}
  },
  mutations: {
    setSetps (state, payload) {
      state.steps = payload
    }
  }
}
