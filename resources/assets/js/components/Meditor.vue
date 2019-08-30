<template>
    <div class="card">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#write" role="tab">Write</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#preview" role="tab">Preview</a>
          </li>

        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
        <div class="tab-pane active" id="write" role="tabpanel">
            <slot></slot>
        </div>
        <div class="tab-pane" id="preview" v-html="preview" role="tabpanel"></div>
        </div>
      </div>
    </div>
</template>
<script>
import Markdown from "markdown-it";
import autosize from "autosize";

const md = Markdown();
export default{
    props:['body'],
    computed:{
        preview(){
            return md.render(this.body);
        }
    },
    mounted(){
        autosize(this.$el.querySelector("textarea"));
    },
    update(){
     autosize(this.$el.querySelector("textarea"));
    }
    
}
</script>