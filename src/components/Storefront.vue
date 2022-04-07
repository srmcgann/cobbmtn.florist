<template>
  <div class="storeFront" v-if="state.siteEntered" ref="storeFront">

    <LightBox
      v-if="expandThumb"
      :showThumbs="false"
      :showCaption="true"
      :media="lightBoxPhoto"
      v-on:onOpened="onOpened"
    />

    <div v-if="0" class="selectinatorContainer">
      <div id="select" ng-model=""></div>
    </div>

    <a id="welcome"></a>
    <div class="spacer" style="margin-top: 0;"></div>
    <div class="sectionTitle">Welcome!</div>
      <video
        v-if="showFeatureVid"
        autoplay
        muted
        loop
        :src="featureVid"
        class="featureVidMedia"
        ref="featureVidMedia"
      ></video>
      <div v-else class="featureVidMedia" ref="featureVidMedia">
        <canvas ref="c" class="canvasAnimation">
        </canvas>
      </div>

    <a id="flowers"></a>
    <div class="spacer"></div>
    <div class="sectionTitle">Flowers</div>

    <div class="customblurb">Please call for any custom orders!<br>
                   <span style="font-size: 1.62em;">Jenifer * <b>707-974-9137</b></span><br></div>

    <div
      v-for="flowerCategory in filteredCategories"
      v-if="content.flowers.map(v=>v.flowerCategory).includes(flowerCategory.name)"
      class="departmentContainer">
      <div class="departmentTitle separator">
        <a :id="flowerCategory.name"></a>
        <i>{{flowerCategory.name}}</i>
      </div>
      <div class="franchiseContainer flowerContainer" v-for="flower in content.flowers" v-if="flower.flowerCategory === flowerCategory.name">
        <a :id="flower.name"></a>
        <div v-if="flower.flowerCategory === flowerCategory.name">
          <div class="franchiseTitle" v-html="flower.name"></div>
          <img :src="flower.image" class="flowerImage" @click="showProduct(flower)">
          <div class="productFooter">
            <div class="memberTitle" v-html="'$' + flower.price"></div>
            <div class="memberTitle" v-html="flower.description"></div>
          </div>
          <div class="addButtonContainer">
            <button
              class="snipcart-add-item addButton"
              :data-item-id="flower.id"
              :data-item-price="flower.price"
              :data-item-url="'https://cobbmtn.dweet.net/static/validateFlowers.php'"
              :data-item-description="flower.description"
              :data-item-image="flower.image"
              :data-item-name="flower.name"
              alt="Add to cart"
            >Add to Cart</button>
          </div>
        </div>
      </div>
    </div>

    <div class="departmentContainer">
      <div class="departmentTitle separator">
        <a id="Designer's Choice"></a>
        <i>Designer's Choice</i>
      </div>
      <div class="clear"></div>
    </div>

    <div id="DCChosenPrice" style="margin: 20px;font-size:32px; text-align: center;background: linear-gradient(-45deg, #012a, #0000);color: #fff;padding: 10px; padding-bottom: 30px;width:400px;margin-left: auto;margin-right: auto;margin-top: 90px;padding-top:20px;">
      <div style="font-size: .8em">Designer's Choice</div>
      <img src="https://jsbot.cantelope.org/uploads/Xk6oO.jpg" style="width: 250px;"><br>
      <div ref="slider" style="display:inline-block;width: 300px;"></div>
      <input @keyup.enter="createDCButton($refs.slider.noUiSlider.get())" onkeydown="return  (this.value.split('.')[1].length <2 || event.keyCode==8) && (event.keyCode==46 || event.keyCode == 190 || (  event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9))) || (event.keyCode>34 && event.keyCode<40)" 
                    @input="updateDCPrice()" type="text" ref="currentDCPrice" class="sliderInput" v-model="DCPrice">
      <div style="font-size: .6em;">choose how much you wish to spend<br><span class="disclaimer">($55 minimum on Designer's Choice arrangements)</span></div>
      <button
        alt="Add to cart"
        class="addButton"
        style="width: 200px;height: 35px;"
        @click="createDCButton($refs.slider.noUiSlider.get())"
      >Add to Cart</button>
    </div>

    <div class="departmentContainer">
      <div class="departmentTitle separator">
        <a id="Wrapped Arrangements"></a>
        <i>Wrapped Arrangements</i>
      </div>
      <div class="clear"></div>
    </div>

    <div id="wrappedChosenPrice" style="margin: 20px;font-size:32px; text-align: center;background: linear-gradient(-45deg, #012a, #0000);color: #fff;padding: 10px; padding-bottom: 30px;width:400px;margin-left: auto;margin-right: auto;margin-top: 90px;padding-top:20px;">
      <div style="font-size: .8em;">Wrapped Arrangements</div>
      <img src="https://jsbot.cantelope.org/uploads/15tPHr.jpg" style="width: 250px;"><br>
      <div ref="slider2" style="display:inline-block;width: 300px;"></div>
      <input @keyup.enter="createWrappedButton($refs.slider2.noUiSlider.get())" onkeydown="return  (this.value.split('.')[1].length <2 || event.keyCode==8) && (event.keyCode==46 || event.keyCode == 190 || (  event.ctrlKey || event.altKey
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9))) || (event.keyCode>34 && event.keyCode<40)"
                    @input="updateWrappedPrice()" type="text" ref="currentWrappedPrice" class="sliderInput" v-model="WrappedPrice">
      <div style="font-size: .6em;">choose how much you wish to spend<br><span class="disclaimer">($5 minimum on Wrapped Arrangements)</span></div>
      <button
        alt="Add to cart"
        class="addButton"
        style="width: 200px;height: 35px;"
        @click="createWrappedButton($refs.slider2.noUiSlider.get())"
      >Add to Cart</button>
    </div>

    <div id="giftChosenPrice" style="margin: 20px;font-size:32px; text-align: center;background: linear-gradient(-45deg, #012a, #0000);color: #fff;padding: 10px; padding-bottom: 30px;width:400px;margin-left: auto;margin-right: auto;margin-top: 90px;padding-top:20px;">
      <div style="font-size: .8em;">Gifts</div>
      <img src="https://jsbot.cantelope.org/uploads/14JQuG.jpg" style="width: 250px;"><br>
      <div ref="slider3" style="display:inline-block;width: 300px;"></div>
      <input @keyup.enter="createGiftButton($refs.slider3.noUiSlider.get())" onkeydown="return  (this.value.split('.')[1].length <2 || event.keyCode==8) && (event.keyCode==46 || event.keyCode == 190 || (  event.ctrlKey || event.altKey
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9))) || (event.keyCode>34 && event.keyCode<40)"
                    @input="updateGiftPrice()" type="text" ref="currentGiftPrice" class="sliderInput" v-model="GiftPrice">
      <div style="font-size: .6em;">choose how much you wish to spend<br><span class="disclaimer">($25 minimum on gifts)</span></div>
      <button
        alt="Add to cart"
        class="addButton"
        style="width: 200px;height: 35px;"
        @click="createGiftButton($refs.slider3.noUiSlider.get())"
      >Add to Cart</button>
    </div>

    <div id="plantsChosenPrice" style="margin: 20px;font-size:32px; text-align: center;background: linear-gradient(-45deg, #012a, #0000);color: #fff;padding: 10px; padding-bottom: 30px;width:400px;margin-left: auto;margin-right: auto;margin-top: 90px;padding-top:20px;">
      <div style="font-size: .8em;">Plants and Dish Gardens</div>
      <img src="https://jsbot.cantelope.org/uploads/2h68aC.jpg" style="width: 250px;"><br>
      <div ref="slider4" style="display:inline-block;width: 300px;"></div>
      <input @keyup.enter="createPlantButton($refs.slider4.noUiSlider.get())" onkeydown="return  (this.value.split('.')[1].length <2 || event.keyCode==8) && (event.keyCode==46 || event.keyCode == 190 || (  event.ctrlKey || event.altKey
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9))) || (event.keyCode>34 && event.keyCode<40)"
                    @input="updatePlantPrice()" type="text" ref="currentPlantPrice" class="sliderInput" v-model="PlantPrice">
      <div style="font-size: .6em;">choose how much you wish to spend<br><span class="disclaimer">($55 minimum on plants and dish gardens)</span></div>
      <button
        alt="Add to cart"
        class="addButton"
        style="width: 200px;height: 35px;"
        @click="createPlantButton($refs.slider4.noUiSlider.get())"
      >Add to Cart</button>
    </div>

    <div
      v-for="flowerCategory in filteredFlowers2"
      v-if="content.flowers.map(v=>v.flowerCategory).includes(flowerCategory.name)"
      class="departmentContainer">
      <div class="departmentTitle separator">
        <a :id="flowerCategory.name"></a>
        <i>{{flowerCategory.name}}</i>
      </div>
      <div class="franchiseContainer flowerContainer" v-for="flower in content.flowers" v-if="flower.flowerCategory === flowerCategory.name">
        <a :id="flower.name"></a>
        <div v-if="flower.flowerCategory === flowerCategory.name">
          <div class="franchiseTitle" v-html="flower.name"></div>
          <img :src="flower.image" class="flowerImage" @click="showProduct(flower)">
          <div class="productFooter">
            <div class="memberTitle" v-html="'$' + flower.price"></div>
            <div class="memberTitle" v-html="flower.description"></div>
          </div>
          <div class="addButtonContainer">
            <button
              class="snipcart-add-item addButton"
              :data-item-id="flower.id"
              :data-item-price="flower.price"
              :data-item-url="'https://cobbmtn.dweet.net/static/validateFlowers.php'"
              :data-item-description="flower.description"
              :data-item-image="flower.image"
              :data-item-name="flower.name"
              alt="Add to cart"
            >Add to Cart</button>
          </div>
        </div>
      </div>
    </div>

    <a id="cards"></a>
    <div class="spacer"></div>
    <div class="sectionTitle">Cards</div>
    <div 
      v-for="cardCategory in content.cardCategories"
      class="departmentContainer"
      v-if="content.cards.map(v=>v.cardCategory).includes(cardCategory.name)"
    >
      <div class="departmentTitle separator">
        <a :id="cardCategory.name"></a>
        <i>{{cardCategory.name}}</i>
      </div>
      <div class="franchiseContainer" v-for="card in content.cards" v-if="card.cardCategory === cardCategory.name">
        <a :id="card.name"></a>
        <div v-if="card.cardCategory === cardCategory.name">
          <div v-if="0" class="franchiseTitle" v-html="card.name"></div>
          <img :src="card.image" class="staffImage" @click="showProduct(card)">
          <div v-if="0" class="memberTitle" v-html="card.description"></div><br>
          <div class="productFooter">
            <div class="memberTitle" v-html="'$' + card.price"></div>
          </div>
          <div class="addButtonContainer">
            <button
              class="snipcart-add-item addCardButton"
              :data-item-id="card.id"
              :data-item-price="card.price"
              :data-item-url="'https://cobbmtn.dweet.net/static/validateCards.php'"
              :data-item-description="card.description"
              :data-item-image="card.image"
              :data-item-name="card.name"
              alt="Add to cart"
            >Add to Cart</button>
          </div>
        </div>
      </div>
    </div>


    <a id="about"></a>
    <div class="spacer"></div>
    <div class="sectionTitle">About Us</div>
      <div class="franchiseContainer" v-for="member in content.staff">
        <a :id="member.name"></a>
          <div class="franchiseTitle" v-html="member.name"></div>
          <img :src="member.photo" class="staffImage" @click="showImage(member)">
          <div class="memberTitle" v-html="member.title"></div>
          <a :href="'mailto:' + member.email" class="franchiseLink" target="_blank" v-html="member.email"></a>
      </div>

    <a id="contact"></a>
    <div class="spacer"></div>
    <div class="sectionTitle">Contact</div>
    <div class="contactText"><br>
      Office: (707) 974-9137<br>
      <a href="./studio" target="_blank" style="text-decoration: none; color: #ff4; background: #a665;padding-left: 10px; padding-right: 10px;border-radius: 10px;">view photos of my studio</a><br>
      General Inquiries:<br><a href="mailto:cobbmtnflwrs@gmail.com" class="franchiseLink">cobbmtnflwrs@gmail.com</a><br><br>

      Loch Lomond, CA 95461<br>
      <iframe ref="mapFrame" width="400" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-121.7341938018799%2C38.86073003538821%2C-122.70127773284914%2C38.87165656635118&amp;layer=mapnik" style="border: 2px solid #88f4; border-radius: 10px;"></iframe><br/><small><a href="https://www.openstreetmap.org/#map=15/38.8662/-122.7177" class="franchiseLink" target="_blank">View Larger Map</a></small>
    </div>

    <a id="success"></a>
    <div class="spacer"></div>
    <div class="sectionTitle">Success Stories</div>
    <div class="franchiseContainer" v-for="success in content.successStories">
      <img :src="success.photo" class="successImage" @click="showImage(success)">
    </div>

    <div class="spacer"></div>
    <div class="sectionTitle">Meta</div><br>
    <a id="meta"></a>
    <div class="contactText" v-html="copyright"></div>
    <div class="contactText smallify">Site Design by <a href="//www.doitonce.consulting/" class="franchiseLink" target="_blank">Do It Once Consulting</a></div>

  </div>
