<template>
<div>
  <div class="row">
    <Searcher></Searcher>
  </div>
  <div class="row">
  <div id="product" v-for="item in items" class="col-sm-2">  
    <item :item_data="item"></item>
  </div>
  </div>


  <div id="cart">
    <div id="head">
    </div>
    <div id="buy" v-for="buyitem in buyitems" >
    <buyitem :buy_data="buyitem"></buyitem>
     </div> 
    <h5 v-if="total()">Sum:{{total()}} €</h5>
  </div>      

</div>  

</template>

<script>


import Item from './Item.vue'
import BuyItem from './BuyItem.vue'
import Searcher from './Searcher.vue'

export default{
  name: 'Shop',
  data(){
    return{
    items: [],
    buyitems: []
    }
  },
  // created () {
  //   // fetch the data when the view is created and the data is
  //   // already being observed
  //   this.getItems()

  // },
  // watch: {
  //   // call again the method if the route changes
  //   '$route': 'getItems'
  // },

  methods: {

    // getItems: function(){
    //     this.$http.get('api/products').then(function (response) {
    //     this.items = response.data;
    //     $.each( this.items, function( key, value ){
    //       value.link = 'img/products/' + value.img
    //     });
    //     // console.log(this.items);
    //     })
    //     .catch(function (response) {
    //         console.log(response);
    //         alert("Could not load datas");
    //     });

    //   },

    total: function(){
      var sum = 0;
      this.buyitems.forEach(function(buyitem){
            sum += parseInt(buyitem.total);
      });
      return sum;
    }
  },

  components:{
    Searcher,
   'item': Item,
   'buyitem' :BuyItem

  }

}






</script>


<style>


#app {
  width: 760px;
  margin: 20px auto;
  #product {
    .box {
      width: 230px;
      background-color: #fff;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      display: inline-block;
      margin: 0 10px;
      position: relative;
      img {
        width: 230px;
      }
      i {
        width: 50px;
        height: 50px;
        background: #ED277F;
        color: #ffffff;
        border-radius: 25px;
        text-align: center;
        line-height: 50px;
        font-size: 1.4rem;
        position: absolute;
        right: 20px;
        top: 150px;
        box-shadow: 0 0 4px 2px rgba(80, 80, 80, 0.1);
        cursor: pointer;
        transition: all 0.3s;
        &:hover {
          transform: scale(1.05);
        }
      }
      h2 {
        margin-left: 20px;
      }
      p {
        margin-left: 20px;
      }
    }
  }
  #cart {
    margin-top: 50px;
    overflow: hidden;
    background: #333;
    #head {
      width: 100%;
      border-bottom: 1px solid #BFBFBF;
      height: 40px;
      display: block;
      h3 {
        display: inline-block;
        line-height: 40px;
        margin: 0;
      }
      #price {
        display: inline-block;
        color: #777777;
        margin-left: 200px;
        line-height: 40px;
      }
      #quantity {
        display: inline-block;
        color: #777777;
        margin-left: 100px;
        line-height: 40px;
      }
      #total {
        display: inline-block;
        color: #777777;
        line-height: 40px;
        float: right;
      }
    }
    .row {
      width: 100%;
      border-bottom: 1px solid #BFBFBF;
      overflow: hidden;
      padding: 10px 0;
      display: block;
      flaot: left;
      img {
        height: 100px;
        float: left;
      }
      h4 {
        float: left;
        margin: 0;
        line-height: 100px;
        margin-left: 20px;
        width: 100px;
      }
      p {
        float: left;
        margin: 0;
        width: 80px;
        line-height: 100px;
        margin-left: 35px;
        text-align: center;
      }
      .qty-minus {
        float: left;
        width: 20px;
        line-height: 100px;
        margin-left: 60px;
        text-align: center;
        cursor: pointer;
      }
      .qty {
        float: left;
        width: 20px;
        line-height: 100px;
        margin-left: 20px;
        text-align: center;
      }
      .qty-plus {
        float: left;
        width: 20px;
        line-height: 100px;
        margin-left: 20px;
        text-align: center;
        cursor: pointer;
      }
      .del {
        float: left;
        width: 80px;
        line-height: 100px;
        margin-left: 60px;
        cursor: pointer;
        text-decoration: underline;
        color: #ED277F;
      }
      .totalprice {
        float: left;
        width: 80px;
        line-height: 100px;
        margin-left: 10px;
        text-align: right;
      }
      .row p::before, .box p::before, .totalprice::before {
        content: "$";
      }
    }
    h5 {
      font-size: 1.2rem;
      text-align : right;
    }
  }
}

</style>
