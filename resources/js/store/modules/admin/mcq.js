import Subject from '../../../models/subject'
import Chapter from '../../../models/chapter'
import Axios from 'axios'

function loadQuestions () {
  const questions = localStorage.getItem('mcqBank')

  if (questions) {
    return JSON.parse(questions)
  }

  return []
}

/**
 * @type {import('vuex').Module}
 */
export const mcq = {
  namespaced: true,
  state: {
    subjects: [],
    questions: [],
    question: null
  },
  mutations: {
    setSubjects (state, payload) {
      state.subjects = payload
    },
    setQuestions (state, payload) {
      state.questions = payload
    },
    addSubject (state, payload) {
      state.subjects.push(payload)
      localStorage.setItem('subjectOptions', JSON.stringify(state.subjects))
    },
    addChapter (state, { subject, chapter }) {
      subject.chapters.push(chapter)
      localStorage.setItem('subjectOptions', JSON.stringify(state.subjects))
    },
    addQuestion (state, payload) {
      payload.id = state.questions.length + 1
      state.questions.push(payload)
      localStorage.setItem('mcqBank', JSON.stringify(state.questions))
    },
    setCurrentQuestion (state, payload) {
      state.question = payload
    },
    removeQuestion (state, payload) {
      state.questions
        .splice(
          state.questions.findIndex(question => question.id === payload), 1
        )

      localStorage.setItem('subjectOptions', JSON.stringify(state.subjects))
    },
    removeSubject (state, payload) {
      state.subjects
        .splice(
          state.subjects.findIndex(subject => subject.id === payload), 1
        )

      localStorage.setItem('subjectOptions', JSON.stringify(state.subjects))
    }
  },
  actions: {
    async fetchSubjects ({ commit }) {
      const resp = await Axios.get('agency/subjects')
      const subjects = resp.data.subjects
        .map(subject => Subject.build(subject))

      commit('setSubjects', subjects)

      return subjects
    },
    fetchQuestions ({ commit }) {
      // TODO: Implement real ajax logic to fetch data from server
      const questions = loadQuestions()

      commit('setQuestions', questions)
    },
    createChapter ({ state, commit }, { subject, chapter }) {
      const targetSubject = state.subjects.find(item => item.label === subject)
      let theChapter = null

      if (targetSubject &&
            !targetSubject.chapters.find(item => item.label === chapter)) {
        return Axios.post(`agency/subjects/${targetSubject.id}/chapters`, { label: chapter })
          .then((resp) => {
            theChapter = Chapter.build(resp.data.chapter)

            commit('addChapter', { subject: targetSubject, chapter: theChapter })
            return theChapter
          })
      }

      return theChapter
    },
    createQuestion ({ state, commit }, payload) {
      // TODO: Implement logics to save question on server
      commit('addQuestion', payload)
    },
    findQuestion ({ state }, payload) {
      return state.questions.find((question) => question.id === payload)
    },
    setEditingQuestion ({ state, commit }, questionId) {
      const question = state.questions
        .find((question) => question.id === questionId)

      commit('setCurrentQuestion', question)
    },
    deleteQuestion ({ commit }, questionId) {
      commit('removeQuestion', questionId)
    },
    deleteSubject ({ commit }, payload) {
      return Axios.delete(`agency/subjects/${payload.id}`)
        .then((resp) => {
          commit('removeSubject', resp.data.subject.id)
        })
    },
    updateSubject ({ dispatch, state }, payload) {
      return Axios.put(`agency/subjects/${payload.id}`, { label: payload.label })
        .then(resp => {
          const subject = resp.data.subject

          state.subjects
            .splice(
              state.subjects
                .findIndex(item => item.id === subject.id), 1, Subject.build(subject)
            )
        })
    },
    createSubject ({ state, commit }, payload) {
      // TODO: Implement real ajax logic to fetch data from server
      if (!state.subjects.find(item => item.label === payload)) {
        let subject = new Subject(payload)

        return Axios.post('agency/subjects', subject.toJson())
          .then((resp) => {
            subject = Subject.build(resp.data.subject)
            commit('addSubject', subject)

            return subject
          })
      }
    }
  },
  getters: {
    subjects: (state) => state.subjects,
    questions: (state) => state.questions,
    currentQuestion: (state) => state.question
  }
}
