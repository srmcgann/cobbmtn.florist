<template>
  <div>
    <button @click="logout()">
      Log Out
    </button>
  </div>
</template>

<script>
export default {
  name: 'InventoryManagement',
  data () {
    return {
    }
  },
  methods: {
    getQueryVariable(variable) {
      var query = window.location.search.substring(1);
      var vars = query.split('&');
      for (let i = 0; i < vars.length; i++) {
        let pair = vars[i].split('=')
        if(pair[0] == variable) return pair[1]
      }
      return false
    },
    logout () {
      let xmlhttp = new XMLHttpRequest()
      xmlhttp.onreadystatechange = () => {
        if (xmlhttp.status === 401) {
          window.location.href = 'https://advance.jsbot.net/'
        }
      }
      xmlhttp.open('GET', 'logout.php', true)
      xmlhttp.send()
    },
  },
  mounted () {
    if (!this.getQueryVariable('a')) {
      window.location.href = window.location.href + '?a=' + parseInt(Math.random() * 9e9)
    }
  }
}
</script>

<style scoped>
</style>