</template>
<script>
require('vue-image-lightbox/dist/vue-image-lightbox.min.css')
import LightBox from 'vue-image-lightbox'

export default {
  name: 'Storefront',
  props: [ 'state' ],
  components: {
    LightBox
  },
  data () {
    return {
      copyright: '&copy;' + (new Date()).getFullYear() + '<br>Cobb Mountain Flowers<br>All Rights Reserved<br>',
      curPage: 0,
      /*
      featureVid: 'https://jsbot.cantelope.org/uploads/' + [
        '1gG241',
        '28oCGn'
      ][Math.random()*1|0] + '.mp4',
      */
      featureVid: '/cmf.mp4',
      content: {
        financingCategories: [],
        serviceCategories: [],
        departments: [],
        staff: [],
        successStories: [],
        franchises: []
      },
      cat: false,
      showFeatureVid: false,
      canvasVars:{
        bgimg: null,
        bgimgoverlay: null,
        drawRotatedImage: null,
        go: false,
        pics: [],
        B: [],
      },
      c: null,
      x: null,
      S: null,
      C: null,
      t: 0,
      expandThumb: false,
      DCPrice: '$100',
      WrappedPrice: '$20',
      GiftPrice: '$100',
      PlantPrice: '$100',
      lightBoxPhoto: []
    }
  },
 methods:{
    Draw(){

      let x = this.x
      let t = this.t
      let c = this.c
      let w
      let Rn = Math.random
      let S = this.S
      let C = this.C
      let X, Y

      if(!t){
        this.canvasVars.bgimg = new Image()
        this.canvasVars.bgimgoverlay = new Image()
        this.canvasVars.go=false
        this.canvasVars.bgimg.addEventListener('load',()=>{
          this.canvasVars.go=true
        })
        this.canvasVars.bgimg.src='https://jsbot.cantelope.org/uploads/1plRgd.jpg'
        this.canvasVars.bgimgoverlay.src='https://jsbot.cantelope.org/uploads/1B0QxQ.png'
        this.canvasVars.pics=Array(10).fill().map((v, i)=>{
          let img = new Image()
          v = {img, loaded: false}
          img.addEventListener('load', ()=>{
            v.loaded = true
          })
          let j, src = 'https://jsbot.cantelope.org/uploads/'
          switch(i){
            case 0: j=0; src+='20l7pH.png';  break
            case 1: j=0; src+='20l7pH.png';  break
            case 2: j=0; src+='20l7pH.png';  break
            case 3: j=1; src+='26Ahx4.png';  break
            case 4: j=2; src+='yFAQQ.png';  break
            case 5: j=2; src+='yFAQQ.png';  break
            case 6: j=3; src+='1AHSj7.png';  break
            case 7: j=3; src+='1AHSj7.png';  break
            case 8: j=3; src+='1AHSj7.png';  break
            case 9: j=3; src+='1AHSj7.png';  break
          }
          img.src = src
          return v
        })
        
        this.canvasVars.drawRotatedImage=(img, X, Y, W, H, a)=>{
          x.save()
          x.translate(X, Y)
          x.rotate(a)
          x.drawImage(img, -W/2, -H/2, W, H)
          x.restore()
        }
        
        this.canvasVars.B = []
      }
      if(this.canvasVars.go && !this.canvasVars.pics.filter(v=>!v.loaded).length){
        x.globalAlpha = .5
        x.drawImage(this.canvasVars.bgimg, 0, 0, 1920,1080)
        x.globalAlpha = 1
        x.fillStyle='#fff2', x.fillRect(0,0,w=c.width,w)
        if(Rn()<.15){
          this.canvasVars.B = [...this.canvasVars.B, [this.canvasVars.pics[Rn()*this.canvasVars.pics.length|0].img, Rn()*w, -400, 1+Rn()*5, Rn()*3, Math.PI*2*Rn(), (Rn()-.5)*5, Rn()*99|0]]
        }
        
        this.canvasVars.B=this.canvasVars.B.map((v,i)=>{
          X = v[1]+=v[6]*2
          Y = v[2]+=2*(1+v[4])
          this.canvasVars.drawRotatedImage(v[0], X, Y, v[0].width/5*v[3], v[0].height/5*v[3], S(v[5])+t*(v[7]%2?1:-1)*v[4]/4)
          return v
        }).filter(v=>v[2]<1400)
        x.globalAlpha = .5 + S(t*1.5)/2
        x.drawImage(this.canvasVars.bgimgoverlay, 0, 0, 1920,1080)
        x.globalAlpha = 1
      } else {
        x.fillStyle='#fff8', x.fillRect(0,0,w=c.width,w)
      }

      this.t += 1/60
      requestAnimationFrame(this.Draw)
    },
    updateDCPrice(){
       this.$refs.slider.noUiSlider.set(+this.$refs.currentDCPrice.value.substring(this.$refs.currentDCPrice.value.substring(0,1)=='$'?1:0))
       this.$refs.currentDCPrice.value = ((this.$refs.currentDCPrice.value)+'').trim()
       this.$refs.currentDCPrice.value = ((''+this.$refs.currentDCPrice.value).substring(0, 1) == '$' ? '' : '$') + this.$refs.currentDCPrice.value
    },
    updateWrappedPrice(){
       this.$refs.slider2.noUiSlider.set(+this.$refs.currentWrappedPrice.value.substring(this.$refs.currentWrappedPrice.value.substring(0,1)=='$'?1:0))
       this.$refs.currentWrappedPrice.value = ((this.$refs.currentWrappedPrice.value)+'').trim()
       this.$refs.currentWrappedPrice.value = ((''+this.$refs.currentWrappedPrice.value).substring(0, 1) == '$' ? '' : '$') + this.$refs.currentWrappedPrice.value
    },
    updateGiftPrice(){
       this.$refs.slider3.noUiSlider.set(+this.$refs.currentGiftPrice.value.substring(this.$refs.currentGiftPrice.value.substring(0,1)=='$'?1:0))
       this.$refs.currentGiftPrice.value = ((this.$refs.currentGiftPrice.value)+'').trim()
       this.$refs.currentGiftPrice.value = ((''+this.$refs.currentGiftPrice.value).substring(0, 1) == '$' ? '' : '$') + this.$refs.currentGiftPrice.value
    },
    updatePlantPrice(){
       this.$refs.slider4.noUiSlider.set(+this.$refs.currentPlantPrice.value.substring(this.$refs.currentPlantPrice.value.substring(0,1)=='$'?1:0))
       this.$refs.currentPlantPrice.value = ((this.$refs.currentPlantPrice.value)+'').trim()
       this.$refs.currentPlantPrice.value = ((''+this.$refs.currentPlantPrice.value).substring(0, 1) == '$' ? '' : '$') + this.$refs.currentPlantPrice.value
    },
    onOpened (val) {
      if (!val) this.expandThumb = false
    },
    showProduct(product){
      this.lightBoxPhoto = [{thumb:product.image, src:product.image, caption:product.name}]
      this.expandThumb = true
    },
    showImage (member) {
      this.lightBoxPhoto = [{thumb:member.photo, src:member.photo, caption:member.name}]
      this.expandThumb = true
    },
    jump(h){
      this.$nextTick(()=>{
        setTimeout(()=>{
          location.href = h
          setTimeout(()=>{this.state.body.scrollTo(0, this.state.body.scrollTop - 30)}, 1)
        }, 500)
      })
    },
    createDCButton(price){
      var p=price.substring(1)
      let id=0
      let sendData = {type: "Designer's Choice-", price: p}
      let URL = '/static/getProductID.php'
      fetch(URL,{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(sendData),
      })
      .then(res => res.json())
      .then(data => {
        if(data) {
          id=data
          if(id){
            let el = document.createElement('button')
            el.setAttribute('data-item-id', id)
            el.setAttribute('data-item-price', (+p).toFixed(2))
            el.setAttribute('data-item-url', "https://cobbmtn.dweet.net/static/validateFlowers.php")
            el.setAttribute('data-item-description', "Plus Delivery")
            el.setAttribute('data-item-image', 'https://jsbot.cantelope.org/uploads/Xk6oO.jpg')
            el.setAttribute('data-item-name', "Designer's Choice - $" + (Math.round(p*10)/10).toFixed(2))
            el.className = 'snipcart-add-item'
            el.style.display = 'none'
            document.body.appendChild(el)
            el.click()
            el.parentNode.removeChild(el)
          }
        }
      })
    },
    createWrappedButton(price){
      var p=price.substring(1)
      let id=0
      let sendData = {type: "Wrapped", price: p}
      let URL = 'https://cobbmtn.dweet.net/static/getProductID.php'
      fetch(URL,{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(sendData),
      })
      .then(res => res.json())
      .then(data => {
        if(data) {
          id=data
          if(id){
            let el = document.createElement('button')
            el.setAttribute('data-item-id', id)
            el.setAttribute('data-item-price', (+p).toFixed(2))
            el.setAttribute('data-item-url', "https://cobbmtn.dweet.net/static/validateFlowers.php")
            el.setAttribute('data-item-description', "Wrapped")
            el.setAttribute('data-item-image', 'https://jsbot.cantelope.org/uploads/15tPHr.jpg')
            el.setAttribute('data-item-name', "Wrapped - $" + (Math.round(p*10)/10).toFixed(2))
            el.className = 'snipcart-add-item'
            el.style.display = 'none'
            document.body.appendChild(el)
            console.log(el)
            el.click()
            //el.parentNode.removeChild(el)
          }
        }
      })
    },
    createGiftButton(price){
      var p=price.substring(1)
      let id=0
      let sendData = {type: "Gifts", price: p}
      let URL = '/static/getProductID.php'
      fetch(URL,{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(sendData),
      })
      .then(res => res.json())
      .then(data => {
        if(data) {
          id=data
          if(id){
            let el = document.createElement('button')
            el.setAttribute('data-item-id', id)
            el.setAttribute('data-item-price', (+p).toFixed(2))
            el.setAttribute('data-item-url', "https://cobbmtn.dweet.net/static/validateFlowers.php")
            el.setAttribute('data-item-description', "Gift")
            el.setAttribute('data-item-image', 'https://jsbot.cantelope.org/uploads/14JQuG.jpg')
            el.setAttribute('data-item-name', "Gift - $" + (Math.round(p*10)/10).toFixed(2))
            el.className = 'snipcart-add-item'
            el.style.display = 'none'
            document.body.appendChild(el)
            el.click()
            el.parentNode.removeChild(el)
          }
        }
      })
    },
    createPlantButton(price){
      var p=price.substring(1)
      let id=0
      let sendData = {type: "Plants", price: p}
      let URL = '/static/getProductID.php'
      fetch(URL,{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(sendData),
      })
      .then(res => res.json())
      .then(data => {
        if(data) {
          id=data
          if(id){
            let el = document.createElement('button')
            el.setAttribute('data-item-id', id)
            el.setAttribute('data-item-price', (+p).toFixed(2))
            el.setAttribute('data-item-url', "https://cobbmtn.dweet.net/static/validateFlowers.php")
            el.setAttribute('data-item-description', "Plant")
            el.setAttribute('data-item-image', 'https://jsbot.cantelope.org/uploads/2h68aC.jpg')
            el.setAttribute('data-item-name', "Plant - $" + (Math.round(p*10)/10).toFixed(2))
            el.className = 'snipcart-add-item'
            el.style.display = 'none'
            document.body.appendChild(el)
            el.click()
            el.parentNode.removeChild(el)
          }
        }
      })
    }
  },
  computed: {
    category() {
      return this.cat ? 1 : 2
    },
    filteredCategories(){
      if(typeof this.content.flowerCategories !='undefined'){
        return this.content.flowerCategories.filter(v=>{
          return v.name == 'Featured Products'
        })
      }else{
        return []
      }
    },
    filteredFlowers2(){
      if(typeof this.content.flowerCategories !='undefined'){
        return this.content.flowerCategories.filter(v=>{
          return v.name != 'Featured Products'
        })
      }else{
        return []
      }
    }
  },
  mounted () {
    if(!this.showFeatureVid) {
      this.$nextTick(()=>{
        this.c = this.$refs.c
        this.c.width = 1920
        this.c.height = 1080
        this.x = this.c.getContext('2d')
        this.S = Math.sin
        this.C = Math.cos
        this.Draw()
        let w = document.getElementsByTagName('body')[0].clientWidth;
        if(w < 500){
          this.$refs.featureVidMedia.style.width = '400px'
          this.$refs.featureVidMedia.style.height = 'calc(400px / 1.7777777777778)'
        } else {
          if(w > 1e3){
            this.$refs.featureVidMedia.style.width = '800px'
            this.$refs.featureVidMedia.style.height = 'calc(800px / 1.7777777777778)'
          } else {
            this.$refs.featureVidMedia.style.width = '80vw'
            this.$refs.featureVidMedia.style.height = 'calc(80vw / 1.7777777777778)'
          }
        }
        window.addEventListener('resize', () => {
          let w = document.getElementsByTagName('body')[0].clientWidth;
          if(w < 500){
            this.$refs.featureVidMedia.style.width = '400px'
            this.$refs.featureVidMedia.style.height = 'calc(400px / 1.7777777777778)'
          } else {
            if(w > 1e3){
              this.$refs.featureVidMedia.style.width = '800px'
              this.$refs.featureVidMedia.style.height = 'calc(800px / 1.7777777777778)'
            } else {
              this.$refs.featureVidMedia.style.width = '80vw'
              this.$refs.featureVidMedia.style.height = 'calc(80vw / 1.7777777777778)'
            }
          }
        })
      })
    }
    let url = "https://cobbmtn.dweet.net/static/getData.php"
    fetch(url, {
      mode: 'cors',
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    })
    .then(res => {
      return res.json()
    }).then(myJson => {
      this.content = myJson
    })

    this.$nextTick(()=>{
      var slider = this.$refs.slider 
      var currentDCPrice = this.$refs.currentDCPrice

      noUiSlider.create(slider, {
          start: [100],
          connect: true,
          range: {
              'min': 55,
              'max': 250
          },
          pips: {
              mode: 'steps',
              stepped: true,
              density: 10
          },
          behaviour: 'tap-drag',
          format: {
              to: function (value) {
                  return '$' + (Math.round(value*10)/10).toFixed(2) ;
              },
              from: function (value) {
                  return Number(value.replace(',-', ''));
              }
          }
      })

      slider.noUiSlider.on('slide', e=> {
        currentDCPrice.value = e[0];
      });


      var slider2 = this.$refs.slider2
      var currentWrappedPrice = this.$refs.currentWrappedPrice

      noUiSlider.create(slider2, {
          start: [20],
          connect: true,
          range: {
              'min': 5,
              'max': 60
          },
          pips: {
              mode: 'steps',
              stepped: true,
              density: 10
          },
          behaviour: 'tap-drag',
          format: {
              to: function (value) {
                  return '$' + (Math.round(value*10)/10).toFixed(2);
              },
              from: function (value) {
                  return Number(value.replace(',-', ''));
              }
          }
      })

      slider2.noUiSlider.on('slide', e=> {
        currentWrappedPrice.value = e[0];
      });

      var slider3 = this.$refs.slider3
      var currentGiftPrice = this.$refs.currentGiftPrice

      noUiSlider.create(slider3, {
          start: [100],
          connect: true,
          range: {
              'min': 25,
              'max': 200
          },
          pips: {
              mode: 'steps',
              stepped: true,
              density: 10
          },
          behaviour: 'tap-drag',
          format: {
              to: function (value) {
                  return '$' + (Math.round(value*10)/10).toFixed(2) ;
              },
              from: function (value) {
                  return Number(value.replace(',-', ''));
              }
          }
      })

      slider3.noUiSlider.on('slide', e=> {
        currentGiftPrice.value = e[0];
      });

      var slider4 = this.$refs.slider4
      var currentPlantPrice = this.$refs.currentPlantPrice

      noUiSlider.create(slider4, {
          start: [100],
          connect: true,
          range: {
              'min': 55,
              'max': 200
          },
          pips: {
              mode: 'steps',
              stepped: true,
              density: 10
          },
          behaviour: 'tap-drag',
          format: {
              to: function (value) {
                  return '$' + (Math.round(value*10)/10).toFixed(2) ;
              },
              from: function (value) {
                  return Number(value.replace(',-', ''));
              }
          }
      })

      slider4.noUiSlider.on('slide', e=> {
        currentPlantPrice.value = e[0];
      });
    })
  },
  watch: {
    'state.siteEntered'() {
      setTimeout(()=>{
        this.$refs.mapFrame.src = this.$refs.mapFrame.src
      }, 1000)
      let h,t
      if((h=(t=window.location.href.split('/'))[t.length-1]).indexOf('#') !== -1) {
        this.jump(h)
      }
    },
    'state.vidLoaded'() {
      let h,t
      if((h=(t=window.location.href.split('/'))[t.length-1]).indexOf('#') !== -1) {
        this.jump(h)
      }
    }
  }
}

