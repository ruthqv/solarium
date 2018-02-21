<template>
	<div>
		<input type="text" v-on:keyup="searchByName(toSearch)" v-model="toSearch" class="form-control" placeholder="Search">

		<div v-if="createForm == true">
			<p>Sorry, this product is not between our list, but you can create this new one!</p>
			<form action="" class="form-inline">
				<input type="text" :value="newItemName" class="form-control">

			</form>
		</div>
	</div>
</template>

<script>
	export default{
		name: 'Searcher',
		data(){
			return{
				toSearch: '',
				createForm : false,

			}
		},
		computed:{
			newItemName: function(){
				return this.toSearch !== '' ?  this.toSearch : ''
			}
		},

		mounted(){
			 this.$bus.$on('refreshdatas', ()=> {
			 	console.log('oioioio')
				this.toSearch = ''
			});
		},
		methods:{
	
			searchByName:function(toSearch){

				this.$http.get('api/products/search/' + toSearch).then(function (response) {

					if(response.data.length > 0){
						this.createForm = false

						 this.$parent.items = response.data
				        $.each(this.$parent.items, function(item, val){
				        	val.link = 'img/products/' + val.img
				        });
					}else{
						this.$parent.items = []
						this.createForm = true
					}


       			 }).catch(function (response) {
	            console.log(response);
	            alert("Could not load datas");
	        });

			},



		}

	}
</script>
<style>
	
</style>