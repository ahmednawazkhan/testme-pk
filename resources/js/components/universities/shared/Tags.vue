<template>
  <section class="tags">
    <b-list-group flush>
      <b-list-group-item class="px-md-2">
        <div class="float-left">
          <b-form-group class="mb-0">
            <b-form-radio-group
              id="btnradios2"
              buttons
              button-variant="outline-primary"
              size="sm"
              v-model="selected"
              :options="options"
              name="radioBtnOutline"
            />
          </b-form-group>
        </div>
        <div class="float-right">
          <button
            class="btn btn-sm btn-link"
            type="button"
            role="button"
            @click="hideTags()"
          >
            Filter
            <i class="ml-1 fal fa-chevron-down" />
          </button>
        </div>
      </b-list-group-item>
      <b-list-group-item class="pl-2">
        <b-media>
          <b-img
            slot="aside"
            blank
            blank-color="#abc"
            width="50"
            alt="placeholder"
          />
          <h5 class="mt-0 mb-1">
            Firstname Lastname
          </h5>
          398 Score
          <span class="float-right text-warning">
            <i
              class="fa fa-2x fa-trophy"
              aria-hidden="true"
            />
          </span>
        </b-media>
      </b-list-group-item>

      <b-list-group-item class="pl-2">
        <b-media>
          <b-img
            slot="aside"
            blank
            blank-color="#cba"
            width="50"
            alt="placeholder"
          />
          <h5 class="mt-0 mb-1">
            Firstname Lastname
          </h5>
          300 Score
          <span class="float-right text-success">
            <i
              class="fa fa-2x fa-trophy"
              aria-hidden="true"
            />
          </span>
        </b-media>
      </b-list-group-item>

      <b-list-group-item class="pl-2">
        <b-media>
          <b-img
            slot="aside"
            blank
            blank-color="#bac"
            width="50"
            alt="placeholder"
          />
          <h5 class="mt-0 mb-1">
            Firstname Lastname
          </h5>
          200 Score
          <span class="float-right text-info">
            <i
              class="fa fa-2x fa-trophy"
              aria-hidden="true"
            />
          </span>
        </b-media>
      </b-list-group-item>
    </b-list-group>
  </section>
</template>

<script>
export default {
  name: 'Tags',
  data () {
    return {
      selected: 'focused',
      options: [
        { text: 'Focused', value: 'focused' },
        { text: 'Other', value: 'other' }
      ]
    }
  },
  methods: {
    hideTags () {
      this.$emit('hideTags')
    }
  }
}
</script>

<style lang="scss" scoped>
  .tags {
    text-align: left;
    font-size: 13px;
    background-color: #f4f4f4;
    height: calc(100vh - 88px);
    position: -webkit-sticky;
    position: sticky;
    top: 3rem;

    h5 {
      font-size: 14px;
    }

    /deep/ .btn-group-toggle {
      background-color: #eaeaea;
      border-radius: 20px;

      &:hover {
        background-color: #c8c8c8;
        border-color: #c8c8c8;
      }

      .btn {
        border-radius: 20px;
        border: 1px solid #eaeaea;
      }

      .btn-outline-primary:not(.active):hover {
        background-color: transparent;
        border-color: transparent;
      }
    }
  }
</style>
