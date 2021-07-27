export default class Chapter {
  constructor (label = null, order = null) {
    if (label) {
      this.label = label
    }

    if (order) {
      this.order = order
    }
  }

  get isNew () {
    return this.id === undefined
  }

  /**
   * Build a Chapter instance from data
   * @param {*} data
   */
  static build (data) {
    const chapter = new Chapter(data.name)

    if (data.id) chapter.id = data.id

    if (data.label) chapter.label = data.name

    if (data.order_no) chapter.order_no = data.order_no

    if (data.created_at) chapter.created_at = data.created_at

    if (data.updated_at) chapter.updated_at = data.updated_at

    return chapter
  }
}