</script>
<style scoped>
.storeFront{
  position: absolute;
  width: 100%;
  margin-top: 105px;
  margin-bottom: 100px;
  padding-bottom: 100px;
  background: #4028;
}
.flowerContainer{
  max-width: 260px !important;
}
canvas{
  vertical-align: top;
}
.disclaimer{
  font-size: .7em;
}
.featureVidMedia{
  margin-top: 25px;
  /*
  max-height: 400px;
  margin-left: -16px;
  */
  position: relative;
  left: 50%;
  transform: translatex(-50%);
  padding: 15px;
  border-radius: 4px;
  background: #def4;
}
.productFooter{
  width: 175px;
  float:left;
}
.addButtonContainer{
  float:left;
  margin-top: -7px;
}
.canvasAnimation{
  width: 100%;
  height: 100%;
}
.addCardButton{
  width: 60px;
  margin-left: -60px;
  font-family: 'Crafty Girls';
  font-size: 14px;
  line-height: 1em;
  background: #3c8a;
  color: #fff;
  font-weight: 900;
  border: 3px solid #8fe5;
  border-radius: 10px;
}
.addButton{
  width: 60px;
  font-family: 'Crafty Girls';
  font-size: 14px;
  line-height: 1em;
  background: #3c8a;
  color: #fff;
  font-weight: 900;
  border: 3px solid #8fe5;
  border-radius: 10px;
}
.smallLogo{
  width: 290px !important;
}
.iB{
  display: inline-block;
}
.flowerImage{
  max-width: 225px;
  margin-top: 10px;
}
.staffImage{
  height: 210px;
  margin-top: 10px; 
}
.employmentGraphic{
  width: 350px;
}
.departmentsContainer{
  margin-top: 85px;
}
.contactText{
  color: #8cf;
  font-size: 30px;
  text-shadow: 1px 1px 3px #000a;
}
.smallify{
  font-size: 1.1em;
}
.spacer{
  //background: url(https://jsbot.cantelope.org/uploads/1Ug6ML.png) no-repeat;
  background: url(https://jsbot.cantelope.org/uploads/WlAoH.png) no-repeat;
  background-size: 100% 60px;
  left: 0;
  margin-top: 15px;
  height: 60px;
  width: 100%;
  margin-bottom: -20px;
}
.departmentTitle{
  position: absolute;
  z-index: 2;
  font-size: 28px;
  font-weight: 900;
  color: #fff;
  width: 100%;
  margin-top: -20px;
  text-shadow: 1px 1px 3px #000;
}
.sectionTitle{
  position: absolute;
  z-index:2;
  font-size: 38px;
  color: #fff;
  text-shadow: 2px 2px 3px #002a;
  margin-top: -43px;
  margin-left: 15px;
  float: left;
}
.departmentContainer{
  margin-top: 50px;
}
.franchiseContainer{
  display: inline-block;
  margin: 20px;
  max-width: 300px;
  color: #acd;
  font-weight: 900;
  text-shadow: 2px 2px 2px #0028;
  background: #0000;
  padding: 20px;
  background: linear-gradient(-30deg, #012a, #0000);
  border-radius: 2px;
  transition: transform .5s;
}
.franchiseContainer:hover {
  -ms-transform: scale(1.1);
  -webkit-transform: rotate(1.1);
  transform: scale(1.1);
}
.franchiseTitle{
  font-size: 32px;
  font-weight: 900;
  line-height: 1em;
  color: #f48;
}
.franchiseDescription{
  font-size: 18px;
}
.memberTitle{
  font-size: 18px;
  color: #aaa;
  text-shadow: 1px 1px 3px #000;
}
.franchiseLink{
  text-decoration:none;
  color: #eef;
  text-shadow: 1px 1px 9px #000;
}
.separator {
    padding-left: 15px;
    display: flex;
    align-items: center;
    text-align: center;
}
.separator::after {
    content: '';
    flex: 1;
    border-bottom: 2px solid #fff;
}
/*
.separator::before {
    margin-right: .25em;
}
*/
.separator::after {
    margin-left: .25em;
}
.franchiseImage{
  display: inline-block;
  height: 120px;
}
.successImage{
  display: inline-block;
  max-width: 200px;
}
.textSelected{
  font-size: 3.5em !important;
  color: #4f8 !important;
  top: 20px;
}
.categoryText{
  padding: 5px;
  font-size: 36px;
  color: #a88;
  text-shadow: 0 0 6px #000;
  margin-top: -20px;
  display: none;
  transition: font-size .4s, top .4s, margin-top .4s;
}
.switch {
  position: relative;
  display: inline-block;
  width: 80px;
  height: 34px;
  top: -20px;
}
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #6ca;
  -webkit-transition: .4s;
  transition: .4s;
  border: 1px solid #888;
}
.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 3px;
  bottom: 3px;
  background-color: #fff;
  -webkit-transition: .4s;
  transition: .4s;
}
input:checked + .slider {
  background-color: #a6a;
}
input:focus + .slider {
  box-shadow: 0 0 1px #f32196;
}
input:checked + .slider:before {
  -webkit-transform: translateX(45px);
  -ms-transform: translateX(45px);
  transform: translateX(45px);
}
.slider.round {
  border-radius: 34px;
}
.slider.round:before {
  border-radius: 50%;
}
</style>
<style>
.vue-lb-info{
  font-size:26px !important;
  font-family: 'Crafty Girls' !important;
  background: #0288 !important;
  height: auto !important;
  display: block !important;
  text-align: left !important;
  padding: 5px !important;
  width: auto !important;
  position: absolute !important;
  border-radius: 10px !important;
  left: 50% !important;
  margin-top: 200px !important;
  padding-left: 15px !important;
  padding-right: 15px !important;
  transform: translate(-50%, 100%) !important;
  white-space: nowrap !important;
}
.vue-lb-footer, .vue-lb-footer-count{
  font-family: calligraphic !important;
  background: #0000 !important;
  color: #0000 !important;
}
.vue-lb-modal-image{
  border: 6px solid #6af3 !important;
  border-radius: 50% !important;
  margin-left: -6px !important;
}
.selectinatorContainer{
  position: fixed;
  z-index: 100;
  top: 120px;
  right: 25px;
}

