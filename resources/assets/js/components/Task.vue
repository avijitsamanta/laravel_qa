<template>
    <tr>
        <td>{{ task.id }}</td>        
        <td>{{ task.name }}</td>
        <td>{{ task.priority }}</td>
        <td><button @click="remove" class="btn btn-primary">Delete</button></td>
    </tr>
</template>
<script>
    export default{
        props:['task'],
        methods:{
            remove()
            {
                axios.delete(`/api/tasks/${this.task.id}`)
                 .then(()=>{
                        this.$emit('delete')
                    });
                
            }
        }
    }

</script>