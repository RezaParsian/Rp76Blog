<template>
    <section @mouseover="HoverToolTip" id="post_section" class="position-relative">
        <div v-if="loading" style="background: #33333391;" class="position-absolute p-0 m-0 w-100 h-100 d-flex justify-content-center">
            <div class="align-self-center spinner-grow text-warning"></div>
        </div>
        <div class="big-blog-item" v-for="index in posts" :key="index['id']">
            <img src="img/blog-big/1.jpg" alt="image" class="blog-thumbnail" />
            <div class="blog-content text-box text-white rtl">
                <div class="top-meta">11.11.18 / With <a href="">{{index["name"]}}</a></div>
                <h3>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</h3>
                <p>
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                </p>
                <a href="#" data-toggle="tooltip" title="بیشتر" class="read-more">
                    بیشتر
                </a>
            </div>
        </div>
        <div class="site-pagination">
            <a href="#post_section" data-toggle="tooltip" :title="'صفحه '+index" @click="GetPosts(index)" v-for="index in paginate" :class="current==index ? 'active disable' : ''" :key="index">{{AddLeadingZero(index)}}.</a>
        </div>
    </section>
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
            var vm = this
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
            var result=[];
            var lastpage=parseInt(this.current) + 5;

            while(lastpage>this.total){
                lastpage--;
            }

            var firstpage=parseInt(this.current) - 5;

            while(firstpage<1){
                firstpage++
            }

            for(var i=firstpage;i<=lastpage;i++){
                result.push(i);
            }

            this.paginate= result;
        }
    },
    mounted(){
        var url=new URL(document.URL);
        var pageID=url.searchParams.get("page");
        this.GetPosts(pageID);
    }
};
</script>