<template>
  <div
    class="menu-cicle"
    :class="{'opened': open}"
  >
    <button
      type="button"
      class="cn-button"
      @click="toggleMenu"
      id="cn-button"
    >
      <div class="title">
        MENU
      </div>
    </button>
    <div
      class="cn-wrapper"
      :class="{'opened-nav': open}"
      id="cn-wrapper"
    >
      <ul>
        <li>
          <a href="#">
            <span class="fas fa-image" />
          </a>
        </li>
        <li>
          <a href="#">
            <span class="fas fa-headphones" />
          </a>
        </li>
        <li>
          <a href="#">
            <span class="fas fa-home" />
          </a>
        </li>
        <li>
          <a href="#">
            <span class="fas fa-video" />
          </a>
        </li>
        <li>
          <a href="#">
            <span class="fas fa-envelope" />
          </a>
        </li>
      </ul>
    </div>
    <div
      id="cn-overlay"
      @click="toggleMenu"
      class="cn-overlay"
      :class="{'on-overlay': open}"
    />
  </div>
</template>

<script>
export default {
  name: 'CircleMenu',
  data () {
    return {
      open: false
    }
  },
  methods: {
    toggleMenu () {
      this.open = !this.open
    }
  }
}
</script>

<style lang="scss" scoped>
* {
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  list-style: none;
  position: relative;
}

.menu-cicle {
  z-index: 15;

  &.opened {
    .cn-button {
      color: #0078D7;
      background-color: #C7E0F4;
    }
  }
}

.cn-wrapper {
  font-size: 1em;
  width: 26em;
  height: 26em;
  overflow: hidden;
  position: fixed;
  z-index: 10;
  bottom: -13em;
  left: 50%;
  border-radius: 50%;
  margin-left: -13em;
  -webkit-transform: scale(0.1);
  -ms-transform: scale(0.1);
  -moz-transform: scale(0.1);
  transform: scale(0.1);
  pointer-events: none;
  -webkit-transition: all .3s ease;
  -moz-transition: all .3s ease;
  transition: all .3s ease;
}

.opened-nav {
  border-radius: 50%;
  pointer-events: auto;
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}

.cn-overlay {
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.6);
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  opacity: 0;
  visibility: hidden;
  -webkit-transition: all .3s ease;
  -moz-transition: all .3s ease;
  transition: all .3s ease;
  z-index: 2;
  &.on-overlay {
    visibility: visible;
    opacity: 1;
  }
}

.cn-button {
  border: none;
  background: none;
  color: #fff;
  text-align: center;
  font-size: 1.8em;
  padding-bottom: 1em;
  height: 3.5em;
  width: 3.5em;
  background-color: #0075d6;
  position: fixed;
  left: 50%;
  margin-left: -1.75em;
  bottom: -1.75em;
  border-radius: 50%;
  cursor: pointer;
  z-index: 11;

  .title {
    font-size: 1rem;
    top: -1rem;
    border-bottom: 1px solid;
    width: 3rem;
    left: 1.6rem;

    &::before, &::after {
      position: relative;
      display: block;
      content: '';
      border-bottom: 1px solid;
    }

    &::before {
      top: 2.5rem;
    }

    &::after {
      top: .5rem;
    }
  }

  span:not(:last-child) {
    margin-bottom: 3px;
  }
}

