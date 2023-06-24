<template>
    <div>
        @{{ message }}
        <router-link to="/example"><a>url to example</a></router-link>
    </div>
</template>
<script>
export default {
  data () {
    return {
      message: 'aaaa'
    };
  }
};
</script>