/* selecionator */
.selectionator {
  position: relative;
  border-radius: 4px;
  background-color: transparent;
  color: #ffe;
  perspective: 800px;
  width: 150px;

:before {
  content: "";
  background-color: transparent;
  width: 100%;
  height: 1.5em;
  position: absolute;
  background-image: linear-gradient(top, #000000, rgba(0, 0, 0, 0));
}

}
li{
  text-align: left;
}
.selectionator .search {
  position: relative;
  display: block;
  border: 0px;
  width: 100%;
  padding: .25em;
  outline: none;
  color: #fff;
  font-weight: 900;
  background-color: #365;
  box-sizing: border-box;
  transform-style: preserve-3d;
  transform-origin: 50% 0%;
  transition: transform .3s;
  border-radius: 4px;
  z-index: 99;
}
.selectionator .search .overlay {
  width: 100%;
  background-color: #f00;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0px;
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.35) 0%, rgba(0, 0, 0, 0.1) 100%);
  opacity: 0;
}
/*.selectionator .search .shadow {
  position: absolute;
  height: 15px;
  width: 100%;
  left: 0;
  bottom: -15px;
  transform-origin: center bottom;
  transform: scale(0.95, 1) translate3d(0, 0px, 0);
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0) 100%);
  opacity: 0;
}
*/
.selectionator .search:before {
  content: "\f078";
  margin-right: 25px;
  display: inline-block;
  font-family: FontAwesome;
  font-style: normal;
  font-weight: normal;
  line-height: 1.5;
  float: right;
  vertical-align: middle;
}
.selectionator:hover .search,
.selectionator.opened .search {
  transform: rotate3d(1, 0, 0, 60deg);
}
.selectionator:hover .search .overlay,
.selectionator.opened .search .overlay,
.selectionator:hover .search .shadow,
.selectionator.opened .search .shadow {
  opacity: 1;
}
.selectionator:hover .menu,
.selectionator.opened .menu {
  height: auto;
  opacity: 1;
}
.selectionator .menu {
  overflow: hidden;
  position: absolute;
  width: 100%;
  top: 50%;
  color: black;
  font-weight: 900;
  height: 0px;
  border-radius: 0px;
  background-color: #eff;
  transition: all 0.3s ease;
  opacity: 0;
  border: 1px solid #16a085;
  border-top: none;
}
.selectionator ul.list {
  list-style: none;
  padding: 0px;
  margin: 0px;
  font-weight: 900;
  overflow: hidden;
  overflow-y: hidden;
  height: 0px;
  backface-visibility: hidden;
  transition: all 0.3s ease;
  opacity: 0.75;
  width: 100%;
  height: 100%;
}
.selectionator ul.list > li span.header {
  display: block;
  padding: 6px;
  background-color: #34495e;
  font-weight: 900;
  color: #fff;
}
.selectionator ul.optgroup {
  list-style: none;
  padding: 0px;
  margin: 0px;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}
