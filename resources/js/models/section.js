import Question from './question'

/**
 * Section class represent a section of questions from API
 *
 * @property {string} name
 * @property {Question[]} questions
 */
export default class Section {
  constructor (attrs, index = 0) {
    this.index = index
    this.build(attrs)

    this.currentQuestion = 0
  }

  build (attrs) {
    this.name = attrs.name
    this.questions = attrs.questions.map((question, index) => {
      const item = new Question(question, index)
      item.section = this.index
      return item
    })
  }

  toString () {
    return this.name || ''
  }
}
