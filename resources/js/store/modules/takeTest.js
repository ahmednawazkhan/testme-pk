import Test from '../../models/test'

/**
 * @type {import('vuex').Module}
 */
export const takeTest = {
  namespaced: true,
  state () {
    return {
      /** @type {Test} test */
      test: null,
      section: null,
      question: null,
      currentPage: 0
    }
  },
  mutations: {
    setTest (state, payload) {
      state.test = payload
    },
    setSection (state, payload) {
      state.section = payload
    },
    setQuestion (state, payload) {
      state.question = payload
    }
  },
  actions: {
    /**
     * Load test data from server
     */
    async loadData ({ commit }, payload) {
      const test = new Test(payload)

      commit('setTest', test)

      return test
    },
    defineSection ({ commit }, payload) {
      commit('setSection', payload)
    },
    defineQuestion ({ commit }, payload) {
      commit('setQuestion', payload)
    },
    selectQuestion ({ dispatch, state }, { question, index }) {
      dispatch('defineQuestion', question)
      state.section.currentQuestion = index
    },
    revisit ({ dispatch, state }) {
      if (!state.question.answered) {
        state.question.revisit = true
        state.question.ignored = false
        dispatch('doNext')
      }
    },
    doNext ({ dispatch, state }, { check = false, valid }) {
      if (state.section.currentQuestion < (state.section.questions.length - 1)) {
        const index = state.section.currentQuestion + 1

        check && dispatch('checkValidity', valid)
        dispatch('selectQuestion', {
          question: state.section.questions[index], index
        })
      } else if (check) {
        dispatch('checkValidity', valid)
      }
    },
    doPrev ({ dispatch, state }, { check = false, valid }) {
      if (state.section.currentQuestion > 0) {
        const index = state.section.currentQuestion - 1

        check && dispatch('checkValidity', valid)
        dispatch('selectQuestion', {
          question: state.section.questions[index], index
        })
      }
    },
    checkValidity ({ state }, payload) {
      if (payload) {
        state.question.answered = true
        state.question.ignored = false
        state.question.revisit = false
      } else {
        state.question.revisit = false
        state.question.ignored = true
      }
    },
    nextSection ({ dispatch }, payload) {
      dispatch('defineSection', payload)
    }
  },
  getters: {
    test: state => state.test,
    allQuestions (state) {
      if (!state.test) {
        return []
      }

      const questions = state.test
        .sections
        .map(section => section.questions)

      return [].concat(...questions)
    },
    currentSection: state => state.section,
    currentQuestion: state => state.question
  }
}
