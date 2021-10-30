<template>
  <div class="main">
    <button style="position: fixed; top: 0; left: calc(50% - 12px); transform: translatex(-50%);margin-top: 15px; z-index: 2000;width: 70px; height: 70px; background: url(https://jsbot.cantelope.org/uploads/I3LHo.png); background-position: center center; background-repeat: no-repeat;background-size: 55px 55px;background-color: #c26;border: 2px solid #fff8;" class="snipcart-checkout"></button>
    <div ref="titleBarDiv" class="titleBarDiv">
    </div>
    <div class="headerDiv">
      <div v-if="siteEntered" class="headerText">
         <i>Cobb<br>Mountain</i>
        <div v-if="siteEntered" class="headerSubText"><i>Flowers</i></div>
      </div>
      <div v-if="siteEntered" ref="headerLogo" class="headerLogo">
        <img src="https://jsbot.cantelope.org/uploads/1hsPKQ.png" @click="goHome()" class="headerLogo1">
      </div>
      <div ref="introVid" class="introVid">
        <button v-if="!siteEntered"
          @click="launch()"
          ref="enterSiteButton"
          class="enterSiteButton"
        >
          Enter Site
        </button>
        <video
          v-if="0"
          autoplay
          muted
          ref="headerVid"
          :src="introVid"
          class="introVidMedia"
          @ended="onEnd()"
          @canplay="vidLoaded()"
      ></video>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Header',
  props: [ 'state' ],
  data () {
    return {
      siteEntered: false,
      introVid: 'https://jsbot.cantelope.org/uploads/' + [
        '28i49A',
        '24yHao',
        '24yHao',
        '1bPkya',
        //'hYdr5',
        '1RYWso',
        '1RYWso',
        '1dIjqO',
        'LUxhO',
        'BtP3f',
        'Wk8ly',
        '1oy3IS',
        '1Ra5qh'
      ][Math.random()*12|0] + '.mp4'
    }
  },
  methods: {
    reload () {
      location.reload()
    },
    launch () {
      this.$set(this.state, 'siteEntered', true)
      //this.$refs.headerVid.className += ' fadeOut'
      setTimeout(()=>this.$refs.introVid.className += ' noDisplay', 1000)
      this.siteEntered = true
      this.$refs.titleBarDiv.style.display = 'block'
      fetch('/static/js/selectinator.js').then(j=>j.text()).then(j=>eval(j))
    },
    onEnd() {
      this.launch()
    },
    vidLoaded() {
      setTimeout(()=>this.$set(this.state, 'vidLoaded', true), 50)
    },
    goHome() {
      location.href=location.origin
    }
  },
  mounted () {
    //let t
    //if((t=window.location.href.split('/'))[t.length-1].indexOf('#') !== -1) {
      this.launch()
    //}
  }
}
</script>
<style scoped>
.enterSiteButton{
  z-index: 500;
  position: absolute;
  left: 50%;
  top: 5%;
  transform: translate(-50%, -50%) scale(1.0);
  cursor: pointer;
}
.main{
  position: absolute;
  width: 100%;
}
.headerLogo1{
  height: 100px;
  margin: 0px;
  margin-left: -5px;
  margin-top: 50px;
}
.gradDiv{
  position: fixed;
  top: 0;
  width: 100%;
  height: 100vh;
  opacity: 1;
  transition: opacity 8s;
}
.fadeIn{
  opacity: 1 !important;
}
.fadeHalfIn{
  opacity: 0.25;
}
.noDisplay{
  display: none;
}
.headerDiv{
  position: absolute;
  width: 100%;
}
.fadeOut{
  opacity: 0 !important;
}
video{
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
}
.showVid{
  opacity: 1;
}
.headerLogoRight{
  width: 160px;
}
.introVidMedia{
  position: absolute;
  opacity: 1;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  /*
  max-width: 100vw;
  max-height: 100vh;
  */
  object-fit: cover;
  transition: opacity 1s;
}
.introVid{
  position: absolute;
  z-index: 100;
  width: 100vw;
  height: 100vh;
}
.didLoad{
  width: 75px;
  height: 75px;
  top: 35px;
  left: 0;
  opacity: 0;
}
.titleBarDiv{
  position: fixed;
  top: 0;
  z-index: 99;
  height: 105px;
  width: 100%;
  background: linear-gradient(90deg, #e45c92, #4008);
  display: none;
}
.headerText{
  position: fixed;
  z-index: 99;
  width: 100vw;
  text-align: right;
  right: 0;
  top: 0px;
  font-size: 30px;
  margin-right: 12px;
  margin-top: 5px;
  line-height: 1em;
  color: #f49;
  text-shadow: 2px 2px 5px #001;
}
.headerSubText{
  position:fixed;
  z-index: 1000;
  right: 0;
  float: right;
  font-size: 74px;
  margin-top: 4px;
  margin-right:-60px;
  color: #f49;
  text-align: right;
  transform: scale(.5,.5);
  text-shadow: 2px 2px 5px #100;
}
.headerLogo{
  cursor: pointer;
  position: fixed;
  z-index: 100;
  opacity: 1;
  transition: opacity 1s;
  left: 0;
  top: 0;
  margin-top: 35px;
  margin-left: 10px;
  text-align: left;
}
.backgroundVid{
  height: 100vh;
}
</style>
