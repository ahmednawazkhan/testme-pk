/**
 * Class Field that represents a possible user response to a question
 *
 * @property {string} type Dom element type to use
 * @property {string} name name attribute of this field
 * @property {string} label form label content
 * @property {string} value user response value
 */
export default class Field {
  constructor (attrs) {
    this.build(attrs)
  }

  build (attrs) {
    this.type = attrs.type
    this.name = attrs.name
    this.label = attrs.label
    this.value = attrs.value

    if (attrs.data) {
      this.data = attrs.data
    }
  }
}
