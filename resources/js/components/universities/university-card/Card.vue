<template>
  <article class="university-card card shadow-sm">
    <header class="card-header p-3 bg-light">
      <div class="float-left">
        <div class="university-logo">
          <img
            class="img-fluid rounded-circle"
            src="../../../assets/images/harvard-badge.png"
            alt="Harvard-badge"
          >
        </div>
      </div>
      <div class="float-right university-likes text-muted">
        5000k <i class="fal fa-heart" />
      </div>
    </header>
    <div class="card-body text-left px-3 bg-light">
      <h6 class="card-subtitle text-muted mt-2">
        Harvard University
      </h6>
      <h5 class="card-title">
        Veritas
      </h5>
      <p class="card-text mb-0">
        Law, Language, Business...
      </p>

      <div class="university-browser">
        <b-button
          variant="link"
          :to="{name: 'tests', params: {slug: 'havard-university'}}"
        >
          Browse Tests
        </b-button>
      </div>
    </div>
  </article>
</template>

<script>
export default {
  name: 'Card',
  data () {
    return {}
  }
}
</script>

<style lang="scss" scoped>
.university-card {
  overflow: hidden;
  border: 1px solid rgba(0, 0, 0, 0.10);
  border-radius: .3rem;

  .card-header {
    position: relative;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);

    .university-logo {
      position: absolute;
      width: 4em;
      height: 4em;
      top: .5em;
    }

    .university-likes {
      font-size: .8em;
      line-height: 1;
      text-align: left;
    }

    .text-underlined {
      text-decoration: underline;
    }
  }

  .card-body {
    .card-title {
      font-weight: bold;
    }

    .card-text {
      font-size: .8em;
    }

    .university-browser {
      position: absolute;
      bottom: -2em;
      left: 0;
      width: 100%;
      text-align: center;
      background-color: #c8e0f6;
      transition: all 0.3s;
    }
  }

  &:hover {
    .university-browser {
      bottom: 0;
    }
  }
}
</style>