.selectionator ul.optgroup li:hover {
  background-color: #6f8;
  color: #011;
}
.selectionator ul.optgroup li input[type="checkbox"] {
  display: none;
  margin: 6px;
}
.selectionator ul.optgroup li input[type="checkbox"]:checked {
  background-color: #1abc9c;
}
.selectionator ul.optgroup li input[type="checkbox"]:checked ~ label {
  background-color: #2980b9;
  color: #fff;
  font-weight: 900;
}
.selectionator ul.optgroup li input[type="checkbox"]:checked ~ label:before {
  content: "\f14a";
}
.selectionator ul.optgroup li label {
  font-weight: 100;
  display: block;
  padding-left: 15px;
  line-height: 2em;
  transition: all 0.3s ease;
}
.selectionator ul.optgroup li label:before {
  content: "\f096";
  display: inline-block;
  font-family: FontAwesome;
  font-style: normal;
  font-weight: normal;
  line-height: 1;
  margin-right: 8px;
  vertical-align: middle;
}
.customblurb{
  color: #ffa;
  font-size: 24px;
  margin-top: 20px;
  background: linear-gradient(90deg,#400a,#204a);
  padding: 5px;
  width: 600px;
  margin-left: auto;
  margin-right: auto;
  border-radius: 10px;
  line-height: 1.5em;
}
.sliderInput{
  font-family: 'Crafty Girls';
  width: 100px;
  text-align: center;
  font-size: 32px;
  background: #123c;
  color: #fff;
  border: none;
  padding-top: 5px;
  padding-bottom: 0;
  height: 40px;
  margin-top: 10px;
  position: relative;
  z-index: 90;
  border: 1px solid #456;
  border-bottom: 2px solid #4f8;
}
.sliderInput:focus{
  outline: none;
}
</style>
