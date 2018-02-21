<template id="product-box">
  <div class="box">
    <img :src="item_data.link" class="img-thumbnail" v-on:click="addItem(item_data)"/>
    <h5>{{item_data.name}}</h5>
  </div>
</template>


<script>
  export default{
     props: ["item_data", "buyitems"],



     methods: {
        addItem: function(item_data) {
          this.pushData(item_data)
        },
        pushData: function(item_data) {
            var filled = false
             if(this.$parent.buyitems.length !== 0){
                $.each( this.$parent.buyitems, function( key, value ){
                    if(item_data.id === value.id) {
                          value.qty += 1 
                          filled = true

                    }else{
                      filled = false
                    }
                });
              }else{
                filled = false
              }

              if(filled === false){
                this.fillData(item_data)
              }
              this.$bus.$emit('refreshdatas')
            },
        fillData: function(item_data){
            this.$parent.buyitems.push({
              img: item_data.img,
              link: 'img/products/' + this.item_data.img,
              name: item_data.name,
              price: item_data.price,
              qty: 1,
              total: item_data.price,
              id: item_data.id
            });
        }
    }
  }
</script>