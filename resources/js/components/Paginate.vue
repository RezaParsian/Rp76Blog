<template>
    <div class="site-pagination" v-html="MakePaginate()">

    </div>
</template>

<script>
export default {
    props:{
        total:{
            default:1
            
        },
        current:{
            default:1
        }
    },
    methods:{
        AddLeadingZero:function(number){
            return String(number).padStart(2, '0');
        },
        MakePaginate:function(){
            var result="";

            var lastpage=parseInt(this.current) + 5;

            while(lastpage>this.total){
                lastpage--;
            }

            var firstpage=parseInt(this.current) - 5;

            while(firstpage<1){
                firstpage++
            }

            for(var i=firstpage;i<=lastpage;i++){
                var pagenumber=this.AddLeadingZero(i);
                var cs=i==this.current ? "class='active'" : "";
                result+='<a href="?page='+i+'" '+cs+' >'+pagenumber+'.</a>';
            }

            return result;
        }
    }
};
</script>