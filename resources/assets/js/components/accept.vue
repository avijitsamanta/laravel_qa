<template>
    <div>
        
            <a  v-if="canAccept" title="Mark this answer as best answer" 
            :class="classes"
            @click.prevent ="toggle"
            >
            <i class="fas fa-check fa-2x"></i>                                    
            </a>
            
          
            
            <a v-if="accepted"  title="The question owner accepted this answer as best answer" 
                :class="classes"                                        
                >
                <i class="fas fa-check fa-2x"></i>                                    
            </a>
       
    
    </div>
</template>

<script>
    export default {

        props:['answer'],

        data(){
           return {
	            isBest: this.answer.is_best,
	            id: this.answer.id
	        }
        },
        computed: {
	        classes () {
	            return [
	                'mt-2',
                        this.isBest ? 'vote-accepted' : ''
	            ];
	        },
	
	        endpoint () {
	            return `/answer/${this.id}/accept`;
	        },
	
	        canAccept(){
                    return this.authorize('accept',this.answer);
                },
                accepted()
                {
                    return !this.canAccept && this.isBest;
                }
	    },
        methods:{
            toggle(){

                if(!this.signedIn){
                    return this.$toast.warning('please login to favorite this question','Warning',{
                        timeout:3000,
                        position:'bottomLeft'
                    });
                }
                 this.create();
            },
        
            create(){
                axios.post(this.endpoint)
                .then(
                        res => {
                            this.$toast.success(res.data.message,'Success',{
                                timeout:3000,
                                position:'bottomLeft'
                            });
                            
                            this.isBest = true;
                        }
                    );
            }
        }
}
</script>