.cn-wrapper li {
  position: absolute;
  font-size: 1.5em;
  width: 10em;
  height: 10em;
  -webkit-transform-origin: 100% 100%;
  -moz-transform-origin: 100% 100%;
  -ms-transform-origin: 100% 100%;
  transform-origin: 100% 100%;
  overflow: hidden;
  left: 50%;
  top: 50%;
  margin-top: -1.3em;
  margin-left: -10em;
  -webkit-transition: border .3s ease;
  -moz-transition: border .3s ease;
  transition: border .3s ease;
  a {
    display: block;
    font-size: 1.18em;
    height: 14.5em;
    width: 14.5em;
    position: absolute;
    bottom: -7.25em;
    right: -7.25em;
    border-radius: 50%;
    text-decoration: none;
    color: #fff;
    padding-top: 1.8em;
    text-align: center;
    -webkit-transform: skew(-50deg) rotate(-70deg) scale(1);
    -ms-transform: skew(-50deg) rotate(-70deg) scale(1);
    -moz-transform: skew(-50deg) rotate(-70deg) scale(1);
    transform: skew(-50deg) rotate(-70deg) scale(1);
    -webkit-backface-visibility: hidden;
    -webkit-transition: opacity 0.3s, color 0.3s;
    -moz-transition: opacity 0.3s, color 0.3s;
    transition: opacity 0.3s, color 0.3s;
    span {
      font-size: 1.1em;
      opacity: 0.7;
    }
  }
  &:first-child {
    -webkit-transform: rotate(-10deg) skew(50deg);
    -ms-transform: rotate(-10deg) skew(50deg);
    -moz-transform: rotate(-10deg) skew(50deg);
    transform: rotate(-10deg) skew(50deg);
  }
  &:nth-child(2) {
    -webkit-transform: rotate(30deg) skew(50deg);
    -ms-transform: rotate(30deg) skew(50deg);
    -moz-transform: rotate(30deg) skew(50deg);
    transform: rotate(30deg) skew(50deg);
  }
  &:nth-child(3) {
    -webkit-transform: rotate(70deg) skew(50deg);
    -ms-transform: rotate(70deg) skew(50deg);
    -moz-transform: rotate(70deg) skew(50deg);
    transform: rotate(70deg) skew(50deg);
  }
  &:nth-child(4) {
    -webkit-transform: rotate(110deg) skew(50deg);
    -ms-transform: rotate(110deg) skew(50deg);
    -moz-transform: rotate(110deg) skew(50deg);
    transform: rotate(110deg) skew(50deg);
  }
  &:nth-child(5) {
    -webkit-transform: rotate(150deg) skew(50deg);
    -ms-transform: rotate(150deg) skew(50deg);
    -moz-transform: rotate(150deg) skew(50deg);
    transform: rotate(150deg) skew(50deg);
  }
  &:nth-child(odd) a {
    background-color: #0075d6;
    background-color: hsla(207, 100%, 42%, 1);
  }
  &:nth-child(even) a {
    background-color: #007be0;
    background-color: hsla(207, 100%, 44%, 1);
  }
  &.active a {
    background-color: #0086f4;
    background-color: hsla(207, 100%, 48%, 1);
  }
  &:not(.active) a {
    &:hover, &:active {
      background-color: #0086f4;
      background-color: hsla(207, 100%, 48%, 1);
    }
    &:focus {
      background-color: #0086f4;
      background-color: hsla(207, 100%, 48%, 1);
      position: fixed;
    }
  }
}

/* for a central angle x, the list items must be skewed by 90-x degrees
in our case x=40deg so skew angle is 50deg
items should be rotated by x, minus (sum of angles - 180)2s (for this demo) */

/* active style */

/* hover style */

/* fallback */

.no-csstransforms {
  .cn-button {
    display: none;
  }
  .cn-wrapper {
    li {
      position: static;
      float: left;
      font-size: 1em;
      height: 5em;
      width: 5em;
      background-color: #eee;
      text-align: center;
      line-height: 5em;
      a {
        display: block;
        width: 100%;
        height: 100%;
        text-decoration: none;
        color: inherit;
        font-size: 1.3em;
        border-right: 1px solid #ddd;
        &:last-child {
          border: none;
        }
        &:hover, &:active, &:focus {
          background-color: white;
        }
      }
      &.active a {
        background-color: #6F325C;
        color: #fff;
      }
    }
    font-size: 1em;
    height: 5em;
    width: 25.15em;
    bottom: 0;
    margin-left: -12.5em;
    overflow: hidden;
    position: fixed;
    z-index: 10;
    left: 50%;
    border: 1px solid #ddd;
  }
}

@media screen and (max-width: 480px) {
  .cn-wrapper {
    font-size: .68em;
  }
  .cn-wrapper li {
    font-size: 1.52em;
  }
}

@media screen and (max-width: 320px) {
  .no-csstransforms .cn-wrapper {
    width: 15.15px;
    margin-left: -7.5em;
    li {
      height: 3em;
      width: 3em;
    }
  }
}
</style>
