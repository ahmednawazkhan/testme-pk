import Section from './section'

/**
 * Class Test
 *
 * @property {string} name
 * @property {Section[]} sections
 */
export default class Test {
  constructor (attrs) {
    this.build(attrs)
  }

  build (attrs) {
    this.name = attrs.name
    this.sections = attrs.sections.map((section, index) => new Section(section, index))
  }
}
