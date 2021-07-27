<template>
  <article
    class="test-card"
    :class="{'free': isFree}"
    @click="goInstructions"
  >
    <div class="card__part card__part-2">
      <div class="card__part__side m--back">
        <div class="card__part__inner card__face">
          <div class="card__face__colored-side" />
          <h3 class="card__face__price">
            {{ isFree ? '$0' : '$25' }}
          </h3>
          <div class="card__face__divider" />
          <div class="card__face__path" />
          <div class="card__face__from-to">
            <p>English Spelling Test (U.S. Version)</p>
            <p>English Language</p>
          </div>
          <div class="card__face__deliv-date">
            Likes
            <p>500k</p>
          </div>

          <div class="stats">
            <div class="card__face__stats card__face__stats--req">
              Time Limit
              <p>150 Min</p>
            </div>
            <div class="card__face__stats card__face__stats--pledge">
              Questions
              <p>50</p>
            </div>
            <div class="card__face__stats card__face__stats--weight">
              Qualified
              <p class="card__face__stats__weight">
                <span>300</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </article>
</template>

<script>
export default {
  name: 'TestCard',
  props: {
    isFree: {
      type: Boolean,
      default: true
    }
  },
  data () {
    return {
    }
  },
  methods: {
    goInstructions () {
      this.$router.push(
        {
          name: 'instructions',
          params: { slug: 'havard-university', test: 'english-test' }
        }
      )
    }
  }
}
</script>

<style lang="scss" scoped>
  .test-card {
    z-index: 1;
    position: relative;
    width: 100%;
    height: 160px;
    margin-top: 15px;
    perspective: 2000px;
    transition: margin 0.4s 0.1s;

    .card__part {
      z-index: 1;
      position: relative;
      left: 0;
      width: 100%;
      border-radius: 11px;
    }

    .card__part-2 {
      z-index: 6;
      height: 100%;

      .card__part__side {
        z-index: 1;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        border-radius: inherit;
        background: #fff;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform-style: preserve-3d;
        transform-style: preserve-3d;

        .card__part__inner {
          overflow: hidden;
          position: relative;
          height: 100%;
          border-radius: inherit;

          &::after {
            content: "";
            z-index: 5;
            position: absolute;
            right: 0;
            top: 0;
            width: 20px;
            height: 100%;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0), white 60%, white 100%);
          }
        }

        .card__face {
          padding: 20px 20px 15px;

          &:hover {
            .card__face__colored-side {
              width: 70px;
            }
          }
        }

        .card__face__colored-side {
          z-index: -1;
          position: fixed;
          left: 0;
          top: 0;
          width: 7px;
          height: 100%;
          border-top-left-radius: 11px;
          border-bottom-left-radius: 11px;
          transition: width 0.3s;
        }

        .card__face__price {
          margin-top: -3px;
          font-weight: normal;
          font-size: 22px;
          color: #555A5F;
          transition: color 0.3s;
        }

        .card__face__divider {
          position: absolute;
          left: 70px;
          top: 10px;
          width: 1px;
          height: calc(100% - 20px);
          background: #ECECEC;
        }

        .card__face__path {
          position: absolute;
          left: 85px;
          top: 36px;
          width: 2px;
          height: 23px;

          &::before, &::after {
            content: "";
            position: absolute;
            left: -3px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            border: 2px solid;
            border-color: inherit;
          }

          &::before {
            top: -11px;
          }

          &::after {
            bottom: -9px;
          }
        }

        .card__face__from-to {
          position: absolute;
          left: 100px;
          top: 20px;
          width: 300px;
          color: #555A5F;
          font-size: 13px;

          &::before {
            content: "";
            position: absolute;
            left: 0;
            top: 40%;
            width: 100%;
            height: 1px;
            background: #ECECEC;
          }

          p:first-child {
            margin-bottom: 15px;
          }
        }

        .card__face__deliv-date {
          position: absolute;
          left: 20px;
          top: 105px;
          color: #9A9E9E;
          text-transform: uppercase;
          font-size: 12px;
          transition: color 0.3s;

          p {
            color: #606568;
            transition: color 0.3s;
          }
        }

        .card__face__stats {
          position: absolute;
          top: 105px;
          color: #B5B5B5;
          text-transform: uppercase;
          font-size: 12px;

          p {
            font-size: 14px;
            color: #ADADAD;
            font-weight: bold;
            text-transform: lowercase;
          }
        }

        .card__face__stats--req {
          left: 80px;
        }

        .card__face__stats--pledge {
          left: 13em;
        }

        .card__face__stats--weight {
          left: 20em;
        }
      }

      & > .m--back {
        overflow: hidden;
        cursor: pointer;
      }
    }

    &.free {
      .card__face__path {
        background: repeating-linear-gradient(#b5d6f6, #b5d6f6 3px, transparent 3px, transparent 6px) !important;
        border-color: #b5d6f6 !important;
      }

      .card__face__colored-side {
        background: #b5d6f6 !important;
      }
    }

    .card__face__path {
      background: repeating-linear-gradient(#fdc300, #fdc300 3px, transparent 3px, transparent 6px);
      border-color: #fdc300;
    }

    .card__face__colored-side {
      background: #fdc300;
    }
  }
</style>
