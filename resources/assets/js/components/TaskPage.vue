<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                 <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Tasks</h2>
                       
                    </div>

                </div>

                <div class="card-body">
                    <table class="table">

                        <thead>
                            <tr>
                                <td>ID</td>                                
                                <td>Task Title</td>
                                <td>Priority</td>                                
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <task v-for="(task,index) in tasks" :key="task.id" :task="task" @delete="remove(index)"></task>
                            <tr>
                                <td><input v-model="task.name" type="text" id="task" class="form-control"></td>                                
                                <td>
                                    <select id="select" class="form-control" v-model="task.priority">
                                        <option>Low</option>                                        
                                        <option>Medium</option>
                                        <option>High</option>
                                    </select>
                                </td>
                                <td><button @click="add" class="btn btn-primary">ADD</button></td>

                            </tr>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import Task from './Task.vue';
export default{
    data(){
        return{
            tasks:[],
            task:{name:'',priority:''}
        }
    },
    methods:{
        getTaskList(){

            axios.get(`/api/tasks`)
                 .then(({data})=>{
                        data.forEach(task=>{
                            this.tasks.push(task)
                        });
                    });
        },
        add(){
             axios.post(`/api/tasks`,this.task)
                 .then(({data})=>{
                        this.tasks.push(data);
                        this.task.name='';
                    });
            
        },
        remove(index){
            this.tasks.splice(index,1);
        }
    },
    created(){
        this.getTaskList();
    },
    components:{Task}
    
}
</script>