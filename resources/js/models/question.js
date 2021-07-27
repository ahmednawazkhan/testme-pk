import Field from './field'

/**
 * Class Question that represents a question
 *
 * @property {string} id question's id
 * @property {string} label question's label
 * @property {integer} minutes
 * @property {Field[]} fields
 */
export default class Question {
  constructor (attrs, index) {
    this.build(attrs)

    this.answered = false
    this.ignored = false
    this.revisit = false
    this.answer = null
    this.section = null
    this.index = index
  }

  build (attrs) {
    this.id = attrs.id
    this.label = attrs.label
    this.minutes = attrs.minutes
    this.fields = attrs.fields.map(field => new Field(field))
  }

  toString () {
    return this.label || ''
  }
}
