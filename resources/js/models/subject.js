import Chapter from './chapter'

export default class Subject {
  constructor (label = null) {
    if (label) this.label = label

    this.chapters = []
  }

  setChapters (data) {
    this.chapters = data
  }

  addChapter (data) {
    this.chapters.push(data)
  }

  get isNew () {
    return this.id === undefined
  }

  static build (data) {
    const subject = new Subject()

    if (data.id) subject.id = data.id

    if (data.name) subject.label = data.name

    if (data.created_at) subject.created_at = data.created_at

    if (data.updated_at) subject.updated_at = data.updated_at

    if (data.chapters) {
      subject.chapters = data.chapters.map((chapter) => Chapter.build(chapter))
    }

    return subject
  }

  toJson () {
    return {
      id: this.id,
      label: this.label
    }
  }
}
