<template id="buy-box">
  <div class="row">
    <div class="col-sm-2">
       <img :src="buy_data.link" class="img-thumbnail"/>    
    </div>  
    <div class="col-sm-10">
    <h4>{{buy_data.name}}</h4>
<!--     <p>{{buy_data.price}} €</p>
 -->
    <div>
    <span class="qty-minus" v-on:click="minusQty(buy_data)">-</span>
    <span class="qty">{{buy_data.qty}}</span>
    <span class="qty-plus" v-on:click="plusQty(buy_data)">+</span>
    <span class="del" v-on:click="removeItem(buy_data)">Remove</span>      
    </div>
    <div class="totalprice">{{buy_data.total}}</div>      
    </div>

  </div>
</template>

<script>

export default{
  props: ["buy_data", "buyitems"],
  methods: {
    removeItem: function(buy_data) {
      var index = this.$parent.buyitems.indexOf(buy_data);
      this.$parent.buyitems.splice(index, 1);

    },
    plusQty: function(buy_data){
      buy_data.qty += 1;
      buy_data.total = buy_data.qty*buy_data.price;
    },
    minusQty: function(buy_data){
      buy_data.qty -= 1;
      if (buy_data.qty < 0){
        buy_data.qty = 0;
      }
      buy_data.total = buy_data.qty*buy_data.price;
    }
    
  }
	}
</script>