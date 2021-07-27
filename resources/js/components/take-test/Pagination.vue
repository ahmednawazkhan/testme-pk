<template>
  <div
    class="paginations-section"
    v-if="currentSection"
  >
    <div class="remainings pr-md-2">
      <a
        class="btn mr-1"
        role="button"
        :class="{
          'btn-light active': (page.number -1) === currentSection.currentQuestion,
          'btn-link': (page.number -1) !== currentSection.currentQuestion,
          'btn-danger': isSkiped(page.number),
          'btn-warning': isIgnored(page.number),
          'btn-success': isAnswered(page.number)
        }"
        v-for="page in pageList"
        :key="page.number"
        @click="choose(page)"
      >
        {{ page.number }}
      </a>
    </div>
    <div
      class="paginations border rounded mr-1"
      v-if="currentSection"
    >
      <a
        @click="prev()"
        role="button"
        class="btn"
      >
        &laquo;
      </a>
      <span class="p-2 border-left border-right">
        {{ pageList | last }} of {{ totalRows }}
      </span>
      <a
        @click="next()"
        role="button"
        class="btn"
      >
        &raquo;
      </a>
    </div>
    <i
      class="far fa-question-circle"
      aria-hidden="true"
      v-b-tooltip.hover
      title="You have here the expanded list of questions from the current section.
            you can easily move from one question to another or from one slice of questions
            to another with the << and >> buttons"
    />
  </div>
</template>

<script>
import range from '../../utils/range'
import { createNamespacedHelpers } from 'vuex'

const { mapGetters, mapActions } = createNamespacedHelpers('takeTest')

// Make an array of N to N+X
export const makePageArray = (startNum, numPages, questions) => {
  return range(numPages).map((value, index) => {
    return { number: index + startNum, className: null }
  })
}

export default {
  name: 'APagination',
  props: {
    limit: {
      type: Number,
      default: 10
    }
  },
  data () {
    return {
      currentPage: 1,
      hideEllipsis: true,
      perPage: 1
    }
  },
  mounted () {
    this.$watch(
      () => {
        if (this.currentSection) {
          return this.currentSection.currentQuestion
        }
      },
      (nv, ov) => {
        if ((nv + 1) !== this.currentPage) {
          this.currentPage = (nv + 1)
        }
      }
    )
  },
  computed: {
    ...mapGetters(['allQuestions', 'currentSection']),
    totalRows () {
      return this.currentSection.questions.length
    },
    numberOfPages () {
      const result = Math.ceil(this.totalRows / this.perPage)
      return (result < 1) ? 1 : result
    },
    pageList () {
      // Sanity checks
      if (this.currentPage > this.numberOfPages) {
        // eslint-disable-next-line
        this.currentPage = this.numberOfPages
      } else if (this.currentPage < 1) {
        // eslint-disable-next-line
        this.currentPage = 1
      }
      let numLinks = this.limit
      let startNum = 1
      if (this.numberOfPages <= this.limit) {
        // Special Case: Less pages available than the limit of displayed pages
        numLinks = this.numberOfPages
      } else if (
        this.currentPage < this.limit - 1 &&
        this.limit > 3
      ) {
        // We are near the beginning of the page list
        if (!this.hideEllipsis) {
          numLinks = this.limit - 1
        }
      } else if (
        (this.numberOfPages - this.currentPage + 2) < this.limit &&
        this.limit > 3
      ) {
        // We are near the end of the list
        if (!this.hideEllipsis) {
          numLinks = this.limit - 1
        }
        startNum = this.numberOfPages - numLinks + 1
      } else {
        // We are somewhere in the middle of the page list
        if (this.limit > 3 && !this.hideEllipsis) {
          numLinks = this.limit - 2
        }
        startNum = this.currentPage - Math.floor(numLinks / 2)
      }
      // Sanity checks
      if (startNum < 1) {
        startNum = 1
      } else if (startNum > this.numberOfPages - numLinks) {
        startNum = this.numberOfPages - numLinks + 1
      }
      // Generate list of page numbers
      const pages = makePageArray(startNum, numLinks, this.currentSection.questions)
      // We limit to a total of 3 page buttons on small screens
      // Ellipsis will also be hidden on small screens
      if (pages.length > 3) {
        const idx = this.currentPage - startNum
        if (idx === 0) {
          // Keep leftmost 3 buttons visible
          for (let i = 3; i < pages.length; i++) {
            pages[i].className = 'd-none d-sm-flex'
          }
        } else if (idx === pages.length - 1) {
          // Keep rightmost 3 buttons visible
          for (let i = 0; i < pages.length - 3; i++) {
            pages[i].className = 'd-none d-sm-flex'
          }
        } else {
          // hide left button(s)
          for (let i = 0; i < idx - 1; i++) {
            pages[i].className = 'd-none d-sm-flex'
          }
          // hide right button(s)
          for (let i = pages.length - 1; i > idx + 1; i--) {
            pages[i].className = 'd-none d-sm-flex'
          }
        }
      }
      return pages
    }
  },
  methods: {
    ...mapActions(['selectQuestion']),
    choose (page) {
      if (page.number > this.numberOfPages) {
        page.number = this.numberOfPages
      } else if (page.number < 1) {
        page.number = 1
      }
      this.currentPage = page.number
      this.selectQuestion({
        question: this.currentSection.questions[page.number - 1],
        index: page.number - 1
      })
    },
    next () {
      const last = this.pageList[this.pageList.length - 1]
      let step = this.numberOfPages - last.number

      if (step >= 3) {
        this.currentPage = last.number + 3
      } else if (step === 0) {
      } else {
        this.currentPage = step + last.number
      }
    },
    prev () {
      const first = this.pageList[0].number

      if (first === 1) return

      if (first >= this.limit) {
        this.currentPage = first - 3
      } else {
        this.currentPage = 1
      }
    },
    isIgnored (number) {
      return this.currentSection.questions[number - 1].ignored
    },
    isSkiped (number) {
      return this.currentSection.questions[number - 1].revisit
    },
    isAnswered (number) {
      return this.currentSection.questions[number - 1].answered
    }
  },
  filters: {
    last (values) {
      return values[values.length - 1].number
    }
  }
}
</script>

<style lang="scss" scoped>
  .paginations-section {
    a.btn {
      font-size: inherit;
      padding-right: .3rem;
      padding-left: .3rem;
    }

    .remainings {
      display: inline;
    }

    .paginations {
      display: inline-block;

      span {
        padding: .4rem;
      }
    }
  }
</style>
