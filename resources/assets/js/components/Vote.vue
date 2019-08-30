<template>
    <div class="d-fex flex-column vote-controls">

        <a :title="title('up')" class="vote-up" :class="classes"
            @click.prevent="voteUp">
            <i class="fas fa-caret-up fa-3x"></i>
        </a>

       

        <span class="votes-count">{{ count }}</span>

        <a :title="title('down')" 
           class="vote-down off "
          @click.prevent = "voteDown" >
            <i class="fas fa-caret-down fa-3x"></i>
        </a>
        
         <favorite v-if="name === 'question'" :question="model"></favorite>
       
         <accept v-else :answer="model" name = "answer"></accept>
       
    </div>
</template>

<script>
    import Favorite from './Favorite.vue';   
    import Accept from './accept.vue';
    export default {

        props:['model','name'],

        data(){
           return {
	            count: this.model.votes_count,
	            id: this.model.id
	        }
        },
        components:{
            Favorite,Accept
        },
        computed: {
	        classes () {
	            return !this.signedIn ? 'off' : '';
	           
	        },
	
	        endpoint () {
	            return `/${this.name}s/${this.id}/vote`;
	        },
	
	        
	    },
        methods:{
            title(voteType)
                {
                    let titles = {
                        up:`This ${this.name} is useful`,
                        down:`This ${this.name} is not useful`
                    };
                    return titles[voteType];
                },
                voteUp(){
                    this._vote(1);
                },
                voteDown(){
                     this._vote(-1);       
                },
            _vote(vote){

                if(!this.signedIn){
                    return this.$toast.warning('please login to vote','Warning',{
                        timeout:3000,
                        position:'bottomLeft'
                    });
                }
                  axios.post(this.endpoint,{vote})
                .then(
                        res => {
                            this.$toast.success(res.data.message,'Success',{
                                timeout:3000,
                                position:'bottomLeft'
                            });
                          console.log(res);  
                            this.count = res.data.votesCount;
                        }
                    );
            },
        
            
        }
}
</script>


