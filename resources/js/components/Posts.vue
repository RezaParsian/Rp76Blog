<template>
    <article @mouseover="HoverToolTip" id="post_section" class="position-relative">
        <div v-if="loading" style="background: #33333391;" class="position-absolute p-0 m-0 w-100 h-100 d-flex justify-content-center">
            <div class="spinner-grow text-warning"></div>
        </div>
        <div class="rtl" v-if="posts.length==0">
            <h1 class="text-center text-white">نتیجه ای یافت نشد.</h1>
        </div>
        <div class="card bg-blog shadow" v-for="index in posts" :key="index['id']">
            <div class="card-body">
                <div class="big-blog-item mb-0">
                    <img src="img/blog-big/1.jpg" alt="image" class="blog-thumbnail rounded" />
                    <div class="blog-content text-box text-white rtl">
                        <div class="top-meta">{{ index.custom_date }} / By <a href="">{{index.user.name}}</a></div>
                        <h3>{{index.title}}</h3>
                        <section v-html="index.content"></section>
                        <p class="mt-3"><a href="#" data-toggle="tooltip" title="بیشتر" class="read-more">بیشتر</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-pagination">
            <a href="#post_section" data-toggle="tooltip" :title="'صفحه '+index" @click="GetPosts(index)" v-for="index in paginate" :class="current==index ? 'active disable' : ''" :key="index">{{AddLeadingZero(index)}}.</a>
        </div>
    </article>
</template>

<script>
export default {
    data(){
        return{
            posts:[],
            total:1,
            current:1,
            loading:true,
            paginate:[],
        }
    },
    methods:{
        GetPosts:function(page=1){
            let vm = this;
            page= page ?? 1;
            vm.loading=true;
            $.get('/api/post?q='+this.$root.searchquery+'&page='+page,function(data,status){
                if(status==="success"){
                    vm.posts=data["data"];
                    vm.current=data["current_page"];
                    vm.total=data["last_page"];
                    vm.loading=false;
                    vm.MakePaginate();
                }
            });
            window.history.pushState("", "", '?page='+page);
        },
        HoverToolTip(){
            $('[data-toggle="tooltip"]').tooltip();
        },
        AddLeadingZero:function(number){
            return String(number).padStart(2, '0');
        },
        MakePaginate:function(){
            const result = [];
            let lastPage = parseInt(this.current) + 5;

            while(lastPage>this.total){
                lastPage--;
            }

            let firstPage = parseInt(this.current) - 5;

            while(firstPage<1){
                firstPage++
            }

            for(let i=firstPage; i<=lastPage; i++){
                result.push(i);
            }

            this.paginate= result;
        }
    },
    mounted(){
        const url = new URL(document.URL);
        const pageID = url.searchParams.get("page");
        this.GetPosts(pageID);
    }
};
</script>
