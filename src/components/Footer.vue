<template>
  <div ref="footerBar" v-if="state.siteEntered" class="footerBar">
    <div class="footerMenu">
      <button @click="launchWeb()" class="socialButton" title="Visit us on the Web!">
        <img src="../assets/web.png" class="socialIcon">
      </button>
      <button @click="launchFacebook()" class="socialButton" title="Open our Facebook Page">
        <img src="../assets/facebook.png" class="socialIcon">
      </button>
      <button @click="launchInstagram()" class="socialButton" title="Open our Instagram Page">
        <img src="../assets/instagram.png" class="socialIcon">
      </button>
      <button @click="launchEmail()" class="socialButton" title="Email us!">
        <img src="../assets/email.png" class="socialIcon">
      </button>
      <button @click="launchAdmin()" class="socialButton" title="Admin Section">
        <img src="../assets/admin.png" class="socialIcon">
      </button>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Footer',
  props: [ 'state' ],
  data () {
    return {
    }
  },
  methods: {
    launchFacebook () {
      window.open('https://www.facebook.com/cobbmountainflowers/', '_blank')
    },
    launchInstagram () {
      window.open('https://www.instagram.com/cobbmountainflowers/', '_blank')
    },
    launchEmail () {
      location.href = "mailto:cobbmtnflwrs@gmail.com?subject=I%20come%20from%20the%20Internet!&body=Question%20comment%20or%20concern%20here...";
    },
    launchAdmin () {
      window.open('https://admin.cobbmtn.florist/', '_blank')
    },
    launchWeb () {
      window.open('https://cobbmtn.florist/', '_blank')
    },
  }
}
</script>
<style scoped>
.footerBar{
  opacity: 1;
  position: fixed;
  z-index: 99;
  bottom: 0;
  width: 100%;
  text-align: center;
  height: 65px;
  font-size: 32px;
  color: #603;
  background: linear-gradient(90deg, #8006, #f888);
  transition: opacity 2s;
}
.footerMenu{
}
.socialIcon{
  height: 30px;
  margin-bottom: -5px;
}
.socialButton{
  width: 60px;
}
</style>
