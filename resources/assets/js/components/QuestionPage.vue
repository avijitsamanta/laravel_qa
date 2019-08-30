<template>
    <div class="container">
        <question :question="question"></question>    
        <answers :question="question"></answers>
    </div>
</template>
<script>

import Question from './Question.vue';
import Answers from './Answers.vue';

export default{

    components:{Question,Answers},
    props:['question']

}

</script>