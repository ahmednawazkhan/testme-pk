export const responsive = {
  install (Vue, options) {
    Vue.prototype.$responsive = {
      isVisible (breakpoint = 'xs') {
        switch (breakpoint) {
          case 'xl':
            return innerWidth >= 1200
          case 'lg':
            return innerWidth >= 992
          case 'md':
            return innerWidth >= 768
          case 'sm':
            return innerWidth >= 576
          case 'xs':
          default:
            return innerWidth < 576
        }
      }
    }
  }
}
